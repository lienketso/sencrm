<?php

namespace Members\Hook;

class MembersHook
{
    public function handle(){
        echo view('nqadmin-members::partials.sidebar');
    }
}