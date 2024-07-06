<?php
// Define the route pattern
require($_SERVER['DOCUMENT_ROOT'].'/mainController/my_controller.php');
require($_SERVER['DOCUMENT_ROOT'].'/mainController/User.php');
require($_SERVER['DOCUMENT_ROOT'].'/init.php');
USER::onload();
$routes = [
    //'~^/first/(\d+)/second/(\d+)/third/(\d+)(?:/page/(\d+))?~' => ['my_controller', 'home'],
    '~^/$~' => ['my_controller','index'],
    //'~^/assets/css/style\.css$~' => ['my_controller','css'],
    '~^/api/$~' => ['my_controller','api'],
    '~^/post_ad/$~' => ['my_controller','post_ad'],
    '~^/register/$~' => ['my_controller','register'],
    '~^/login/$~' => ['my_controller','login'],
    '~^/logout/$~' => ['my_controller','logout'],
    '~^/[\w\-\d]+/success/$~' => ['my_controller','success'],
    '~^/listing/$~' => ['my_controller','listing'],
    '~^/listing/([^/]+)/$~' => ['my_controller','listing'],
    '~^/contact_us/$~' => ['my_controller','contact_us'],
    '~^/user_review/$~' => ['my_controller','user_review'],
    '~^/my_review/$~' => ['my_controller','my_review'],
    '~^/edit_review/([1-9]\d*)/$~' => ['my_controller','edit_review'],
    '~^/review_listing/$~' => ['my_controller','review_listing'],
    '~^/forget_password/$~' => ['my_controller','forget_password'],
    '~^/review_listing/([^/]+)/$~' => ['my_controller','review_listing_search'],
    '~^/my_profile/edit_profile/$~' => ['my_controller','edit_profile'],
    '~^/my_profile/change_passwd/$~' => ['my_controller','change_passwd'],
    '~^/user_activation/([^\/]+)/$~' => ['my_controller','user_activation'],
    '~^/reset_password/([^\/]+)/$~' => ['my_controller','reset_password'],

    //for admin
    '~^/admin/login/$~' => ['my_controller','admin_login'],
    //'~^/admin/$~' => ['my_controller','dashboard'],
    '~^/admin/user_listing/$~' => ['my_controller','user_listing'],
    '~^/admin/contact_listing/$~' => ['my_controller','contact_listing'],
    '~^/admin/listing/$~' => ['my_controller','admin_listing'],
    '~^/admin/listing/([^/]+)/$~' => ['my_controller','admin_listing'],


];

// Get the current URL path
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

foreach ($routes as $pattern => $handler) {
    if (preg_match($pattern, $path, $matches)) {

        // Remove the first match (the full path)
        array_shift($matches);

        $controller = new $handler[0];
        $method = $handler[1];

        // Call the controller method with captured parameters
        call_user_func_array([$controller, $method], $matches);
        exit;
    }
}

// No matching route found
(new my_controller())->error404();

//$my_controller->home();
