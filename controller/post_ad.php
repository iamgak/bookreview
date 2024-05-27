<?php
global $link;
if(!USER::$logged){
    header('location:/login/');
    exit;
}

if (!empty($_POST)) {
    $data = $_POST;
    $error = check_err($data);
    //    die(json_encode([$data,$error]));
    if (empty($error)) {
        
        $ip_addr =  $_SERVER['REMOTE_ADDR'];
        $title = $_POST['title'];
        $sub_category = $_POST['sub_category'];
        $content = $_POST['content'];
        $category = $_POST['category'];
        $subject = $_POST['subject'];
        $uid = USER::$id;
        $title = $_POST['title'];
        $main_insert = "INSERT INTO `blog_list`(`title`,`content`,`uid`,`ip_addr`,`category`,`sub_category`,`subject`) VALUES ('$title','$content','$uid','$ip_addr','$category','$sub_category','$subject')";
        //echo $main_insert;die;
        $blog_listing = $link->query($main_insert);
        die(json_encode(['status' => true,'location'=>'post_ad']));
    } else {
        die(json_encode(['error' => $error]));
    }
}
$categories = $link->query("SELECT * FROM `blog_category`");
$sub_categories = $link->query("SELECT * FROM `blog_sub_category`");

require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.head.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/post_ad.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.footer.php');
