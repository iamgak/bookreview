<?php
global $link;

if (!USER::$super) {
    header("location:/admin/login/");
    exit;
}   

$POST = file_get_contents('php://input');
$POST = json_decode($POST, true);
if (!empty($POST)) {
    switch ($POST) {
        case $POST['active']    :
            $uid = _MS($POST['uid']);
            $user = $link->query("SELECT `active` FROM `user_listing` WHERE `id` = $uid");
            if ($user->num_rows > 0) {

                if ($user->fetch_assoc()['active']==1) {
                    $active = 0;
                    $color = 'red';
                } else {
                    $active = 1;
                    $color ='green';
                }

                $update_query = "UPDATE `user_listing` SET `active` = '$active' WHERE `id` = $uid";
                $link->query($update_query);
                die(json_encode(['status' => true,'color'=>$color]));
            } else {
                die(json_encode(['error' => 'error']));
            }

            break;
        default:
            break;
    }

    die(json_encode(['error' => $error]));
}

$user_listing = $link->query("SELECT * FROM `user_listing`");

require($_SERVER['DOCUMENT_ROOT'] . '/temp/Admin/head.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/Admin/user_listing.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/Admin/footer.php');
