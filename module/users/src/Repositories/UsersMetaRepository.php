<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/7/2018
 * Time: 10:11 AM
 */

namespace Users\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Users\Models\UsersMeta;

class UsersMetaRepository extends BaseRepository
{
    public function model()
    {
        return UsersMeta::class;
    }
    public function getMeta($key,$id)
    {
        $data = collect(['meta_value' => '']);
        $setting = $this->findWhere(['meta_key' => $key,'users_id'=>$id], ['meta_value'])->first();
        if (!empty($setting)) {
            $data = $setting->meta_value;
        }
        return $data;
    }

}