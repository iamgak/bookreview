<?php
global $link;
if(!empty($_FILES)){
    die(json_encode(['status'=>'true']));
}
//print_r($blogs->fetch_all(true));
require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.head.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/files.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.footer.php');
