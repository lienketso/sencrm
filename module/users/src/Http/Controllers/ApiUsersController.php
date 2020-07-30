<?php


namespace Users\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiUsersController extends BaseController
{
    public function __construct(Request $request, LaravelDebugbar $debugbar)
    {
        parent::__construct($request, $debugbar);
    }

    function getUsers(Request $request){
        $keyword = $request->get('keyword');
        try {
            $result = DB::table('users')->where('fullname', 'like', '%' . $keyword . '%')->get();
            if (!empty($result)) {
                echo '<option value="0">Nhánh chính</option>';
                foreach ($result as $row) {
                    echo '<option value="' . $row->id . '">' . $row->fullname . '</option>';die;
                }
            } else {
                echo 'no result';die;
            }
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

}