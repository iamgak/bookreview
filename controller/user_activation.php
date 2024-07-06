<?php global $link;
$valid_link = "SELECT `id` FROM `user_listing` WHERE `activation_token` = '$activation_token' AND `active` = 0";
$validate_user = $link->query($valid_link);

if ($validate_user->num_rows == 0) {
    $this->error404();
    exit;
}

$uid = $validate_user->fetch_assoc()['id'];
$link->query("INSERT INTO `activity_log_user` (`uid`, `ip_addr`,`activity`) VALUES ('"._MS($uid)."','"._MS($_SERVER['REMOTE_ADDR'])."','" . activity['USER_TOKEN_VALIDATED'] . "')");
$link->query("UPDATE `user_listing` SET `active` = 1,`activation_token` = NULL WHERE `id` = "._MS($uid)."");
header("location:/success/");
exit;
