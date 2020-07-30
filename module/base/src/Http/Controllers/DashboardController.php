<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/31/2017
 * Time: 11:56 PM
 */

namespace Base\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Users\Models\Users;
use Users\Repositories\UsersRepository;

class DashboardController extends BaseController
{
    protected $us;
    //language change
    public function Languages($lang){
        \Session::put('lang',$lang);
        return redirect()->back();
    }
    public function __construct(UsersRepository $usersRepository)
    {
        $this->us = $usersRepository;
    }

    public function getIndex()
    {
        $uid = Auth::id();
        $userLog = $this->us->find($uid);
        return view('nqadmin-dashboard::dashboard', [
            'userLog'=>$userLog
        ]);
    }
}