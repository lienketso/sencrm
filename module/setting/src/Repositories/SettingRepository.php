<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/13/2018
 * Time: 2:10 PM
 */

namespace Setting\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Setting\Model\Setting;

class SettingRepository extends BaseRepository
{
    public function model()
    {
        return Setting::class;
    }

    public function getSettingMeta($key)
    {
        $data = collect(['setting_value' => '']);
        $setting = $this->findWhere(['setting_key' => $key], ['setting_value'])->first();
        if (!empty($setting)) {
            $data = $setting->setting_value;
        }
        return $data;
    }

    public function getAllSetting()
    {
        $settings = $this->all([
            'setting_key', 'setting_value'
        ]);

        $result = [];

        foreach ($settings as $s) {
            $result[$s->setting_key] = $s->setting_value;
        }

        return $result;
    }
}