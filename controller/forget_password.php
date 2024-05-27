<?php
global $link, $website_name;

$POST = file_get_contents('php://input');
$POST = json_decode($POST, true);

if (!empty($_POST)) {
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        die(json_encode(['error' => ['email' => error_message('email')]]));
    }

    if (empty($error)) {
        if ($link->query("SELECT count(*) AS `count` FROM `activity_log_other` WHERE  timestampdiff(day,created_at,now()) = 0 AND `activity` = '".activity['PASSWORD_RESET_REQUEST']."' AND `ip_addr` = '".$_SERVER['REMOTE_ADDR']."'")->fetch_assoc()['count'] >= MAX_ATTEMPT) {
        die(json_encode(['error' => ['invalid' => error_message('too_many')]]));        
        }

        $check_email_exist = $link->query("SELECT `id` FROM `register` WHERE `email` = '{$_POST['email']}'");
        if ($check_email_exist->num_rows > 0) {
            $uid = $check_email_exist->fetch_assoc()['id'];
            $activation_link = sha1($_SERVER['REMOTE_ADDR'] . time());
            $link->query("UPDATE `user_passw_change` SET `active` = 0 WHERE `uid` = '$uid'");
            $insert_query = "INSERT INTO user_passw_change(uid, activation_token) VALUES
                            ('$uid', '$activation_link' );";
            $link->query($insert_query);
        }
        
        $link->query("INSERT INTO `activity_log_other` ( `ip_addr`,`activity`) VALUES ('" . _MS($_SERVER['REMOTE_ADDR']) . "','" . activity['PASSWORD_RESET_REQUEST'] . "')");
        die(json_encode(['status' => true, 'message' => 'if you are registerd user you will get verify link on your email']));
    }
}

require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.head.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/forget_password.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.footer.php');
