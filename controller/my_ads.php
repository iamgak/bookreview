<?php
global $link;

$POST = file_get_contents('php://input');
$POST = json_decode($POST, true);
if(!USER::$logged){
    header("location:'/login/");
    exit;
}

$uid = USER::$id;
if (!empty($POST)) {
    if (!USER::$logged) {
        die(json_encode(['logged' => true]));
    } elseif (!empty($POST['comment'])) {
        $uid = USER::$id;
        $pid = $POST['review_id'];
        $comment = _MS($POST['comment']);
        $reply = "INSERT INTO `comment` (`uid`,`pid`,`comment`) SELECT '$uid','$pid','$comment' WHERE EXISTS (SELECT 1 FROM `user_reviews` WHERE `id` = '$pid')";
        //echo $reply;die;
        $link->query($reply);
        $ip_addr =  $_SERVER['REMOTE_ADDR'];
        $link->query("INSERT INTO `activity_log_user` (`uid`, `ip_addr`,`activity`) VALUES ('$uid','$ip_addr','" . activity['COMMENT_POSTED'] . "')");
        die(json_encode(['status' => true]));
    } elseif (!empty($POST['search_query'])) {
        $search_query = preg_replace('/\s|\+/', '+', $POST['search_query']);
        $search_query = _MS($POST['search_query']);
        die(json_encode(['status' => true, 'location' => $search_query]));
    }
}

$search_query = '';
if (!empty($search_uri)) {
    $search_uri = _MS($search_uri);
    $search_uri1 = $search_uri;

    $search_uri = preg_replace('/\s|\+/', "','", $search_uri);

    $search_query = "AND (`user_reviews`.`book_name` IN ( '$search_uri' ) 
    OR `user_reviews`.`title` IN ( '$search_uri' ) 
    OR `user_reviews`.`author` IN ( '$search_uri' ) 
    OR `user_reviews`.`comment` IN ( '$search_uri' )
     OR `genre`.`slug` IN ( '$search_uri')
     OR `user_reviews`.`title` LIKE '%$search_uri%'
     OR `user_reviews`.`book_name` LIKE '%$search_uri%'
     OR `user_reviews`.`author` LIKE '%$search_uri%'
     OR `user_reviews`.`comment` LIKE '%$search_uri%'
     )";
    //echo $search_query;die;
}



$blog_listing = "SELECT `user_reviews`.*, `genre`.`name` AS `genre`  FROM `user_reviews`
INNER JOIN `genre` ON `genre`.`id` = `user_reviews`.`genre`
WHERE `user_reviews`.`active` = 1 $search_query AND `uid` = '$uid '
";
//echo $blog_listing;die;
$blogs = $link->query($blog_listing);
if ($blogs->num_rows > 0) {
    $blogs = $blogs->fetch_all(true);
    $count_comment =    $link->query("SELECT COUNT(`id`) FROM `comment`");
    if ($count_comment->num_rows > 0) {

        for ($i = 0; $i < count($blogs); $i++) {
            $pid = $blogs[$i]['id'];
            $blogs[$i]['comments'] = $link->query("SELECT * FROM `comment` WHERE `pid` = '$pid'")->fetch_all(true);
        }
    }
}
require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.head.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/review_listing.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.footer.php');
