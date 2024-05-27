<?php
global $link, $website_name;


if (!USER::$logged) {
    header('location:/login/');
    exit;
}

$uid = USER::$id;
if (!empty($_POST)) {
    //    print_r($_POST);die;
    foreach ($_POST as $key => $value) {
        switch ($key) {
            case 'first_name' || 'last_name':
            case 'phone':

                if (empty($value)) {
                    $error[$key] = error_message('empty');
                }
                break;
        }
    }

    if (empty($error)) {
        $first_name = _MS($_POST['first_name']);
        $last_name = _MS($_POST['last_name']);
        $phone = _MS($_POST['phone']);
        $ip_addr =  $_SERVER['REMOTE_ADDR'];
        $user_exist = $link->query("SELECT `id` FROM `user_profile` WHERE `uid` = '$uid'");
        if ($user_exist->num_rows == 0) {
            $link->query("INSERT INTO `user_profile` (`first_name`,`last_name`,`phone`,`uid`) VALUES('$first_name','$last_name','$phone','$uid')");
            $activity = activity['PROFILE_CREATED'];
        } else {
            $activity = activity['PROFILE_UPDATED'];
            $link->query("UPDATE `user_profile` SET `first_name` = '$first_name', `last_name` = '$last_name', `phone` = '$phone' WHERE `uid` = '$uid'");
        }
        $link->query("INSERT INTO `activity_log_user` (`uid`, `ip_addr`,`activity`) VALUES ('$uid','$ip_addr','" . activity['PROFILE_UPDATED'] . "')");
        die(json_encode(['status' => true, 'location' => 'edit_profile']));
    } else {
        die(json_encode(['error' => $error]));
    }
}

$user_detail = $link->query("SELECT `first_name`,`last_name`,`phone` FROM `user_profile` WHERE `uid` = '$uid'")->fetch_assoc();
//var_dump($user_detail);die;

require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.head.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/edit_profile.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.footer.php');
