<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 9/26/2018
 * Time: 1:42 PM
 */

namespace Mail\Mail;

use Illuminate\Mail\Mailable;

class ForgotPass extends Mailable
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build(){
        $data = $this->data;
        return $this->from('noreply@tailieunghe.com')
            ->view('nqadmin-mail::templates.forgot_pass')
            ->subject('Your Password Reset Link')->with(['token'=>$data['token']]);
    }

}