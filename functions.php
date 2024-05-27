<?php
global $error_messages;
/*
function validation($array){
    if(!empty($array){
        foreach($array as $key => $value){
            switch($key){
                case 'name':
                case 'email':
                case 'name':
                case 'name':
                case 'name':
                case 'name':
                case 'name':

                    break;
            }
        }
    })
}
*/

function error_message($name)
{
    global $error_messages;
    if (!empty($error_messages[$name])) {
        return $error_messages[$name];
    } else {
        foreach ($error_messages as $key => $value) {
            if ((bool)preg_match("/" . $name . "/", $key) == true) {
                return $error_messages[$key];
            }
        }
        return $error_messages['empty'];
    }
}
function check_err($data)
{
    $error = [];
    foreach ($data as $key => $value) {
        if (empty($value)) {
            $error[$key] = error_message('default');
        }

        switch ($key) {
            case 'repeat_password':
                if ($value != $data['password']) {
                    $error[$key] = error_message('not_match_password');
                }
                break;

            case 'password':
                break;
            case 'email':
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $error[$key] = error_message('email');
                }
                break;

            default:
                if (empty($value)) {
                    $error[$key] = error_message($key);
                }
                break;
        }
    }

    return $error;
}


function onload()
{
    global $link;
    if (isset($_COOKIE['ldata'])) {
        $ldata = $_COOKIE['ldata'];
        $user = $link->query("SELECT `id`,`name` FROM `user_profile` WHERE `login_token` = '$ldata'");
        if ($user->num_rows == 0) {
            setcookie('ldata', '', time() - 3022, '/');
            return 0;
        }
        return $user->fetch_assoc();
    }
}

function activity_log($activity, $uid)
{
    global $link;
    $ip_addr = $_SERVER['DOCUMENT_ROOT'];
    $link->query("INSERT INTO `activity_log_user` (`uid`, `ip_addr`,`activity`) VALUES ('$uid','$ip_addr','" . activity[$activity] . "')");
}
function makeSlug($string)
{
    // Convert to lowercase
    $string = strtolower($string);

    // Replace whitespaces with dashes
    $string = preg_replace('/\s/', '-', $string);

    // Remove non-alphanumeric characters (except dashes)
    $string = preg_replace('/[^a-z0-9-]/', '', $string);

    // Replace consecutive dashes with a single dash
    $string = preg_replace('/-+/', '-', $string);

    // Trim leading and trailing dashes
    $string = trim($string, '-');

    // Return the slug
    return $string;
}
function create_anchor($page = 1)
{

    if (empty($_GET)) {
        return  $_SERVER['REQUEST_URI'] . "?page=$page";
    } else {
        if (isset($_GET['page'])) {
            if (preg_match('/page=[^&]+/', $_SERVER['REQUEST_URI'])) {
                return  preg_replace('/page=[^&]+/', "page=$page", $_SERVER['REQUEST_URI']);
            } else
                return  preg_replace('/page=[^&]*&/', "page=$page&", $_SERVER['REQUEST_URI']);
        } else
            return  $_SERVER['REQUEST_URI'] . "&page=$page";
    }
}
