<?php


namespace Shoping\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;
use Shoping\Model\Order;

class OrderRepositories extends BaseRepository
{
    public function model()
    {
        return Order::class;
    }
}