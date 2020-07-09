<?php


namespace Package\Model;


use Illuminate\Database\Eloquent\Model;

class ProductPackage extends Model
{
    protected $table = 'product_package';
    protected $fillable = ['product_id','package_id','price'];

    public function setPackagePriceAtribute($val){
        $this->attributes['package_price'] = str_replace(',','',$val);
    }


}