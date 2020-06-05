<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/13/2018
 * Time: 1:59 PM
 */

namespace Setting\Model;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'setting';
    protected $fillable = [
        'setting_key', 'setting_value'
    ];
}