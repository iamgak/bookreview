<?php
global $link;
if (!USER::$logged) {
    header('location:/login/');
    exit;
}

$uid = USER::$id;
if (!empty($_POST)) {
    $data = $_POST;
    $error = check_err($data);
    if (empty($error)) {
        $input_query = "";
        $output_query = "";
        $update_query = "";
        foreach ($data as $key => $value) {
            $key = _MS($key);
            $value = ucfirst(_MS($value));

            if (empty($pid)) {
                $input_query .= empty($input_query) ? "`$key`" : ",`$key`";
                $output_query .= empty($output_query) ? "'$value'" : ",'$value'";
            } else {
                $update_query .= empty($update_query) ? "`$key`='$value'" : ",`$key`='$value'";
            }
        }
        if (empty($pid)) {
            $query =  "INSERT INTO `user_reviews`($input_query,`uid`) VALUES ($output_query,'$uid')";
            $action = 'REVIEW_POSTED';
        } else {
            $action = 'REVIEW_EDITED';
            $query = "UPDATE `user_reviews` SET $update_query WHERE `id` = '$pid'";
        }
        $link->query($query);
        $ip_addr =  $_SERVER['REMOTE_ADDR'];
        $link->query("INSERT INTO `activity_log_user` (`uid`, `ip_addr`,`activity`) VALUES ('$uid','$ip_addr','" . activity[$action] . "')");
        die(json_encode(['status' => true, 'location' => 'post_ad']));
        die;
    } else {
        die(json_encode(['error' => $error]));
    }
}

if (!empty($pid)) {
    //echo $pid;die;
    $query = "SELECT * FROM `user_reviews` WHERE `id` = '$pid' AND `active` = 1";
    $edit_review = $link->query($query)->fetch_assoc();
    //print_r($edit_review);die;
}
$genres = $link->query("SELECT * FROM `genre`");

require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.head.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/user_review.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.footer.php');
