<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 19/09/2018
 * Time: 11:32
 */

namespace Mail\Model;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    protected $table = 'mail';

    protected $fillable = [
        'name', 'content', 'created_at', 'updated_at', 'type'
    ];
}