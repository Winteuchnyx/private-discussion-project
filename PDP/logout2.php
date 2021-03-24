<?php
session_start();
include 'SQL connect.php';
$privacyui=$_SESSION['grup'];
$username=$_SESSION['username'];
$txt1="pv";
mysqli_query($con,"DELETE FROM ".$privacyui.$txt1." WHERE user='$username'");
unset($_SESSION['grup']);
unset($_SESSION['gruppas']);
unset($_SESSION['pk']);
header("location:private.php");
?>