<?php
session_start();
session_unset();
session_destroy();
session_write_close();
    $helper = array_keys($_SESSION);
    foreach ($helper as $key){
        unset($_SESSION[$key]);
    }
header("location:signup.php");
?>