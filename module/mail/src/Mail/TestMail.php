<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 22/09/2018
 * Time: 09:53
 */

namespace Mail\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */


    public function __construct()
    {

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@csgorankbooster.com')
            ->view('nqadmin-mail::templates.test')
            ->subject('Test mail');
    }
}