<?php


if (!function_exists('stylistHelperFileRenameWithCurrentDateTime')) {
    /**
     * Return the csv_import_limit
     */
    function stylistHelperFileRenameWithCurrentDateTime($file_name)
    {
        $replace = '_'.date('dmyHms').'.';
        $search = '.';
       $pos = strrpos($file_name, $search);

        if($pos !== false)
        {
            $file_name = substr_replace($file_name, $replace, $pos, strlen($search));
        }
        $file_name = str_replace(' ', '-', $file_name);

        return $file_name;
    }
}



if (!function_exists('stylistGetLoader')) {
    /**
     * Return the csv_import_limit
     */
    function stylistGetLoader($param = '')
    {
      $html = '<div class="stf_outer_body stylist_loader_outer"><span class="stylist_loader_inner"></span></div>';

        return $html;
    }
}

if (!function_exists('getUserDetailsByEmail')) {
    function getUserDetailsByEmail($email = ''){

        $profile_img_url = url('images/stylist/dummy-profile-pic.png');
        $data = null;
        $user_info = Customer::where('email',$email)->first();
        if($user_info){
            $user_id = $user_info->id;
            $user_img = Image::where('imageable_id', '=', $user_id)->where('imageable_type', '=', 'App\Models\Customer')->first();
            if($user_img){
                $profile_img_url = url('image/'.$user_img->path);
            }
            $data['user_info'] = $user_info->toArray();
        }
        return $data;
    }
}

if (!function_exists('stylistFieldValidate')) {
    function stylistFieldValidate($data = ''){

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

if (!function_exists('stylistShowSendMailNextRevealBeforeDayHelper')) {
    function stylistShowSendMailNextRevealBeforeDayHelper($data = ''){
            return 47;
    }
}

if (!function_exists('stylistShowPreviousRevealBeforeDayHelper')) {
    function stylistShowPreviousRevealBeforeDayHelper($data = ''){
            return 0;
    }
}


if (!function_exists('stylistRevealChangeStatusFromDispatchToCompleteAfterDayHelper')) {
    function stylistRevealChangeStatusFromDispatchToCompleteAfterDayHelper($data = ''){
            return 0;
    }
}


if (!function_exists('stylistRevealResetStatusAfterDayHelper')) {
    function stylistRevealResetStatusAfterDayHelper($data = ''){
            return 90;
    }
}


if (!function_exists('stylistNotifyCustomerIfNotBookAnyStylistAfterDayHelper')) {
    function stylistNotifyCustomerIfNotBookAnyStylistAfterDayHelper($data = ''){
            return 14;
    }
}


if (!function_exists('stylistResetRevealAfterDispatchDayHelper')) {
    function stylistResetRevealAfterDispatchDayHelper($data = ''){
            return 14;
    }
}


if (!function_exists('getRevealStatusKeyNameHelper')) {

    function getRevealStatusKeyNameHelper($key = ''){

        $list = array();
        $list['awaiting_response'] =  'awaiting_response';
        $list['draf'] =  'draf';
        $list['draft'] =  'draft';
        $list['preparing_order'] =  'preparing_order';
        $list['dispatched'] =  'dispatched';
        $list['return_initiated'] =  'return_initiated';
        $list['not_started'] =  'not_started';
        $list['completed'] =  'completed';
        $list['decline'] =  'decline';
        $list['sent'] =  'sent';
        $list['retail_collection'] =  'retail_collection';
        $list['add_to_cart'] =  'Add To Cart';

        $status = '';
        if(isset($list[$key])){
            $status = $list[$key];
        }
        return $status;
    }
}


if (!function_exists('getRevealStatusNameHelper')) {

    function getRevealStatusNameHelper($key = ''){

        $list = array();
        $list['awaiting_response'] =  'Awaiting Response';
        $list['draft'] =  'Draft';
        $list['preparing_order'] =  'Preparing Order';
        $list['dispatched'] =  'Dispatched';
        $list['return_initiated'] =  'Return Initiated';
        $list['not_started'] =  'Not Started';
        $list['completed'] =  'Completed';
        $list['decline'] =  'Decline';
        $list['sent'] =  'Sent';
        $list['retail_collection'] =  'RETAIL COLLECTION ';
        $list['add_to_cart'] =  'Add To Cart';

        $status_name = '';
        if(isset($list[$key])){
            $status = $list[$key];
        }
        return $status_name;
    }
}



if (!function_exists('getRevealOrderStatusChangeFromDispatchHelper')) {

    function getRevealStatusNotChangeFromDispatchHelper($number = ''){
        $list = array();
        $list['STATUS_CANCELED'] =  8;
        $list['STATUS_RETURNED'] =  7;
        $list['STATUS_CONFIRMED'] =  3;
        $list['STATUS_FULFILLED'] =  4;
        $list['STATUS_DISPUTED'] =  9;
        $list['STATUS_DELIVERED'] =  6;
        return $list;
    }
}



if (!function_exists('getOrderStatusListHelper')) {

    function getOrderStatusListHelper($number = ''){
        $list = array();
        $list['STATUS_CANCELED'] =  8;
        $list['STATUS_RETURNED'] =  7;
        $list['STATUS_CONFIRMED'] =  3;
        $list['STATUS_FULFILLED'] =  4;
        $list['STATUS_DISPUTED'] =  9;
        $list['STATUS_DELIVERED'] =  6;
        return $list;
    }
}

if (!function_exists('getOrderStatusNumberByKeyListHelper')) {

    function getOrderStatusNumberByKeyListHelper($key = ''){
        $list = getOrderStatusListHelper();
        $order_status_number = 0;
        if(isset($list[$key])){
            $order_status_number = $list[$key];
        }
        return $order_status_number;
    }
}

