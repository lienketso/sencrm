<?php


namespace Package\Repositories;


use Package\Model\Package;
use Prettus\Repository\Eloquent\BaseRepository;

class PackageRepositories extends BaseRepository
{
    public function model(){
        return Package::class;
    }
}