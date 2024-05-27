<?php
global $link;
if(!USER::$super){
    header('location:/admin/login/');
    exit;
}

$orderby = 'DESC';
if (!empty($_POST)) {
    $uri = "location:/admin/contact_listing/";
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
                        $link->query("DELETE FROM `contact_us` WHERE `id` IN $id");
                    }
                    break;
                case 'date':
                    $get .= "date=$value";
                    break;
                case 'order_by':
                    //if (preg_match('/^(DESC|ASC|desc|asc)$/', $value))
                    $get .= "order=$value";
                    break;
                case 'page':
                    if (preg_match('/^[1-9]\d*$/', $_POST['page']))
                        $get .= $value;
                    break;
                case 'search':
                    $uri .= makeSlug($value) . '/';
            }
        }
    }

    if (!empty($get)) {
        $uri .= '?' . $get;
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
        $search_query = " AND ($search_query)";
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


$contact_listing = $link->query("SELECT * FROM `contact_us`");

require($_SERVER['DOCUMENT_ROOT'] . '/temp/Admin/head.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/Admin/contact_listing.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/Admin/footer.php');
