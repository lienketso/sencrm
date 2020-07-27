<?php
namespace Guest\Http\Controllers;
use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;
use Guest\Http\Requests\GuestRequest;
use Users\Repositories\UsersRepository;


class GuestController extends BaseController
{
    protected $us;
    public function __construct(UsersRepository $usersRepository)
    {
        $this->us = $usersRepository;
    }

    public function getIndex(){
        return view('guest::register');
    }
    public function postRegister(GuestRequest $request){
        $input = $request->except(['_token']);
        $affiliate = $request->get('affiliate');
        $codename = $codename = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), -6);
        try {
            $guest = $this->us->create($input);
            $guest->roles()->sync(['role'=>3]);
            //Cập nhật mã giới thiệu
            $update = [
                'code_name'=>$codename.$guest->id,
                'affiliate'=>$affiliate
            ];
            $this->us->update($update,$guest->id);
            return redirect()->back()->with(['message'=>'Đăng ký tài khoản thành công ! một tin nhắn được gửi đến email của bạn chứa đường link để kích hoạt tài khoản']);
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

}