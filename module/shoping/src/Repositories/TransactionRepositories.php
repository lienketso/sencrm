<?php


namespace Shoping\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;
use Shoping\Model\Transaction;

class TransactionRepositories extends BaseRepository
{
    public function model()
    {
        return Transaction::class;
    }

    public function getProfitByMonth($month)
    {
        return $this->scopeQuery(function ($q) use ($month) {
            return $q->where('status', 'success')->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', intval(date("Y")));
        })->all(['id', 'amount'])->sum('amount');
    }

    public function getOrderInMonth()
    {
        $month = intval(date("m"));
        return $this->scopeQuery(function ($q) use ($month) {
            return $q->where('payment', 'success')->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', intval(date("Y")));
        })->all(['id'])->count();
    }

}