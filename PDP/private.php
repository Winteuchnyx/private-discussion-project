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
<!DOCTYPE php>
<html lang="In-ID">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>private Discussion</title>
        <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/style.css">
        <script src="bootstrap-3.3.7-dist/jquery-3.2.1.js"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    </head>
    <body onmouseover="loadXMLDoc()" onload="loadXMLDoc()" onmouseout="loadXMLDoc()">
        <?php
        if(isset($_SESSION['grup'])&&isset($_SESSION['gruppas']))
        {echo'<div style="overflow:auto;width:100%;height:10%;position:relative;">
            <nav class="navbar navbar-inverse navbar-fixed-top" style="background-color:olivedrab;">
            <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" value="data" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="member.php" class="btn btn-info" target="_self">Member</a></li>
                <li><a href="logout2.php" class="btn btn-danger" target="_self">logout</a></li>
            </ul>
                    </div>
            </div>
        </nav>
            </div>
            <div style="width:100%;height:95%;overflow:visible;margin-bottom:40%;" id="private">
            </div>
            <script>
        function loadXMLDoc() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("private").innerHTML=this.responseText;
    }
  };
  xmlhttp.open("GET", "privaterealtime.php", true);
  xmlhttp.send();
}
        </script>';
        }else{
            echo '<div style="width:100%;height:50%;margin:auto;">
            <button type="button" style="margin-left:25%;margin-top:50%;width:25%;height:10%;" onclick="document.getElementById(\'hide\').style.display=\'block\';">Join</button>
            <button type="button" onclick="document.location.href=\'creategroup.php\';" style="display:inline;width:25%;height:10%;">create</button>
            <div id="hide" style="display:none;">
            <form action="'?><?php echo $_SERVER['PHP_SELF'];?><?php echo '" method="POST">
            <input style="width:10%;height:16%;float:right;display:inline;" type="submit" value="send">
            <span style="width:20%;float:left;">Group name :</span>
            <input style="width:70%;border:2px solid black;" type="text" name="group">
            <span style="width:20%;float:left;">Password :</span>
            <input style="width:70%;border:2px solid black;" type="text" name="grouppas">
            </form>
            </div>
            </div>';
        }
        ?>
<div style="position:fixed;bottom:0;width:100%;">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" onmouseover="loadXMLDoc()" onload="loadXMLDoc()" onmouseout="loadXMLDoc()">
        <input style="width:90%;border:2px solid black;" type="text" name="message" autofocus>
        <input style="width:10%;float:right;display:inline;clear:right;" type="submit" value="send">
        <input style="float:right;display:inline;" type="button" value="lastmessage" onclick="window.location.href='#fcs<?php echo $_SESSION['pk']?>'">
</form>
</div>
    </body>
</html>