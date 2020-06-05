<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 19/09/2018
 * Time: 11:31
 */

namespace Mail\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;
use Illuminate\Http\Request;
use Mail\Repositories\MailRepository;

class MailController extends BaseController
{
    protected $mail;

    public function __construct(MailRepository $mailRepository)
    {
        $this->mail = $mailRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $mailTemplates = $this->mail->all([
           'id', 'name', 'type'
        ]);
        return view('nqadmin-mail::index', [
            'data' => $mailTemplates
        ]);
    }

    public function getCreate()
    {
        return view('nqadmin-mail::create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        $data = $request->except(['_token', 'q']);

        try {
            $mail = $this->mail->create($data);
            $this->mail->writeToBlade($data['type'], $data['content']);
            if ($request->has('continue_edit')) {
                return redirect()->route('nqadmin::mail.edit.get', [
                    'id' => $mail->id,
                ])->with(FlashMessage::returnMessage('create'));
            }

            return redirect()->route('nqadmin::mail.index.get')->with(FlashMessage::returnMessage('create'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit($id)
    {
        $mail = $this->mail->find($id);
        return view('nqadmin-mail::edit', [
            'mail' => $mail
        ]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit($id, Request $request)
    {
        $data = $request->except('_token', 'q');
        try {
            $this->mail->update($data, $id);
            $this->mail->writeToBlade($data['type'], $data['content']);
            return redirect()->back()->with(FlashMessage::returnMessage('edit'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id)
    {
        return getDelete($id, $this->mail);
    }
}