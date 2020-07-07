<?php

namespace Package\Model;

use Illuminate\Database\Eloquent\Model;
use Product\Model\Product;

class Package extends Model
{
    protected $table = 'package';
    protected $fillable = ['name','price','discount','content','is_order','status'];


    public function setPriceAttribute($val)
    {
        $this->attributes['price'] = str_replace(',','',$val);
    }
    public function setDiscountAttribute($val)
    {
        $this->attributes['discount'] = str_replace(',','',$val);
    }

    public function getProduct(){
        return $this->hasMany(Product::class,'product_id','id');
    }

}