<?php
/**
 * Created by PhpStorm.
 * User: Wiseman
 * Date: 6/8/2019
 * Time: 12:56 PM
 */

namespace Product\Model;

use Illuminate\Database\Eloquent\Model;

class ImageProduct extends Model
{
    protected $table = 'image_product';
    protected $fillable = ['product_id','thumbnail'];
}