<?php
global $link;

if (!empty($_GET['page'])) {
    if (preg_match('/^[0-9]\d*$/', $_GET['page']))
        $curr_page = $_GET['page'];
}

$where = '';
if (!empty($_POST['search'])) {
    header("location:/listing/".makeSlug($_POST['search']).'/');
    exit;
}

if(!empty($search_uri)){
    
    $blogs = explode('-', $search_uri);
    foreach ($blogs as $blog) {
        if (!empty($where)) {
            $where .= ' OR ';
        }

        $where .= " `blog_list`.`title` LIKE '%" . _MS($blog) . "%'
                    OR `blog_list`.`content` LIKE '%" . _MS($blog) . "%'
                    OR `user`.`username` LIKE '%" . _MS($blog) . "%'";
    }
}

if (empty($curr_page)) {
    $curr_page = 1;
}
if (empty($where))
    $where = '';
else
    $where = 'WHERE ' . $where;
$limit = 10;
$offset = ($curr_page - 1) * $limit;

$blog_listing = "SELECT `blog_list`.`id`,`blog_list`.`title`, `blog_list`.`publish_date`,`blog_list`.`content`, `blog_list`.`subject`,
                    `user`.`username` AS `username`, `category`.`category` AS `category`, `sub_category`.`sub_category` AS `sub_category`
                    FROM `blog_list`
                    INNER JOIN `blog_sub_category` AS `sub_category` ON `sub_category`.`id` = `blog_list`.`sub_category`
                    INNER JOIN `blog_category` AS `category` ON `category`.`id` = `blog_list`.`category`
                    INNER JOIN `register` AS `user` ON `user`.`id` = `blog_list`.`uid`
                    $where LIMIT $limit OFFSET $offset
                    ";
$blogs = $link->query($blog_listing);
require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.head.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/listing.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.footer.php');
