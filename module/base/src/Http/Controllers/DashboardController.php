<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/31/2017
 * Time: 11:56 PM
 */

namespace Base\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Support\Facades\Mail;
use Users\Models\Users;
use Users\Repositories\UsersRepository;

class DashboardController extends BaseController
{
    //language change
    public function Languages($lang){
        \Session::put('lang',$lang);
        return redirect()->back();
    }

    public function getIndex(UsersRepository $usersRepository)
    {

        return view('nqadmin-dashboard::dashboard', [
        ]);
    }
}