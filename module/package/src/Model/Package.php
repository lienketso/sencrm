<?php

namespace Package\Model;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'package';
    protected $fillable = ['name','price','content','is_order','status'];


    public function setPriceAttribute($val)
    {
        $this->attributes['price'] = str_replace(',','',$val);
    }

}