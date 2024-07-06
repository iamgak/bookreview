<?php
global $link;

if(USER::$super){
    header("location:/admin/user_listing/");
    exit;
}
if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        switch ($key) {
            case 'email':
                if (empty($value)) {
                    $error[$key] = error_message('empty');
                } else {
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $error[$key] = error_message($key);
                    }
                }
                break;
            case 'password':
                if (empty($value)) {
                    $error[$key] = error_message($key);
                }
                break;
        }
    }
    //var_dump($error);

    if (empty($error)) {
        $email = $_POST['email'];
        $ip_addr =  $_SERVER['REMOTE_ADDR'];
        $password = $_POST['password'];
        $login_query = "SELECT `user_listing`.`id` FROM `user_listing`  
                        WHERE `email` = '$email' 
                        AND `password` = PASSWORD('$password') 
                        AND `active` = 1 AND `super` = 1";
        $login = $link->query($login_query);
        if ($login->num_rows) {
            $ldata = sha1(str_shuffle(uniqid()));
            $uid = $login->fetch_assoc()['id'];
            $update_query = "UPDATE `user_listing` SET `last_login` = NOW(), `login_token` = '$ldata' WHERE `id` = '$uid' ";
            setcookie('ldata',$ldata,time()+3600*24,'/');
            $link->query($update_query);
            if ($link->affected_rows == 0) {
                $error['invalid'] = error_message('unexpected_error');
            } else {
                $link->query("INSERT INTO `activity_log_user` (`uid`, `ip_addr`,`activity`) VALUES ('$uid','$ip_addr','" . activity['LOGGED_IN'] . "')");
                die(json_encode(['location' => '/admin/listing/']));
            }
        } else {
            $error['invalid'] = error_message('incorrect_credential');
        }
    }
    die(json_encode(['error' => $error]));
}

require($_SERVER['DOCUMENT_ROOT'] . '/temp/admin/login.php');
