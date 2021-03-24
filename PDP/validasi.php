<?php
include 'SQL connect.php';
$nama=$_POST['nama'];
$nim=$_POST['nim'];
$check=mysqli_query($con,"SELECT nim FROM signup WHERE nim='$nim'");
if (mysqli_num_rows($check)==0)
{
session_start();
$_SESSION['snim']=$nim;
$vnim=mysqli_query($con,"SELECT nim FROM biodata WHERE nim='$nim'");
$vnama=mysqli_query($con,"SELECT nama FROM biodata");
$x=mysqli_num_rows($vnim);
if ($x>0)
{while($row=mysqli_fetch_array($vnama))
{
    $ama=$row['nama'];
    if(strcasecmp($nama,$ama)==0)
    {
        echo"<script>alert('Anda sudah dapat izin dari admin! Silakan anda lanjut mendaftar')
        document.location.href='daftar2.html';</script>";
    }
}
echo"<script>alert('Nama anda salah atau kurang lengkap');
document.location.href='daftar.html';</script>";
}
else{
    echo"<script>alert('NIM anda tidak terdaftar, hubungi ADMIN!');
    document.location.href='daftar.html';</script>";
    }
}
else{
    echo"<script>alert('NIM anda sudah terdaftar, silakan login saja');
    document.location.href='signup.php';</script>";
}
?>
