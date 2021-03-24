<?php
session_start();
include 'SQL connect.php';
if(isset($_SESSION['username'])&&isset($_SESSION['password'])){
$username=$_SESSION['username'];
$password=$_SESSION['password'];
$cek2=mysqli_query($con,"SELECT foto FROM signup WHERE username='$username' AND password='$password'");
$row=mysqli_fetch_array($cek2);
$foto=$row['foto'];
if($foto!="ikon/user.jpg"){
$x=explode("/",$foto);
unlink("ikon/".end($x));
$cek1=mysqli_query($con,"UPDATE signup SET foto='ikon/user.jpg' WHERE username='$username' AND password='$password'");
if($cek1)
{
    header('location:update.php');
}else{
    header('location:signup.php');
}
}else{
    header('location:update.php');
}
}else{
    echo "<script>alert('Login anda bermasalah!');
    document.location.href='signup.php';</script>";
}