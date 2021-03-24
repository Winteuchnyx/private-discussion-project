<?php
session_start();
include 'SQL connect.php';
if(isset($_SESSION['username'])&&isset($_SESSION['password'])){
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
}
?>
<!DOCTYPE php>
<html lang="In-ID">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Public Discussion</title>
    </head>
    <body onmouseover="loadXMLDoc()" onload="loadXMLDoc()" onmouseout="loadXMLDoc()">
        <div style="width:100%;height:95%;overflow:auto;" id="general">
</div>
        <script>
        function loadXMLDoc() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('general').innerHTML=this.responseText;
    }
  };
  xmlhttp.open("GET", "generalrealtime.php", true);
  xmlhttp.send();
}
        </script>
<div style="position:fixed;bottom:0;width:100%;">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" onmouseover="loadXMLDoc()" onload="loadXMLDoc()" onmouseout="loadXMLDoc()">
        <input style="width:90%;border:2px solid black;" type="text" name="message" autofocus>
        <input style="width:10%;float:right;display:inline;clear:right;" type="submit" value="send">        
        <input style="float:right;display:inline;" type="button" value="lastmessage" onclick="window.location.href='#fcs<?php echo $_SESSION['ik']?>'">        
</form>
</div>
    </body>
</html>