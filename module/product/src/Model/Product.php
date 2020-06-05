<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 11/21/2018
 * Time: 11:38 AM
 */

namespace Product\Model;


use Category\Model\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='product';
    protected $fillable = ['category', 'name', 'slug', 'code_name', 'excerpt', 'content', 'price', 'discount', 'thumbnail', 'gallery', 'meta_title', 'meta_description', 'status','label','lang_code'];

    public function setPriceAttribute($val)
    {
        $this->attributes['price'] = str_replace(',','',$val);
    }
    public function setDiscountAttribute($val)
    {
        $this->attributes['discount'] = str_replace(',','',$val);
    }

    public function getCategoryInfo()
    {
        return $this->belongsTo(Category::class, 'category', 'id');
    }

}