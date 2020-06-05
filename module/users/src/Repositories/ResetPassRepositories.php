<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 9/24/2018
 * Time: 3:47 PM
 */

namespace Users\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;
use Users\Models\ResetPasswords;

class ResetPassRepositories extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.
       return ResetPasswords::class;
    }
}