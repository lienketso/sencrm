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
}