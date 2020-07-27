<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/8/2018
 * Time: 11:48 AM
 */

namespace Transaction\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Shoping\Repositories\OrderRepositories;
use Shoping\Repositories\TransactionRepositories;
use function GuzzleHttp\Promise\all;

class TransactionController extends BaseController
{
    protected $tran;
    protected $or;

    public function __construct(TransactionRepositories $transactionRepository, OrderRepositories $orderRepositories)
    {
        $this->tran = $transactionRepository;
        $this->or = $orderRepositories;
    }

    public function getIndex()
    {
        $userid = Auth::id();
        $data = $this->tran->scopeQuery(function ($e) use ($userid){
            return $e->orderBy('created_at','desc')->where('user_id',$userid);
        })->paginate(20);
        return view('nqadmin-transaction::index', [
            'data' => $data
        ]);
    }

    public function getOrder($id)
    {
        $data = $this->tran->find($id);
        $order = $this->or->findWhere(['transaction_id'=>$id])->all();
        return view('nqadmin-transaction::order',['data'=>$data,'order'=>$order]);
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getStatus($id)
    {
        $data = [
            'status'=>'cancel'
        ];
        try{
            $this->tran->update($data,$id);
            return redirect()->back()->with(FlashMessage::returnMessage('cancel'));
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id)
    {
        return getDelete($id, $this->tran);
    }
}