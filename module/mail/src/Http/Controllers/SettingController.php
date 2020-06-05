<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 22/09/2018
 * Time: 11:03
 */

namespace Mail\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use Mail\Repositories\MailRepository;

class SettingController extends BaseController
{
    public function getMailSetting()
    {
        return view('nqadmin-mail::setting.mail');
    }

    /**
     * @param Request $request
     * @param MailRepository $mailRepository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postMailSetting(Request $request, MailRepository $mailRepository)
    {
        $address = $request->get('test_mail_address');
        try {
            $mailRepository->sendMail('test', $address, []);

            return redirect()->back()->with([
                'flash_message' => 'Mail test successful'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}