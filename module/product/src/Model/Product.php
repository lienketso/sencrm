<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 11/21/2018
 * Time: 11:38 AM
 */

namespace Product\Model;


use Illuminate\Database\Eloquent\Model;
use Package\Model\Package;

class Product extends Model
{
    protected $table='product';
    protected $fillable = [ 'name', 'slug', 'code_name', 'excerpt', 'weight', 'price', 'discount', 'thumbnail', 'unit', 'status'];

    public function setPriceAttribute($val)
    {
        $this->attributes['price'] = str_replace(',','',$val);
    }
    public function setDiscountAttribute($val)
    {
        $this->attributes['discount'] = str_replace(',','',$val);
    }

    public function getPackage(){
        return $this->belongstoMany(Package::class,'product_package','product_id','package_id')->withPivot('package_price');
    }


}