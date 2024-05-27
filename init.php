<?php

declare(strict_types=1);
ini_set('error_reporting', '-1');
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
ini_set('log_errors', '1');
ini_set('error_log', $_SERVER['DOCUMENT_ROOT'] . '/logfiles/php_errors.txt');

require($_SERVER['DOCUMENT_ROOT'] . '/functions.php');

// --------------------------------------------

// uncomment if mysql is required
$link = new mysqli('p:localhost', 'root', '', 'bookreview');

mysqli_set_charset($link, 'utf8mb4');

function _MS($str)
{
	$str = preg_replace('/^\p{Z}+|\p{Z}+$/u', '', $str);
	return mysqli_real_escape_string($GLOBALS['link'], $str);
}

function IDtoFolder($id)
{
	$a = ceil($id / 1000);
	$b = ceil($a / 10) * 10;
	$folder1 = $b * 1000;
	$folder2 = $a * 1000;
	return array($folder1 . '/' . $folder2, $folder1, $folder2);
}
// --------------------------------------------

// set limit of rows to print

if (!empty($_COOKIE['limit']) && is_numeric($_COOKIE['limit'])) {
	$items_per_page = $_COOKIE['limit'];
} else {
	$items_per_page = 10;
	setcookie('limit', '10', time() + 364100, '/');
}
// for query
$temp_order = [
	'oldest' => ' `property`.`id` asc',
	'latest' => ' `property`.`id` desc',
	'low-price' => ' `property`.`cost` asc',
	'expensive' => ' `property`.`cost` desc'
];

// to check if cookie for order is set or not 

if ((isset($_COOKIE['orderby'])) && isset($temp_order[$_COOKIE['orderby']])) {
	$sortingOrder = ' ORDER BY  ' . $temp_order[$_COOKIE['orderby']] . '';
} else {
	$sortingOrder = " ORDER BY {$temp_order['latest']} ";
}



//    default error message
$error_messages = [
	'name' => "Please enter a valid name",
	'otp' => "Please enter a valid otp",
	'email' => "Please enter a valid email address",
	'password' => "Please enter a password that meets the requirements",
	'repeat_password' => "Please enter the same password again",
	'not_match_password' => "The passwords you entered do not match",
	'already_exist' => "This email address is already registered",
	'username_exist' => "This username is already registered",
	'empty' => "Please fill in this field",
	'tick' => 'Please, Agree to our Terms & Conditions',
	'incorrect_credential' => 'Incorrect Credentials',
	'phone' => 'Please enter valid phone number',
	'mobile' => 'Please enter proper mobile number',
	'malicious' => 'Refresh the page and try Again',
	'query' => 'Query Field should not be empty',
	'terms' => 'Please Agree to All Terms & Conditions',
	'default' => "Please check your input",
	'invalid_format' => "The input format is invalid",
	'too_short' => "The input is too short, please add more characters",
	'too_long' => "The input is too long, please shorten it",
	'invalid_characters' => "The input contains invalid characters",
	'invalid_number' => "Please enter a valid number",
	'greater_than' => "The input must be greater than X",
	'less_than' => "The input must be less than X",
	'no_space' => "The input cannot contain spaces",
	'file_too_large' => "The file size exceeds the maximum allowed size",
	'file_type_not_allowed' => "The file type is not allowed",
	'file_upload_failed' => "The file upload failed, please try again",
	'username_taken' => "The username is already taken, please choose another one",
	'email_not_confirmed' => "Your email address is not confirmed, please check your email for the confirmation link",
	'account_suspended' => "Your account has been suspended, please contact us for more information",
	'insufficient_funds' => "Your account has insufficient funds to complete this transaction",
	'unexpected_error' => "An unexpected error occurred, please try again later",
	'block_operation' => "You have used maximum limit. Try again after 24 hour",
	'max_limit_email' => "You have used maximum limit.",
	'edit' => 'Edit Profile',
	'too_many_attempt' => 'You have used maximum limit. Try again after 24 hour',
	
];
const MAX_ATTEMPT = 12;
$currency = '&euro; ';
$default_img = 'alt_image.jpg';
$website_name = 'Complicated';
const activity = [
	'NEW_USER_REGISTERED' => 1,
	'LOGGED_IN' => 2,
	'LOGGED_OUT' => 3,
	'AD_POSTED' => 4,
	'EDIT_AD' => 5,
	'PASSWORD_CHANGE' => 6,
	'EMAIL_UPDATED' => 7,
	'PROFILE_UPDATED' => 8,
	'PROFILE_CREATED' => 9,
	'USER_TOKEN_VALIDATED' => 10,
	'REVIEW_POSTED' => 11,
	'REVIEW_EDITED' => 12,
	'COMMENT_POSTED'=>13,
	'PASSWORD_RESET'=>14,
	'PASSWORD_CHANGE'=>15,
	'COOKIE_ACCEPT' =>16,
	'CONTACT_US'=>17,
	'INCORRECT_CREDENTIALS'=>18,
	'PASSWORD_RESET_REQUEST'=>19,
];

const website = 'Test';

/*$db_data = $link->query("SELECT COLUMN_NAME,IS_NULLABLE AS `IS_NULL`, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'register'");
$db_structure =$db_data->fetch_all(true);
foreach($db_structure as $db){
    $data['is_null'][$db['COLUMN_NAME']]=$db['IS_NULL'];
    $data['data_type'][$db['COLUMN_NAME']]=$db['DATA_TYPE'];
}
<!-- 
('NEW_USER_REGISTERED'),('LOGGED_IN'),('LOGGED_OUT'),('AD_POSTED'),('EDIT_AD'),('PASSWORD_CHANGE'),('EMAIL_UPDATED'),('PROFILE_UPDATED'),('PROFILE_CREATED'),('USER_TOKEN_VALIDATED'),('REVIEW_POSTED'),('REVIEW_EDITED'),('COMMENT_POSTED'),('PASSWORD_RESET'),('PASSWORD_CHANGE'),('COOKIE_ACCEPT' ),('CONTACT_US') -->
*/