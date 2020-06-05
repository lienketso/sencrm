<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 19/09/2018
 * Time: 11:32
 */

namespace Mail\Repositories;

use Mail\Model\Mail as MailModel;
use Prettus\Repository\Eloquent\BaseRepository;
use Mail;
use Mail\Mail\BoosterToAdmin;
use Mail\Mail\BoosterToCustommer;
use Mail\Mail\Instructions;
use Mail\Mail\OrderComplete;
use Mail\Mail\OrderToAdmin;
use Mail\Mail\OrderToCustommer;
use Mail\Mail\TestMail;
use Mail\Mail\RegisterMember;
use Mail\Mail\ForgotPass;

class MailRepository extends BaseRepository
{
    protected $adminMail;

    protected $custommerMail;

    public function model()
    {
        // TODO: Implement model() method.
        return MailModel::class;
    }

    /**
     * @param $type
     * @param $content
     */
    public function writeToBlade($type, $content)
    {
        $path = view('nqadmin-mail::templates.'.$type)->getPath();
        $myfile = fopen($path, "w") or die("Unable to open file!");
        fwrite($myfile, $content);
        fclose($myfile);
    }

    /**
     * @param $temp
     * @param $target
     * @param $data
     */
    public function sendMail($temp, $target, $data)
    {
        switch ($temp) {
            case 'forgot_pass':
                Mail::to($target)->send(new ForgotPass($data));
                break;
            case 'register_succes':
                Mail::to($target)->send(new RegisterMember($data));
                break;
            case 'booster_to_custommer':
                Mail::to($target)->send(new BoosterToCustommer($data));
                break;
            case 'instructions':
                Mail::to($target)->send(new Instructions($data));
                break;
            case 'order_complete':
                Mail::to($target)->send(new OrderComplete($data));
                break;
            case 'order_to_admin':
                Mail::to($target)->send(new OrderToAdmin($data));
                break;
            case 'order_to_custommer':
                Mail::to($target)->send(new OrderToCustommer($data));
                break;
            default:
                Mail::to($target)->send(new TestMail());
        }
    }

    /**
     * @param $data
     * @return array
     */
    public function mailRender($data)
    {
        $orderExtra = '';
        $oderCurrentRank = '';
        $orderCurrentMath = '';
        switch ($data['order_type']) {
            case 'match':
                $orderType = 'Placement Matches';
                break;
            case 'win':
                $orderType = 'Win Boosting';
                break;
            default:
                $orderType = 'Transaction Boosting';
        }

        $orderStartRank = !empty(json_decode(json_decode($data['order_start_rank']))) ? json_decode(json_decode($data['order_start_rank']))->name : '';
        $orderDesireRank = !empty(json_decode(json_decode($data['order_desire_rank']))) ? json_decode(json_decode($data['order_desire_rank']))->name : '';
        $orderMatch = $data['order_match'];
        $orderPrice = '$'.$data['order_price'];
        $orderCoupon = $data['order_coupon'];
        $orderCouponDescription = $data['order_coupon_description'];

        if (isset($data['order_current_rank'])) {
            $oderCurrentRank = !empty(json_decode(json_decode($data['order_current_rank']))) ? json_decode(json_decode($data['order_current_rank']))->name : '';
        }

        if (isset($data['order_current_match'])) {
            $orderCurrentMath = $data['order_current_match'];
        }

        $extraArray = json_decode(json_decode($data['order_extra']));
        if (!empty($extraArray)) {
            foreach ($extraArray as $e) {
                $orderExtra .= $e->name.' ';
            }
        }

        $render = [
            'type' => $orderType,
            'start' => $orderStartRank,
            'desire' => $orderDesireRank,
            'match' => $orderMatch,
            'extra' => $orderExtra,
            'coupon' => $orderCoupon,
            'coupon_description' => $orderCouponDescription,
            'price' => $orderPrice,
            'owner' => $data['owner_name'],
            'finalRank' =>  $oderCurrentRank,
            'finalMatch' => $orderCurrentMath
        ];

        return $render;
    }
}