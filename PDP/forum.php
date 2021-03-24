<?php
session_start();
if(!isset($_SESSION['username'])&&!isset($_SESSION['password']))
{
include 'SQL connect.php';
if(empty($_POST['username'])||empty($_POST['password']))
{
    echo "<script> alert('Anda belum login! login dulu!');
    document.location.href='signup.php';</script>";
}
$username=$_POST['username'];
$password=$_POST['password'];
$query=mysqli_query($con,"SELECT * FROM signup WHERE username='$username' AND password='$password'");
if(mysqli_num_rows($query)>0)
{
    while($row=mysqli_fetch_array($query))
    {
        $log=$row['username'];
        $pass=$row['password'];
    }
    $_SESSION['username']=$log;
    $_SESSION['password']=$pass;
}
else{
    echo "<script> alert('Username atau Password salah!');
    document.location.href='signup.php';</script>";
}
}
echo "<script> alert('Selamat datang ".$_SESSION['username']." di forum kami.');
    document.location.href='forum2.php';</script>";
?>