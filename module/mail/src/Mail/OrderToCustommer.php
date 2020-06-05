<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 20/09/2018
 * Time: 11:29
 */

namespace Mail\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderToCustommer extends Mailable
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
        $data = $this->data;
        return $this->from('noreply@csgorankbooster.com')
            ->view('nqadmin-mail::templates.order_to_custommer')
            ->subject('New Order')
            ->with([
                'type' => $data['type'],
                'start' => $data['start'],
                'desire' => $data['desire'],
                'match' => $data['match'],
                'extra' => $data['extra'],
                'coupon' => $data['coupon'],
                'coupon_description' => $data['coupon_description'],
                'price' => $data['price'],
                'owner' => $data['owner'],
                'finalRank' => $data['finalRank'],
                'finalMatch' => $data['finalMatch']
            ]);

    }
}