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
use Shoping\Repositories\TransactionRepositories;

class TransactionController extends BaseController
{
    protected $tran;

    public function __construct(TransactionRepositories $transactionRepository)
    {
        $this->tran = $transactionRepository;
    }

    public function getIndex()
    {
        $transaction = $this->tran->orderBy('created_at', 'desc')
            ->all(['id', 'package_id', 'amount', 'status', 'created_at']);
        return view('nqadmin-transaction::index', [
            'data' => $transaction
        ]);
    }

    public function getCreate()
    {
        return view('nqadmin-transaction::create');
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit($id)
    {
        $data = $this->tran->find($id);
        return view('nqadmin-transaction::edit', [
            'data' => $data
        ]);
    }

    /**
     * @param RankEditValidate $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $request, $id)
    {
        $status = $request->get('status');
        $data = [
            'status' => $status
        ];
        try {
            $this->tran->update($data, $id);
            return redirect()->route('nqadmin::transaction.index.get')->with(FlashMessage::returnMessage('create'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(config('messages.error'));
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