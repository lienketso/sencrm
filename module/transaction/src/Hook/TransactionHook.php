<?php


namespace Transaction\Hook;


class TransactionHook
{
    public function hanlde(){
        echo view('nqadmin-transaction::partials.sidebar');
    }
}