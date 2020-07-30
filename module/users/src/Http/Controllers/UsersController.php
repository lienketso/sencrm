<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/6/2017
 * Time: 11:23 PM
 */
namespace Users\Http\Controllers;

use Acl\Repositories\RoleRepository;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;
use History\Repositories\HistoryRepositories;
use Users\Http\Requests\UserCreateRequest;
use Users\Http\Requests\UserEditRequest;
use Users\Models\Users;
use Users\Models\UsersMeta;
use Users\Repositories\UsersMetaRepository;
use Users\Repositories\UsersReferralRepositories;
use Users\Repositories\UsersRepository;
use Illuminate\Http\Request;

class UsersController extends BaseController
{
	protected $users;
	protected $refer;
	protected $his;
	protected $umeta;
	
	public function __construct(UsersRepository $repository, UsersReferralRepositories $referalrepository, HistoryRepositories $historyRepositories, UsersMetaRepository $usersMetaRepository)
	{
		$this->users = $repository;
		$this->refer = $referalrepository;
		$this->his = $historyRepositories;
		$this->umeta = $usersMetaRepository;
	}
	
	public function getSetting()
	{
		return view('nqadmin-users::components.list');
	}
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getIndex(Request $request)
	{
        $keyword = $request->get('keyword');
        if($keyword!=''){
            $users = $this->users->scopeQuery(function ($e) use ($keyword){
               return $e->where('fullname','like',$keyword.'%')
                        ->orWhere('phone', $keyword)
                        ->orWhere('status',$keyword);
            })->paginate(15);

        }else {
            $users = $this->users->orderBy('created_at', 'desc')->paginate(15);
        }
        $Uactive = $this->users->findWhere(['status'=>'active'])->count();
        $Udisable = $this->users->findWhere(['status'=>'disable'])->count();
        return view('nqadmin-users::components.index', [
            'data' => $users,
            'Uactive'=>$Uactive,
            'Udisable'=>$Udisable
        ]);
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getCreate(RoleRepository $roleRepository)
	{
		$role = $roleRepository->all();
		return view('nqadmin-users::components.create', [
			'role' => $role
		]);
	}
	
	/**
	 * @param \Users\Http\Requests\UserCreateRequest $request
	 *
	 * @return bool|\Illuminate\Http\RedirectResponse
	 */
	public function postCreate(
	    UserCreateRequest $request
    )
	{
		try {
			$data = $request->except(['_token', 'continue_edit']);
			$user = $this->users->create($data);
			//update code affliliate
            //Tự động sinh code
            $codename = $codename = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), -6);
            $data_2 = [
                'code_name'=>$codename.$user->id
            ];
            $this->users->update($data_2,$user->id);
            //Thêm vào bảng user referral
            $user->referral()->sync($data['parent']);
            //Đồng bộ quyền cho user
			$user->roles()->sync($data['role']);
            //thêm log add user
            $user_signed = auth('nqadmin')->user();
            $uri = Request::path();
            $data_log = [
                'user_id'=>$user_signed->id,
                'request_name'=>'Add New User',
                'request_uri'=>$uri,
                'request_data'=> json_encode($data)
            ];
            $this->his->createHistory($data_log);
            //Nếu tiếp tục thêm mới
			if ($request->has('continue_edit')) {
				return redirect()->route('nqadmin::users.edit.get', [
					'id' => $user->id
				])->with(FlashMessage::returnMessage('create'));
			}
			
			return redirect()->route('nqadmin::users.index.get')->with(FlashMessage::returnMessage('create'));
			
		} catch (\Exception $e) {
			return redirect()->back()->withErrors(config('messages.error'));
		}
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getEdit($id, RoleRepository $roleRepository)
	{
		
		$user = $this->users->find($id);
		if($user->parent>0){
		    $parentCat = $this->users->find($user->parent);
        }else{
		    $parentCat = [];
        }
		$roles = $roleRepository->all();
		return view('nqadmin-users::components.edit', [
			'data' => $user,
			'role' => $roles,
            'parentCat'=> $parentCat
		]);
	}
	
	/**
	 * @param \Users\Http\Requests\UserEditRequest $request
	 */
	public function postEdit($id, UserEditRequest $request)
	{
		try {
			if ($request->get('password') == null) {
				$data = $request->except(['_token', 'email', 'password', 're_password']);
			} else {
				$data = $request->except(['_token', 'email']);
			}
			//sửa thành viên
			$user = $this->users->update($data, $id);
            $info = $this->users->find($id);
            //nếu mã code chưa tồn tại
            if($info->code_name==''){
                $codename = $codename = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), -6);
                $data_2 = [
                    'code_name'=>$codename.$user->id
                ];
                $this->users->update($data_2,$id);
            }
            //Thêm vào bảng user referral
            $user->referral()->sync($data['parent']);
			//cập nhật đồng bộ quyền
			$user->roles()->sync($data['role']);
			return redirect()->back()->with(FlashMessage::returnMessage('edit'));
		} catch (\Exception $e) {
			return redirect()->back()->withErrors(config('messages.error'));
		}
	}
	
	/**
	 * @param $id
	 *
	 * @return $this|\Illuminate\Http\RedirectResponse
	 */
	public function getDelete($id)
	{
		return getDelete($id, $this->users);
	}

	public function getProfile($id){
	    $userInfo = $this->users->find($id);
	    if(!$userInfo){
	        return redirect()->route('nqadmin::dashboard.index.get')
                ->with(['message'=>'Không tồn tại người dùng trên hệ thống']);
        }
	    return view('nqadmin-users::profiles.index',[
	        'userInfo'=>$userInfo
        ]);
    }

    public function postProfile($id,UserEditRequest $request){
        try{
            if ($request->get('password') == null) {
                $input = $request->except(['_token', 'email', 'password', 're_password']);
            } else {
                $input = $request->except(['_token', 'email']);
            }
            $userUpdate = $this->users->update($input,$id);
            //create and update meta user
            $meta_card_name = $request->get('meta_card_name');
            $meta_card_number = $request->get('meta_card_number');
            $meta_card_bank = $request->get('meta_card_bank');
            $meta_card_brand = $request->get('meta_card_brand');
            $data = [
                'meta_card_name'=>$meta_card_name,
                'meta_card_number'=>$meta_card_number,
                'meta_card_bank'=>$meta_card_bank,
                'meta_card_brand'=>$meta_card_brand
            ];
            foreach($data as $key=>$d){
                $this->umeta->updateOrCreate(['meta_key'=>$key],['users_id'=>$id,'meta_value'=>$d]);
            }
            return redirect()->back()->with(['message'=>'Cập nhật thông tin thành công']);
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

}