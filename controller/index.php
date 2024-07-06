<?php
global $link;
$genre = $link->query("SELECT * FROM `genre` LIMIT 4");
$blog_listing = "SELECT `user_reviews`.`id`,`user_reviews`.`title`,
`user_reviews`.`comment` as content ,
`user_reviews`.`book_name` as book_name  
                    FROM `user_reviews`
                    INNER JOIN `genre` AS `category` ON `category`.`id` = `user_reviews`.`genre`
                    INNER JOIN `user_listing` AS `user` ON `user`.`id` = `user_reviews`.`uid`
                    ORDER BY `user_reviews`.`id` DESC LIMIT 4
                    ";
$blogs = $link->query($blog_listing);

require($_SERVER['DOCUMENT_ROOT'].'/temp/inc.head.php');
require($_SERVER['DOCUMENT_ROOT'].'/temp/index.php');
require($_SERVER['DOCUMENT_ROOT'].'/temp/inc.footer.php');
