<?php


namespace Users\Models;


use Illuminate\Database\Eloquent\Model;

class UserRefferals extends Model
{
    protected $table = 'user_refferals';

    protected $fillable = ['referral_id','user_id','email','tries'];
}