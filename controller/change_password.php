<?php
global $link;
if (!USER::$logged)
    header('location:/my_blog/');

if (!empty($_POST)) {

    if (empty($_POST['password']))
        $error['password'] = error_message('empty');

    if (empty($_POST['repeat_password']))
        $error['repeat_password'] = error_message('empty');

    if (empty($error)) {
        if ($_POST['password'] != $_POST['repeat_password'])
            $error['repeat_password'] = error_message('not_match');
        if (empty($_POST['repeat_password']))
            $error['repeat_password'] = error_message('password');
    }
    if (empty($error)) {
        $update = "UPDATE `register` SET `password` = PASSWORD('" . _MS($_POST['password']) . "') WHERE `id` = '" . USER::$id . "'";
        $link->query($update);

        $link->query("INSERT INTO `activity_log_user` (`uid`, `ip_addr`,`activity`) VALUES ('" . USER::$id . "','" . _MS($_SERVER['REMOTE_ADDR']) . "','" . activity['PASSWORD_CHANGE'] . "')");

        die(json_encode(['status' => true, 'location' => '']));
    } else {
        die(json_encode(['error' => $error]));
    }
}

require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.head.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/change_password.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.footer.php');
