<?php 
global $link;
if(!USER::$super){
    header('location:/gin/');
    exit;
}

$genres = $link->query("SELECT * FROM `genre`");
$logged_in = $link->query("SELECT count(*) AS logged,uid FROM `activity_log_user` WHERE activity = '".activity['LOGGED_IN']."' GROUP BY(`uid`)");
$logged_out = $link->query("SELECT count(*) AS logged,uid FROM `activity_log_user` WHERE activity = '".activity['LOGGED_OUT']."' GROUP BY(`uid`)");
$comment = $link->query("SELECT count(*) AS `comment`, monthname(`created_at`) AS month FROM `activity_log_user` WHERE `activity` = '".activity['COMMENT_POSTED']."' GROUP by(month(`created_at`)); ");
$contact_us = $link->query("SELECT count(*) AS `contact_us`, monthname(`created_at`) AS month FROM `activity_log_user` WHERE `activity` = '".activity['LOGGED_IN']."' GROUP by(month(`created_at`)); ");
$new_user = $link->query("SELECT count(*) AS `new_user`, monthname(`created_at`) AS month FROM `activity_log_user` WHERE `activity` = '".activity['NEW_USER_REGISTERED']."' GROUP by(month(`created_at`)); ");
$user = [];
$user['users'] = $link->query("SELECT id, username FROM `register` ")->fetch_all(true);
//print_r($logged_out->fetch_all(true));
//print_r($logged_in->fetch_all(true));die;
foreach($logged_in as $log){
    $user['uid'][]=$log['uid'];
    $user['logged'][]=$log['logged'];
}
foreach($logged_out as $log){
    $user['logged_out'][] = $log['logged'];
}

foreach($comment as $log){
    $user['comment'][] = $log['comment'];
    $user['comment_month'][] = $log['month'];
}
foreach($contact_us as $log){
    $user['contact_us'][] = $log['contact_us'];
    $user['contact_us_month'][] = $log['month'];
}
foreach($new_user as $log){
    $user['new_user'][] = $log['new_user'];
    $user['new_user_month'][] = $log['month'];
}


require($_SERVER['DOCUMENT_ROOT'] . '/in/head.php');
require($_SERVER['DOCUMENT_ROOT'] . '/in/index.php');
require($_SERVER['DOCUMENT_ROOT'] . '/in/footer.php');
