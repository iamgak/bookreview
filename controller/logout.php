<?php

if(USER::$logged){
    USER::logout(); 
}

header('location:/login/');
exit;
