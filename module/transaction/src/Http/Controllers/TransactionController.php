<?php


namespace Transaction\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Barryvdh\Debugbar\LaravelDebugbar;
use Illuminate\Http\Request;

class TransactionController extends BaseController
{
    public function __construct(Request $request, LaravelDebugbar $debugbar)
    {
        parent::__construct($request, $debugbar);
    }

    public function getIndex(){
        return view('nqadmin-transaction::index');
    }

}