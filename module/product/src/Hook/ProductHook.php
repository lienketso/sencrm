<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 8/29/2018
 * Time: 10:14 AM
 */

namespace Product\Hook;


class ProductHook
{
    public function handle()
    {
        echo view('nqadmin-product::partials.sidebar');
    }
}