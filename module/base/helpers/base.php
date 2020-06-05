<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/1/2017
 * Time: 8:53 AM
 */

use Base\Supports\FlashMessage;

if (!function_exists('is_in_dashboard')) {
    /**
     * @return bool
     */
    function is_in_dashboard()
    {
        $segment = request()->segment(1);
        if ($segment === config('SOURCE_ADMIN_ROUTE', 'admincp')) {
            return true;
        }

        return false;
    }
}

function tree($data,$tree,$level=0){
    if(!isset($tree[$level])) $tree[$level] = [];
    foreach($data as $key=>$value){
        if(is_array($value)){
            $tree[$level] = $key;
            tree($value,$tree,$level+1);
        }else{
            $tree[$level][] = $value;
        }
    }
}

function file_url(){
    return public_path().'/uploads/';
}

if (!function_exists('convert_status')) {
    function conver_status($status)
    {
        switch ($status) {
            case 'active' :
                return '<span class="status success">Hiển thị</span>';
                break;
            case 'disable' :
                return '<span class="status danger">Tạm ẩn</span>';
                break;
            default:
                return '<span class="status danger">Tạm ẩn</span>';
                break;
        }
    }
}

if (!function_exists('gallery_status')) {
    function gallery_status($status)
    {
        switch ($status) {
            case 'active' :
                return '<span class="status success">Hiển thị</span>';
                break;
            case 'disable' :
                return '<span class="status danger">Tạm ẩn</span>';
                break;
            case 'top' :
                return '<span class="status info">Hiển thị top</span>';
                break;
            case 'bottom' :
                return '<span class="status warning">Hiển thị bottom</span>';
            default:
                return '<span class="status danger">Tạm ẩn</span>';
                break;
        }
    }
}

if (!function_exists('product_status')) {
    function product_status($status)
    {
        switch ($status) {
            case 'active' :
                return '<span class="status success">Hiển thị</span>';
                break;
            case 'disable' :
                return '<span class="status danger">Tạm ẩn</span>';
                break;
            case 'hot' :
                return '<span class="status warning">Nổi bật</span>';
                break;
            case 'new' :
                return '<span class="status info">Mới</span>';
                break;
            case 'sale' :
                return '<span class="status success">Hot sale</span>';
                break;
            default:
                return '<span class="status danger">Tạm ẩn</span>';
                break;
        }
    }
}

if (!function_exists('convert_flash_message')) {
    function convert_flash_message($mess = 'create')
    {
        switch ($mess) {
            case 'create':
                $m = config('messages.success_create');
                break;
            case 'edit':
                $m = config('messages.success_edit');
                break;
            case 'delete':
                $m = config('messages.success_delete');
                break;
            default:
                $m = config('messages.success_create');
        }

        return $m;
    }
}

if (!function_exists('changeStatus')) {
    function changeStatus($id, $repository)
    {
        try {
            $record = $repository->find($id);
            $status = ($record->status == 'active') ? 'disable' : 'active';
            $repository->update([
                'status' => $status
            ], $id);

            return redirect()->back()->with(FlashMessage::returnMessage('edit'));
        } catch (\Exception $e) {
            Debugbar::addThrowable($e);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}

if (!function_exists('setFeatured')) {
    function setFeatured($id, $repository)
    {
        try {
            $record = $repository->find($id);
            $status = ($record->featured == 'active') ? 'disable' : 'active';
            $repository->update([
                'featured' => $status
            ], $id);

            return redirect()->back()->with(FlashMessage::returnMessage('edit'));
        } catch (\Exception $e) {
            Debugbar::addThrowable($e);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}

if (!function_exists('getDelete')) {
    function getDelete($id, $repository)
    {
        try {
            $repository->delete($id);
            return redirect()->back()->with(FlashMessage::returnMessage('delete'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}

if (!function_exists('getDeleteAll')) {
    function getDeleteAll($id, $repository)
    {
            $repository->delete($id);
    }
}

function cong($a,$b){
    return $a + $b;
}
function chia($a,$b){
    return $a / $b;
}


if(!function_exists('getParentInfo')){
    function getParentInfo($id, $repository){
        $info = $repository->find($id);
        if(!empty($info)) {
            echo $info->name;
        }else{
            echo 'Is parent';
        }
    }
}
if(!function_exists('getUserInfo')) {
    function getUserInfo($id, $repository)
    {
        $user_info = $repository->find($id);
        if (empty($user_info)) {
            echo 'Not user';
        } else {
            echo $user_info->first_name;
        }
    }
}


if (!function_exists('createThumbnailUrl')) {
    function createThumbnailUrl($thumb)
    {
        $arr = explode('/', $thumb);
        $last = end($arr);
        $folder = str_replace($last, "", $thumb);
        $thumbfolder = $folder.'thumbs/';
        return $thumbfolder.$last;
    }
}

if (!function_exists('renderPaymentStatus')) {
    function renderPaymentStatus($status)
    {
        switch ($status) {
            case 'pending':
                return 'Pending';
            case 'complete':
                return 'Completed';
            case 'paid':
                return 'Paid';
            case 'cancel':
                return 'Cancel';
            default:
                return $status;
        }
    }
}

if (!function_exists('renderOrderStatus')) {
    function renderOrderStatus($status)
    {
        switch ($status) {
            case 'waiting':
                return 'Waiting';
            case 'onwork':
                return 'On Working';
            case 'complete':
                return 'Completed';
            case 'refund':
                return 'Refund';
            default:
                return $status;
        }
    }
}

function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'năm',
        'm' => 'tháng',
        'w' => 'tuần',
        'd' => 'ngày',
        'h' => 'tiếng',
        'i' => 'phút',
        's' => 'giây',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' trước' : 'vừa xong';
}

function datetoformat($date=''){
    return date_format(new DateTime($date),'d/m/Y');
}

function datetoformat_full($date=''){
    return date_format(new DateTime($date),'d/m/Y - h:i:s');
}

function secToHR($seconds, $short = false)
{
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds / 60) % 60);
    $seconds = $seconds % 60;
    if (!$short)
        return "$minutes min, $seconds sec";
    else {
        $hours = $hours < 10 ? '0' . $hours : $hours;
        $minutes = $minutes < 10 ? '0' . $minutes : $minutes;
        $seconds = $seconds < 10 ? '0' . $seconds : $seconds;
        return "$hours:$minutes:$seconds";
    }
}

function humanTiming($time)
{

    $time = time() > $time ? time() - $time : $time - time(); // to get the time since that moment

    $tokens = array(
        31536000 => 'năm',
        2592000 => 'tháng',
        604800 => 'tuần',
        86400 => 'ngày',
        3600 => 'giờ',
        60 => 'phút',
    );

    $result = '';
    $counter = 1;
    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        if ($counter > 2) break;

        $numberOfUnits = floor($time / $unit);
        $result .= "$numberOfUnits $text ";
        $time -= $numberOfUnits * $unit;
        ++$counter;
    }

    return "{$result}";
}
