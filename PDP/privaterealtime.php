<?php
session_start();
require 'engine.php';
include 'SQL connect.php';
if(isset($_SESSION['username'])&&isset($_SESSION['password'])){
$username=$_SESSION['username'];
$password=$_SESSION['password'];
if(isset($_SESSION['grup'])&&isset($_SESSION['gruppas'])){
$privacyui=$_SESSION['grup'];
$privacyps=$_SESSION['gruppas'];
}
$txt1="pv";
$txt2="ch";
if(isset($_SESSION['grup'])&&isset($_SESSION['gruppas'])){
$data1=mysqli_query($con,"SELECT * FROM ".$privacyui.$txt2."");
}
$data2=mysqli_query($con,"SELECT * FROM signup WHERE username='$username' AND password='$password'");
$data3=mysqli_query($con,"SELECT * FROM grup");
if(isset($_SESSION['grup'])&&isset($_SESSION['gruppas'])){
$data4=mysqli_query($con,"SELECT * FROM ".$privacyui.$txt1." WHERE user='$username'");
}
while($row1=mysqli_fetch_array($data2))
{
    $foto=$row1["foto"];
}
if(mysqli_num_rows($data3)>0){
while($row3=mysqli_fetch_array($data3)){
            $val1=$row3['grup'];
            $val2=$row3['password'];
            $val3=$row3['sesi'];
        }
        if(isset($_SESSION['grup'])&&isset($_SESSION['gruppas'])){
while($row4=mysqli_fetch_array($data4))
{
    $kondisi=$row4['status'];
}
if($kondisi!="unblock"&&!empty($kondisi)){
    echo "<script> alert('Maaf anda sudah diblokir oleh member dalam grup yang anda tuju....');
            document.location.href='logout2.php';</script>";
}
        }
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(!empty($_POST["message"])){
        if($kondisi=="unblock"){
        $pesan=$_POST["message"];
        mysqli_query($con,"INSERT INTO ".$privacyui.$txt2."(foto,username,pesan) VALUES('$foto','$username','$pesan')");
        header('location:private.php');
        }else{
            echo "<script> alert('Maaf anda sudah tidak dapat bergabung dan mengakses grup ini lagi karena anda telah diblokir...');
            document.location.href='logout2.php';</script>";
        }
    }
    if(!empty($_POST['group'])&&!empty($_POST['grouppas'])){
        $check1=$_POST['group'];
        $check2=$_POST['grouppas'];
        if($check1==$val1)
        {
            if($check2==$val2)
            {
                if(mysqli_num_rows($data4)>=$val3){
            echo "<script> alert('Maaf grup yang anda tuju sudah penuh');
            document.location.href='private.php';</script>";
        }else{
            $_SESSION['grup']=$check1;
            $_SESSION['gruppas']=$check2;
            mysqli_query($con,"INSERT INTO ".$check1.$txt1."(user) VALUES('$username')");
            echo "<script> alert('Berhasil masuk private discussion grup');
            document.location.href='private.php';</script>";
        }
            }else{
                echo "<script> alert('Password salah!');
            document.location.href='private.php';</script>";
            }
        }else{
            echo "<script> alert('Username salah!');
            document.location.href='private.php';</script>";
        }
        if($check1!=$val1&&$check2!=$val2){
            echo "<script> alert('Username dan Password salah!!!');
            document.location.href='private.php';</script>";
        }
    }
}
}
}
?>
<?php
$pk=0;
while($row2=mysqli_fetch_array($data1)){
    echo '
    <div style="overflow:auto;width:100%;height:20%;position:relative;color:white;" id="fcs'.$pk.'">
    <div style="float:left;width:15%">
    <a href="'.$foto=$row2["foto"].'" target="_blank"><img src="' .$foto=$row2["foto"]. '" alt="Error" width="100%" height="100%"></a>
    </div>
    <div style="background-color:yellow;position:absolute;top:0;right:0;width:85%;height:20%;">
        <span style="float:left;font-size:125%;">Username: '.$user=$row2["username"].'</span>
        <span style="float:right;font-size:125%;">Waktu:'.$tgl=$row2["tanggal"].'</span>
    </div>
        <div style="background-color:green;height:80%;width:85%;position:absolute;bottom:0;right:0;">
        <p>'.$psn=$row2["pesan"].'</p>
        </div>
</div><br/>
';
$pk++;
}
$_SESSION['pk']=($pk-1);
?>