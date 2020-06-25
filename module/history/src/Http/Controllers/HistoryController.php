<?php


namespace History\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use History\Repositories\HistoryRepositories;


class HistoryController extends BaseController
{
    protected $his;
    public function __construct(HistoryRepositories $historyRepositories)
    {
        $this->his = $historyRepositories;
    }

    public function getIndex(){
        $data = $this->his->orderBy('id','desc')->paginate(10);
        return view('nqadmin-history::index',['data'=>$data]);
    }
    public function getView($id){
        $data = $this->his->find($id);
        return view('nqadmin-history::view',['data'=>$data]);
    }

}