<?php


namespace Shoping\Model;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = ['transaction_id','product_id','price','qty','amount'];
}