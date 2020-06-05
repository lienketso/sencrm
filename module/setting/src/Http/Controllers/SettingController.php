<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/13/2018
 * Time: 1:56 PM
 */

namespace Setting\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;
use Illuminate\Http\Request;
use Post\Repositories\PostRepository;
use Setting\Repositories\SettingRepository;

class SettingController extends BaseController
{
    protected $setting;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->setting = $settingRepository;
    }

    /**
     * @param $data
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function saveSetting($data)
    {
        foreach ($data as $key => $d) {
            $this->setting->updateOrCreate([
                'setting_key' => $key
            ], [
                'setting_value' => $d
            ]);
        }

    }

    public function getSiteSetting(PostRepository $postRepository)
    {
        return view('nqadmin-setting::site');
    }

    public function getContentSetting()
    {
        return view('nqadmin-setting::content');
    }

    public function getFunfactSetting()
    {
        return view('nqadmin-setting::funfact');
    }

    public function getPaymentSetting(){
        return view('nqadmin-setting::payment');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function postSetting(Request $request)
    {
        $data = $request->except('_token');
        $this->saveSetting($data);
        return redirect()->back()->with(FlashMessage::returnMessage('edit'));
    }
}