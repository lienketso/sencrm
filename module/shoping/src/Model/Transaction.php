<?php


namespace Shoping\Model;


use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $fillable = ['user_id','package_id','amount','content','status'];
}