<?php


namespace History\Model;


use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history';
    protected $fillable = ['user_id','request_name','request_uri','request_data','status','created_at','updated_at'];
}