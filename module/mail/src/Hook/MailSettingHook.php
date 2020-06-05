<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 22/09/2018
 * Time: 10:57
 */

namespace Mail\Hook;

class MailSettingHook
{
    public function handle()
    {
        echo view('nqadmin-mail::partials.setting');
    }
}