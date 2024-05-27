<?php
global $link;

if (USER::$logged) {
    header('location:/');
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
        
        if ($link->query("SELECT count(*) AS `count` FROM `activity_log_other` WHERE  timestampdiff(day,created_at,now()) = 0 AND `activity` = '".activity['INCORRECT_CREDENTIALS']."'AND `ip_addr`= '".$_SERVER['REMOTE_ADDR']."'")->fetch_assoc()['count'] > MAX_ATTEMPT) {
        die(json_encode(['error' => ['invalid' => error_message('too_many')]]));        
        }
        $login_query = "SELECT `id` FROM `register` WHERE `email` = '" . _MS($_POST['email']) . "' AND `password` = PASSWORD('" . _MS($_POST['password']) . "') AND `active` = 1";
        $login = $link->query($login_query);
        if ($login->num_rows > 0) {
            $ldata = sha1(time() . $_SERVER['REMOTE_ADDR']);
            $uid = $login->fetch_assoc()['id'];
            $update_query = "UPDATE `register` SET `last_login` = NOW(), `login_token` = '$ldata' WHERE `id` = '$uid' ";
            setcookie('ldata', $ldata, time() + 3600 * 24, '/');
            $link->query($update_query);
            if ($link->affected_rows == 0) {
                $error['invalid'] = error_message('unexpected_error');
            } else {
                $link->query("INSERT INTO `activity_log_user` (`uid`, `ip_addr`,`activity`) VALUES ('$uid','" . _MS($_SERVER['REMOTE_ADDR']) . "','" . activity['LOGGED_IN'] . "')");
                die(json_encode(['status' => true, 'location' => '']));
            }
        } else {
            $link->query("INSERT INTO `activity_log_other` ( `ip_addr`,`activity`) VALUES ('" . _MS($_SERVER['REMOTE_ADDR']) . "','" . activity['INCORRECT_CREDENTIALS'] . "')");

            $error['invalid'] = error_message('incorrect_credential');
        }
    }
    die(json_encode(['error' => $error]));
}

require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.head.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/login.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.footer.php');
