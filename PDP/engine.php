<?php
include 'SQL connect.php';
if(isset($_SESSION['username'])&&isset($_SESSION['password'])){
$username=$_SESSION['username'];
$password=$_SESSION['password'];
$txt1="pv";
$txt2="ch";
$a=false;
$data3=mysqli_query($con,"SELECT * FROM grup");
while($row3=mysqli_fetch_array($data3)){
            $val1=$row3['grup'];
            $data4=mysqli_query($con,"SELECT * FROM ".$val1.$txt1."");
            if(mysqli_num_rows($data4)==0)
            {
                mysqli_query($con,"DELETE FROM grup WHERE grup='$val1'");
                mysqli_query($con,"DROP TABLE ".$val1.$txt2."");
                mysqli_query($con,"DROP TABLE ".$val1.$txt1."");
            }
while($row4=mysqli_fetch_array($data4))
{
    $kondisi=$row4['status'];
    if($kondisi=="unblock"){
        $a=true;
    }
}
if($a==false){
    mysqli_query($con,"DELETE FROM grup WHERE grup='$val1'");
    mysqli_query($con,"DROP TABLE ".$val1.$txt2."");
    mysqli_query($con,"DROP TABLE ".$val1.$txt1."");
}
}
}
?>