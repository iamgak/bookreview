<?php
class USER
{
   public static $logged = false;
   public static $super = false;
   public static $id = 0;
   public static $username = '';

   public static function onload()
   {
      global $link;
      //var_dump(USER::valid_token());   -->
      if (USER::valid_token()) {
         //echo "SELECT `id` FROM `register` WHERE `login_token`='" . $_COOKIE['ldata']."'";

         $login = $link->query("SELECT `register`.`id`,`privilege`.`uid` AS `super`,username 
                                 FROM `register` 
                                 LEFT JOIN `privilege` ON `register`.`id` = `privilege`.`uid` 
                                 WHERE `login_token`='" . $_COOKIE['ldata']."'");
         if($login->num_rows > 0 ){
            $user=$login->fetch_assoc();
            USER::$logged = true;
            USER::$id = $user['id'];
            USER::$username = $user['username'];
            if(!empty($user['super'])){
               USER::$super = true;
            }

         }
      }
   }
   

   public static function logout()
   {
      global $link;
      $link->query("UPDATE `register` SET  `login_token` = null WHERE `login_token`='" . $_COOKIE['ldata']."'");
      setcookie("ldata",'',time()-3600,'/');
   }
   public static  function valid_token()
   {
      $ldata = !empty($_COOKIE['ldata']) ? $_COOKIE['ldata'] : '';
      if (strlen($ldata) > 5) {
         return true;
      }

      return false;
   }
}
