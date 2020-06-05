<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/13/2018
 * Time: 12:00 PM
 */

namespace Setting\Hook;

class SettingHook
{
    public function handle()
    {
        echo view('nqadmin-setting::partials.sidebar');
    }
}