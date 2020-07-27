<?php


namespace Shoping\Model;


use Illuminate\Database\Eloquent\Model;
use Product\Model\Product;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = ['transaction_id','product_id','price','qty','amount'];

    public function getProduct(){
        return $this->belongsTo(Product::class,'product_id','id');
    }

}