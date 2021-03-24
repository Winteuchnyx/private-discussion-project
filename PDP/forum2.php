<?php 
session_start();
require 'engine.php';
include 'SQL connect.php';
if(!isset($_SESSION['username'])&&!isset($_SESSION['password']))
{
    echo "<script>alert('Anda telah Logout atau anda belum Login, coba login kembali!');
    document.location.href='signup.php';</script>";
}
$username=$_SESSION['username'];
$password=$_SESSION['password'];
$add=mysqli_query($con,"SELECT * FROM signup WHERE username='$username' AND password='$password'");
while($row=mysqli_fetch_array($add))
{
    $foto=$row['foto'];
}
if(isset($_SESSION['username'])&&isset($_SESSION['password'])){
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(!empty($_POST["catatan"])){
        $addnotes=$_POST["catatan"];
        $notes=mysqli_query($con,"INSERT INTO notes(username,pesan) VALUES('$username','$addnotes')");
        }
    }
}
?>
<!DOCTYPE php>
<html lang="in-ID">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PDP Forum SITES</title>
        <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/style.css">
        <script src="bootstrap-3.3.7-dist/jquery-3.2.1.js"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <style>
            nav{
                width:70%;
            }
        </style>
    </head>
        <body onmouseover="loadXMLDoc()" onmouseout="loadXMLDoc()">
            <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" value="data" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="<?php echo $foto?>" target="_blank"><img src="<?php echo $foto?>" height="200%" width="15%" style="overflow:auto;position:absolute;left:0;"></a>
                        <div style="padding:5%;width:125%;text-align:center;">
            <li class="dropdown" style="list-style-type:none;padding:0;margin:0;width:15%;position:absolute;top:200%;">
          <a class="dropdown-toggle" data-toggle="dropdown"><p style="color:skyblue;cursor:pointer;font-weight:900;font-size:150%;"><?php echo "$username"?><span class="caret"></span></p></a>
          <ul class="dropdown-menu">
            <li><button type="button" class="btn btn-warning btn-block" onclick="document.location.href='update.php';">Akun</button></li>
            <li><a type="button" style="width:100%;text-align:center;background:red;" href='/pdp/logout.php'>Log out</a></li>
          </ul>
        </li>
        </div>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav" style="margin-left:10%;">
                <li><a href="general.php" target="chatframe">Public discussion</a></li>
                <li><a href="private.php" target="chatframe">Private discussion</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            </ul>
                    </div>
            </div>
        </nav>
        <aside>
            <div style="right:0;height:100%;width:30%;position:fixed;background-color:#dadaaa;z-index:10000;overflow-y:auto;opacity:0.9;">
                <form class="form-horizontal" style="background-color:midnightblue;" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
      <div class="input-group">
        <input type="text" name="catatan" class="form-control" placeholder="Tambah catatan" onkeyup="loadXMLDoc()">
        <div class="input-group-btn">
          <button class="btn btn-default" type="submit">
            <span class="glyphicon glyphicon-share"></span>
          </button>
        </div>
      </div>
      <div class="alert alert-info alert-dismissable fade in">
      <a class="close" data-dismiss="alert" aria-label="close">×</a>
      <span class="help-block"><b>INFO</b> Forum notes hanya akan update jika fokus kelaman! klik (x) untuk close</span>
      </div>
    </form>
    <div style='background-color: yellowgreen;color:white;' id='notes'>
    <script>
        function loadXMLDoc() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('notes').innerHTML="<ul style='list-style-type:none;padding:0;margin:0;'>"+this.responseText+"</ul>";
    }
  };
  xmlhttp.open("GET", "notes.php", true);
  xmlhttp.send();
}
        </script>
    </div>
    </div>
        </aside>
        <div style="position:fixed;height:100%;width:50%;top:10%;left:18%;">
            <iframe src="general.php" style="height:90%;width:100%;border: 2px dashed green;" name="chatframe"></iframe>
        </div>
        </body>
</html>