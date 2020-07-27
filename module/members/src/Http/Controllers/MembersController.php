<?php
namespace Members\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Base\Supports\FlashMessage;
use Illuminate\Http\Request;
use Members\Http\Requests\MemberCreateRequest;
use Members\Http\Requests\MemberEditRequest;
use Users\Repositories\UsersRepository;

class MembersController extends BaseController
{
    protected $us;
    public function __construct(UsersRepository $usersRepository)
    {
        $this->us = $usersRepository;
    }

    public function getIndex(){
        $m_online = auth('nqadmin')->user();
        $jorg = new \JOrgChart();
        $response = $jorg->getChart($m_online->id);

        $data = $this->us->scopeQuery(function($e) use ($m_online){
           return $e->orderBy('created_at','desc')->where('parent',$m_online->id);
        })->paginate(20);

        return view('nqadmin-members::components.index',[
            'user_online'=>$m_online,
            'tree'=>$response['tree_string'],
            'data'=>$data
        ]);
    }

    public function getCreate(){
        $myuser = auth('nqadmin')->user();
        return view('nqadmin-members::components.create',[
            'myuser'=>$myuser
        ]);
    }

    public function postCreate(MemberCreateRequest $request){
        $input = $request->except(['_token','continue_create']);
        $codename = $codename = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), -6);
        try{
            $userCreate = $this->us->create($input);
            //đồng bộ quyền member
            $userCreate->roles()->sync(['role'=>3]);
            //Cập nhật mã giới thiệu
            $upcode = ['code_name'=>$codename.$userCreate->id];
            $this->us->update($upcode,$userCreate->id);
            if ($request->has('continue_create')) {
				return redirect()->route('nqadmin::members.create.get')
                    ->with(FlashMessage::returnMessage('create'));
			}
			return redirect()->route('nqadmin::members.index.get')->with(FlashMessage::returnMessage('create'));
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function getEdit($id){
        $data = $this->us->find($id);
        return view('nqadmin-members::components.edit',[
            'data'=>$data
        ]);
    }

    public function postEdit($id,MemberEditRequest $request){
        $input = [];
        try{
            if($request->get('password')==null){
                $input = $request->except(['_token', 'email', 'password', 're_password']);
            }else{
                $input = $request->except(['_token','email']);
            }
            $this->us->update($input,$id);
            if($request->has('continue_edit')){
                return  redirect()->route('nqadmin::members.create.get')
                    ->with(FlashMessage::returnMessage('edit'));
            }
            return redirect()->route('nqadmin::members.index.get')
                ->with(FlashMessage::returnMessage('edit'));
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

}