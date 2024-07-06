<?php
global $link;

$POST = file_get_contents('php://input');
$POST = json_decode($POST, true);

if (!empty($POST)) {
    if (!USER::$logged) {
        die(json_encode(['logged' => true]));
    } elseif (!empty($POST['comment'])) {
        $uid = USER::$id;
        $pid = $POST['review_id'];
        $comment = _MS($POST['comment']);
        $reply = "INSERT INTO `comment` (`uid`,`pid`,`comment`) SELECT '$uid','$pid','$comment' WHERE EXISTS (SELECT 1 FROM `user_reviews` WHERE `id` = '$pid')";
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
if (!empty($_POST['search'])) {

    header("location:/review_listing/" . makeSlug($_POST['search']) . '/');
    exit;
}


$search_query = '';
if (!empty($search_uri)) {
    $search_uri = _MS($search_uri);

    foreach (explode('-', $search_uri) as $uri_part) {
        if (!empty($search_query))
            $search_query .= " OR ";
        $search_query .= " (`user_reviews`.`title` LIKE '%" . _MS($uri_part) . "%'
                        OR `user_reviews`.`book_name` LIKE '%" . _MS($uri_part) . "%'
                        OR `user_reviews`.`author` LIKE '%" . _MS($uri_part) . "%'
                        OR `user_reviews`.`comment` LIKE '%" . _MS($uri_part) . "%'
                        OR `user_reviews`.`book_name` ='" . _MS($uri_part) . "' 
                        OR `user_reviews`.`title` ='" . _MS($uri_part) . "' 
                        OR `user_reviews`.`author` ='" . _MS($uri_part) . "' 
                        OR `user_reviews`.`comment` ='" . _MS($uri_part) . "'
                        OR `genre`.`slug` ='" . _MS($uri_part) . "'
                        )";
    }

    if (!empty($search_query)) {
        $search_query = "($search_query)";
    }
}

$curr_page = 1;
if (!empty($_GET['page'])) {
    if (preg_match('/^[1-9]\d*$/', $_GET['page']))
        $curr_page = $_GET['page'];
}

if (!empty($search_query)) {
    $search_query = " AND $search_query";
}

$limit = 10;
$offset = ($curr_page - 1) * $limit;

$blog_listing = "
            SELECT
                `user_listing`.`username`,
                `user_reviews`.*,
                `genre`.`name` AS `genre`
            FROM
                `user_reviews`
            INNER JOIN `genre` ON `genre`.`id` = `user_reviews`.`genre`
            INNER JOIN `user_listing` ON `user_listing`.`id` = `user_reviews`.`uid`
            WHERE
                `user_reviews`.`active` = 1 AND `user_reviews`.`is_deleted` = 0
                $search_query LIMIT $limit OFFSET $offset
";

$blogs = $link->query($blog_listing);

require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.head.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/review_listing.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.footer.php');
