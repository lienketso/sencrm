<?php


namespace Users\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;
use Users\Models\UserRefferals;

class UsersReferralRepositories extends BaseRepository
{
    public function model()
    {
        return UserRefferals::class;
    }
}