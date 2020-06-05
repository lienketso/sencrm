<?php
namespace Members\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;

class MembersController extends BaseController
{
    public function getIndex(){
        $m_online = auth('nqadmin')->user();
        $jorg = new \JOrgChart();
        $response = $jorg->getChart($m_online->id);
        return view('nqadmin-members::components.index',[
            'user_online'=>$m_online,
            'tree'=>$response['tree_string']
        ]);
    }

    public function getCreate(){
        return view('nqadmin-members::components.create');
    }

    public function postCreate(){

    }

    public function getEdit(){
        return view('nqadmin-members::components.edit');
    }

    public function postEdit(){

    }

}