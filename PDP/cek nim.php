<?php
include 'SQL connect.php';
$nim=$_POST['nomor'];
$vnim=mysqli_query($con,"SELECT * FROM biodata WHERE nim='$nim'");
$x=mysqli_num_rows($vnim);
if ($x>0)
{while($row=mysqli_fetch_array($vnim))
{
    $ama=$row['nama'];
}
echo"<script>alert('Anda terdaftar sebagai $ama ');
document.location.href='daftar.html';</script>";
}
else{
    echo"<script>alert('NIM anda tidak terdaftar, hubungi ADMIN!');
    document.location.href='daftar.html';</script>";
    }
?>