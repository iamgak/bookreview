<?php
global $link, $website_name;

$POST = file_get_contents('php://input');
$POST = json_decode($POST, true);

if (!empty($POST)) {
    if (empty($POST['email']) || !filter_var($POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error['email'] = error_message('email');
    }

    if (empty($error)) {
        $check_email_exist = $link->query("SELECT `id` FROM `user_profile` WHERE `email` = '"._MS($POST['email'])."'");
        if ($check_email_exist->num_rows > 0) {
            $uid = $check_email_exist->fetch_assoc()['id'];
            $activation_token = sha1(time().$_SERVER['REMOTE_ADDR']);
            $insert_query = "INSERT INTO user_passw_change(uid, activation_token, ip_addr)
                            SELECT '$uid', '$activation_link', '".$_SERVER['REMOTE_ADDR']."' WHERE NOT EXISTS (
                            SELECT 1 FROM `last_passw_reset` WHERE `uid` = '$uid' AND (`datediff`(now(), created_at) < 1 ));";
            $link->query($insert_query);
        }

        $message = 'if you are registerd user you will get verify link on your email';
    }
}

require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.head.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/reset_password.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.footer.php');
