<?php
global $link;
if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        switch ($key) {
            case 'email':
                if (empty($value)) {
                    $error[$key] = error_message('empty');
                } else {
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $error[$key] = error_message($key);
                    }
                }
                break;
            default:
                if (empty($value)) {
                    $error[$key] = error_message('empty');
                }
                break;
        }
    }

    if (empty($error)) {
        $insert_query = "INSERT INTO `contact_us`(`name`,`email`,`phone`,`query`,`ip_addr`)VALUES
                            ('"._MS($_POST['name'])."','"._MS($_POST['email'])."','"._MS($_POST['phone'])."','"._MS($_POST['query'])."','"._MS($_SERVER['REMOTE_ADDR'])."')";
            $link->query($insert_query);
            if(USER::$logged){
                $link->query("INSERT INTO `activity_log_user` (`uid`, `ip_addr`,`activity`) VALUES ('".USER::$id."','"._MS($_SERVER['REMOTE_ADDR'])."','" . activity['CONTACT_US'] . "')");
            }else{
                $link->query("INSERT INTO `activity_log_other` ( `ip_addr`,`activity`) VALUES ('"._MS($_SERVER['REMOTE_ADDR'])."','" . activity['CONTACT_US'] . "')");
            }
        die(json_encode(['status' => true, 'location' => '']));
    } else {
        die(json_encode(['error' => $error]));
    }
}

require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.head.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/contact_us.php');
require($_SERVER['DOCUMENT_ROOT'] . '/temp/inc.footer.php');
