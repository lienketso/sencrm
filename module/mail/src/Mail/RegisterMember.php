<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 9/24/2018
 * Time: 10:37 AM
 */

namespace Mail\Mail;


use Illuminate\Mail\Mailable;

class RegisterMember extends Mailable
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build(){
        $data = $this->data;
        return $this->from('noreply@tailieunghe.com')
            ->view('nqadmin-mail::templates.register_success')
            ->subject('Register successful')->with(['token'=>$data['token']]);
    }

}