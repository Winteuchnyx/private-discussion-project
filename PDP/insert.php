<?php
session_start();
include 'SQL connect.php';
$nama=$_POST['nama'];
$email=$_POST['email'];
$jenis=$_POST['jenis'];
$username=$_POST['username'];
$password=$_POST['password'];
$nim=$_SESSION['snim'];
$cek1=mysqli_query($con,"SELECT * FROM signup WHERE nama='$nama'");
$cek2=mysqli_query($con,"SELECT * FROM signup WHERE email='$email'");
$cek3=mysqli_query($con,"SELECT * FROM signup WHERE email='$username'");
if(mysqli_num_rows($cek1)==0)
{
    if(mysqli_num_rows($cek2)==0)
    {
        if(mysqli_num_rows($cek3)==0)
        {
$query=mysqli_query($con,"INSERT INTO signup(nim,nama,email,jeniskelamin,username,password)
VALUES ('$nim','$nama','$email','$jenis','$username','$password')");
if($query)
{
    echo"<script>alert('Akun anda berhasil didaftar');
        document.location.href='signup.php';</script>";
}
else
{
    echo"<script>alert('Data yang anda masukkan kurang benar! Silakan ulang daftar lagi')
        document.location.href='daftar2.html';</script>";
}
        }else{
            echo"<script>alert('Username sudah dipakai!')
        document.location.href='daftar2.html';</script>";
        }
    }
    else
    {
        echo"<script>alert('Email yang anda masukan sudah terdaftar! coba email lain!')
        document.location.href='daftar2.html';</script>";
    }
}
else{
    echo"<script>alert('Nama yang anda masukkan sudah terdaftar! coba nama yang lain.')
        document.location.href='daftar2.html';</script>";
}
session_unset();
session_destroy();
?>
