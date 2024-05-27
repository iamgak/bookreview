<?php
global $link;
if(!USER::$super){
    header('location:/admin/login/');
    exit;
}

$orderby = 'DESC';
if (!empty($_POST)) {
    $uri = "location:/admin/listing/";
    $get = '';
    foreach ($_POST as $key => $value) {
        if (!empty($value)) {
            if (!empty($get)) {
                $get .= "&";
            }
            switch ($key) {
                case 'delete':
                    if (!empty($value[0]) && is_array($value)) {

                        $id = '';
                        foreach ($_POST['delete'] as $del_id) {
                            if (!empty($id)) {
                                $id .= ", ";
                            }

                            $id .= "'" . _MS($del_id) . "'";
                        }

                        $id = "($id)";
                        //echo "UPDATE `user_reviews` SET `is_deleted`=0 WHERE `id` IN $id";die;
                        $link->query("UPDATE `user_reviews` SET `is_deleted`='1 ' WHERE `id` IN $id");
                    }
                    break;
                case 'date':
                    $get .= "date=$value";
                    break;
                case 'order_by':
                    $get .= "order=$value";
                    break;
                case 'page':
                    if (preg_match('/^[1-9]\d*$/', $_POST['page']))
                        $get .= $value;
                    break;
                case 'search':
                    $uri .= makeSlug($value) . '/';
                    break;
            }

            if (!empty($get)) {
                $uri .= '?' . $get;
            }
        }
    }
    header($uri);
    exit;
}
$search_query = '';
if (!empty($search_uri)) {

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
        $search_query = "  WHERE $search_query";
    }
    
}

if(!empty($_GET['date'])){
    if (!empty($search_query)) {
        $search_query .= "  AND timestampdiff(day,`published_date`,now()) < '"._MS($_GET['date'])."' ";
    }else{
        $search_query .= "  WHERE timestampdiff(day,`published_date`,now()) < '"._MS($_GET['date'])."' ";
    }
}

if (!empty($_GET['page'])) {
    if (preg_match('/^[0-9]\d*$/', $_GET['page']))
        $curr_page = $_GET['page'];
}

if (empty($curr_page)) {
    $curr_page = 1;
}

$limit = 10;
$offset = ($curr_page - 1) * $limit;

$blog_listing = "
        SELECT
            `register`.`username`,
            `user_reviews`.*,
            `genre`.`name` AS `genre`
        FROM
            `user_reviews`
        INNER JOIN `genre` ON `genre`.`id` = `user_reviews`.`genre`
        INNER JOIN `register` ON `register`.`id` = `user_reviews`.`uid`
            $search_query LIMIT $limit OFFSET $offset
";
$blogs = $link->query($blog_listing);
//print_r($blogs->fetch_all(true));die;
//$blogs = $link->query($blog_listing);
require($_SERVER['DOCUMENT_ROOT'] . '/temp/Admin/head.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/Admin/listing.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/Admin/footer.php');
