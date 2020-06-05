<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 20/09/2018
 * Time: 11:38
 */

namespace Mail\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderComplete extends Mailable
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
        return $this->from('noreply@autolight.vn')
            ->view('nqadmin-mail::templates.order_complete')
            ->subject('Đặt hàng thành công ! Autolight.vn')->with([
                'orderData' => $data['orderData'],
                'plan_name'=>$data['planname'],
                'amount'=>$data['amount'],
                'payment_type'=>$data['payment_type'],
                'description'=>$data['description'],
                'order_at'=>$data['orderat'],
                'name'=>$data['name'],
                'email'=>$data['email'],
                'phone'=>$data['phone'],
                'address'=>$data['address']
            ]);

    }
}