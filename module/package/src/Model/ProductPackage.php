<?php


namespace Package\Model;


use Illuminate\Database\Eloquent\Model;

class ProductPackage extends Model
{
    protected $table = 'product_package';
    protected $fillable = ['product_id','package_id','price'];

    public function setPriceAtribute($val){
        $this->attributes['price'] = str_replace(',','',$val);
    }

}