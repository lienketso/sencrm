<?php


namespace Package\Hook;


class PackageHook
{
    public function hanlde(){
        echo view('nqadmin-package::partials.sidebar');
    }
}