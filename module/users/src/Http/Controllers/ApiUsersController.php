<?php


namespace Users\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiUsersController extends BaseController
{
    function getUsers(Request $request){
        $result = [];
        $keyword = $request->get('keyword');
        $result = DB::table('users')->where('fullname','like','%'.$keyword.'%')->get();
        if(!empty($result)){
            echo '<option value="0">Nhánh chính</option>';
        foreach($result as $row){
            echo '<option value="'.$row->id.'">'.$row->fullname.'</option>';
        }
        }else{
            echo 'no result';
        }
    }
}