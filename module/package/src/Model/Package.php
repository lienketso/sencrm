<?php

namespace Package\Model;

use Illuminate\Database\Eloquent\Model;
use Product\Model\Product;

class Package extends Model
{
    protected $table = 'package';
    protected $fillable = ['name','price','description','content','is_order', 'type','status'];


    public function setPriceAttribute($val)
    {
        $this->attributes['price'] = str_replace(',','',$val);
    }

    public function getProduct(){
        return $this->belongstoMany(Product::class,'product_package','package_id','product_id')
            ->withPivot('package_price');
    }


}