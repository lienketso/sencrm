<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/6/2017
 * Time: 11:23 PM
 */
namespace Users\Http\Controllers;

use Acl\Repositories\RoleRepository;
use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;
use Users\Http\Requests\UserCreateRequest;
use Users\Http\Requests\UserEditRequest;
use Users\Repositories\UsersReferralRepositories;
use Users\Repositories\UsersRepository;

class UsersController extends BaseController
{
	protected $users;
	protected $refer;
	
	public function __construct(UsersRepository $repository, UsersReferralRepositories $referalrepository)
	{
		$this->users = $repository;
		$this->refer = $referalrepository;
	}
	
	public function getSetting()
	{
		return view('nqadmin-users::components.list');
	}
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getIndex()
	{
		$users = $this->users->orderBy('created_at', 'desc')->paginate(20);

		return view('nqadmin-users::components.index', [
			'data' => $users
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

}