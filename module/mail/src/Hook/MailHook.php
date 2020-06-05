<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 19/09/2018
 * Time: 11:09
 */

namespace Mail\Hook;


class MailHook
{
    public function handle()
    {
        echo view('nqadmin-mail::partials.sidebar');
    }
}