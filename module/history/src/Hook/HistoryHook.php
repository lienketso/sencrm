<?php


namespace History\Hook;


class HistoryHook
{
    public function handle(){
        echo view('nqadmin-history::partials.sidebar');
    }
}