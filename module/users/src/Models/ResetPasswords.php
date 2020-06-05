<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 9/24/2018
 * Time: 3:45 PM
 */

namespace Users\Models;


use Illuminate\Database\Eloquent\Model;

class ResetPasswords extends Model
{
    protected $table = 'password_resets';
    protected $fillable = ['email','token','created_at'];
}