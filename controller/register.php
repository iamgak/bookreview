<?php
global $link;
//print_r($_POST);die;
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
                if (!(bool)preg_match('/^\w+[\d\w@#$%]{3,7}$/', $value)) {
                    $error[$key] = error_message($key);
                }
                break;
            case 'username':
                if (empty($value)) {
                    $error[$key] = error_message('empty');
                } else if (!(bool)preg_match('/^\w[\w_@#$%]{3,10}$/', $value)) {
                    $error[$key] = error_message($key);
                }
                break;
            default:
                if (empty($value)) {
                    $error[$key] = error_message('empty');
                }
                break;
        }
    }

    if (empty($error['password']) && $_POST['password'] != $_POST['repeat_password']) {
        $error['repeat_password'] = error_message('not_match_password');
    }

    if (empty($error['username'])) {

        if (strlen($_POST['username']) > 15) {
            $error['username'] = error_message('too_long');
        } else if (strlen($_POST['username']) < 5) {
            $error['username'] = error_message('too_short');
        }
    }

    if (empty($error)) {
        $check_email_exist = $link->query("SELECT `username`,`email` FROM `user_listing` WHERE `user_listing`.`email` = '" . _MS($_POST['email']) . "' OR `user_listing`.`username` = '" . _MS($_POST['username']) . "'  ");
        if ($check_email_exist->num_rows > 0) {
            $check_email_exist = $check_email_exist->fetch_assoc();
            if ($_POST['email'] == $check_email_exist['email']) {
                $error['email'] = error_message('already_exist');
            } else if ($_POST['username'] == $check_email_exist['username']) {
                $error['username'] = error_message('username_exist');
            }
        }

        if (empty($error)) {
            $activation_token = sha1(time() . $_SERVER['REMOTE_ADDR']);
            $link->query("INSERT INTO `user_listing` (`email`,`password`,`username`,`activation_token`) VALUES ( '" . _MS($_POST['email']) . "', password('" . _MS($_POST['password']) . "'),'" . _MS($_POST['username']) . "','$activation_token')");
            $link->query("INSERT INTO `activity_log_user` (`uid`, `ip_addr`,`activity`) VALUES ('" . $link->insert_id . "','" . $_SERVER['REMOTE_ADDR'] . "','" . activity['NEW_USER_REGISTERED'] . "')");
            die(json_encode(['status' => true, 'location' => '/success/']));
        }
    }

    die(json_encode(['error' => $error]));
}

require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.head.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/register.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.footer.php');
