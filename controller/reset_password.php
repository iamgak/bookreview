<?php global $link;
$valid_link = "SELECT `id`,`uid` FROM `user_passw_change` WHERE `activation_token` = '$activation_token' AND `active` = 1";
//echo $valid_link;die;
$user = $link->query($valid_link);

if ($user->num_rows == 0) {
    $this->error404();
    exit;
}

$error= [];
if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        switch ($key) {
            case 'repeat_password':
                if (empty($value)) {
                    $error[$key] = error_message('empty');
                }else{
                    if($_POST['repeat_password']!=$_POST['password']){
                    $error[$key] = error_message('not_match');
                    }
                }
                break;
            case 'password':
                if (!(bool)preg_match('/^\w+[\d\w@#$%]{3,7}$/', $value)) {
                    $error[$key] = error_message($key);
                }
                break;
        }
    }

    if (empty($error['password']) && $_POST['password'] != $_POST['repeat_password']) {
        $error['repeat_password'] = error_message('not_match_password');
    }


    if (empty($error)) {
        if ($link->query("SELECT count(*) AS `count` FROM `activity_log_other` WHERE  timestampdiff(day,created_at,now()) = 0 AND `activity` = '".activity['PASSWORD_RESET_REQUEST']."'")->fetch_assoc()['count'] > MAX_ATTEMPT) {
        die(json_encode(['error' => ['invalid' => error_message('too_many')]]));        
        }
        $user = $user->fetch_assoc()['uid'];
        $link->query("UPDATE `register` SET `password` = password('"._MS($_POST['password'])."') WHERE `id` = '".$user."'");
        $reset_query = "UPDATE `user_passw_change` SET`active` = 0 WHERE `uid` = '$user' ";
        $link->query($reset_query);
        if($link->affected_rows ==0){
            $error['invalid'] = error_message('incorrect_credential');
        }else{

            $link->query("INSERT INTO `activity_log_other` ( `ip_addr`,`activity`) VALUES ('" . _MS($_SERVER['REMOTE_ADDR']) . "','" . activity['PASSWORD_RESET'] . "')");
            die(json_encode(['status' => true, 'message' => 'if you are registerd user you will get verify link on your email']));
        }

    }

    die(json_encode(['error' => $error]));        

}

/*
$user_detail = $validate_user->fetch_assoc();
$activation_id = $user_detail['id'];
$ip_addr =  $_SERVER['REMOTE_ADDR'];

$link->query("UPDATE `register` SET `active` = 1 WHERE `id` = $activation_id");
$insert_user_detail = "INSERT INTO `user_profile`(`email`,`password`,`ip_addr`) VALUES('{$user_detail['email']}','{$user_detail['password']}','$ip_addr')";
echo $insert_user_detail;
$link->query($insert_user_detail);
*/
require($_SERVER['DOCUMENT_ROOT'].'/p');
require($_SERVER['DOCUMENT_ROOT'].'/ord.php');
require($_SERVER['DOCUMENT_ROOT'].'/php');

