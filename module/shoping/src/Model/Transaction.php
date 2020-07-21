<?php


namespace Shoping\Model;


use Illuminate\Database\Eloquent\Model;
use Package\Model\Package;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $fillable = ['user_id','package_id','amount','content','status'];

    public function getPackage(){
        return $this->belongsTo(Package::class,'package_id','id');
    }

}