<?php
session_start();
include 'SQL connect.php';
$username=$_SESSION['username'];
$password=$_SESSION['password'];
mysqli_query($con,"DELETE FROM general WHERE tanggal < (NOW() - INTERVAL 14 DAY)");
$data1=mysqli_query($con,"SELECT * FROM general");
$data2=mysqli_query($con,"SELECT * FROM signup WHERE username='$username' AND password='$password'");
while($row1=mysqli_fetch_array($data2))
{
    $foto=$row1["foto"];
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(!empty($_POST["message"])){
        $pesan=$_POST["message"];
        mysqli_query($con,"INSERT INTO general(foto,username,pesan) VALUES('$foto','$username','$pesan')");
        header('location:general.php');
    }
}
$ik=0;
while($row2=mysqli_fetch_array($data1)){
    echo '<div style="overflow:auto;width:100%;height:20%;position:relative;color:white;" id="fcs'.$ik.'">
    <div style="float:left;width:15%">
    <a href='.$foto=$row2["foto"].' target="_blank"><img src=' .$foto=$row2["foto"]. ' alt="Error" width="100%" height="100%"></a>
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
$ik++;
}
$_SESSION['ik']=($ik-1);
/*
        while($row2=mysqli_fetch_array($data1)){
            echo '
            <div style="overflow:auto;width:100%;height:20%;position:relative;">
            <div style="float:left;width:15%">
            <a href='.$foto=$row2["foto"].' target="_blank"><img src=' .$foto=$row2["foto"]. ' alt="Error" width="100%" height="100%"></a>
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
        }*/
        ?>