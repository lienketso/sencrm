<?php


namespace History\Model;



use Illuminate\Database\Eloquent\Model;
use Users\Models\Users;

class History extends Model
{
    protected $table = 'history';
    protected $fillable = ['user_id','request_name','request_uri','request_data','status','created_at','updated_at'];

    public function getUsers(){
        return $this->belongsTo(Users::class,'user_id','id');
    }

}