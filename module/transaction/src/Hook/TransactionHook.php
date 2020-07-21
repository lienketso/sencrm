<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/8/2018
 * Time: 11:18 AM
 */

namespace Transaction\Hook;

class TransactionHook
{
    public function handle()
    {
        echo view('nqadmin-transaction::partials.sidebar');
    }
}