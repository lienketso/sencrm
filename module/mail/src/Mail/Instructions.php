<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 20/09/2018
 * Time: 11:36
 */

namespace Mail\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Instructions extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@csgorankbooster.com')
            ->view('nqadmin-mail::templates.instructions')
            ->subject('Instructions')
            ->with([
                'type' => '',
                'start' => '',
                'desire' => '',
                'match' => '',
                'extra' => '',
                'coupon' => '',
                'coupon_description' => '',
                'price' => '',
                'owner' => '',
                'finalRank' => '',
                'finalMatch' => ''
            ]);
    }
}