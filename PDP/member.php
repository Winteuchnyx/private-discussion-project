<?php
session_start();
include 'SQL connect.php';
if(isset($_SESSION['username'])&&isset($_SESSION['password'])&&isset($_SESSION['grup'])&&isset($_SESSION['gruppas'])){
$username=$_SESSION['username'];
$password=$_SESSION['password'];
$privacyui=$_SESSION['grup'];
$privacyps=$_SESSION['gruppas'];
$txt1="pv";
$data4=mysqli_query($con,"SELECT * FROM ".$privacyui.$txt1."");
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $statue=$_POST['status'];
    if(!empty($_POST['pengguna'])){
    $member=$_POST['pengguna'];
    mysqli_query($con,"UPDATE ".$privacyui.$txt1." SET status='$statue' WHERE user='$member'");
    header("location:member.php");
    }else{
        echo "<script> alert('anda gagal mengubah status member');
            document.location.href='logout2.php';</script>";
    }
}
}else{
    echo "<script> alert('Login bermasalah!');
            document.location.href='private.php';</script>";
}
?>
<!DOCTYPE php>
<html lang="In-ID">
    <head>
        <meta http-equiv="refresh" content="30">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>private Discussion</title>
        <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
        <script src="bootstrap-3.3.7-dist/jquery-3.2.1.js"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <style>
            table tr,td{border:1px solid black;}
        </style>
    </head>
    <body>
        <table style="border:3px solid black;width:95%;margin:auto;">
<?php
while($row4=mysqli_fetch_array($data4))
{
    $kondisi=$row4['status'];
    $pengguna=$row4['user'];
    echo '<tr><td>Nama user</td>
    <td>Status</td>
    </tr>
    <tr><td>'.$pengguna.'</td>
    <td>
    <form action="'?><?php echo $_SERVER['PHP_SELF'];?><?php echo '" method="POST">
    <input type="text" name="pengguna" value="';?><?php echo $pengguna;?><?php echo '" style="display:none;">
    <input type="radio" name="status" value="block"'?><?php if($kondisi!="unblock"){echo 'checked=checked/';}?><?php echo '>Blocked
    <input type="radio" name="status" value="unblock"'?><?php if($kondisi=="unblock"){echo 'checked=checked/';}?><?php echo '>Unblocked
    </td>
    </tr>
    <tr>
    <td colspan="2"><button type="submit" class="btn btn-danger btn-block">Setuju melakukan perubahan</button></td>
    </tr>
    <tr>
    <td colspan="2"><button type="button" class="btn btn-primary btn-block" onclick="document.location.href=\'private.php\'">Kembali/batal</button></td>
    </tr>
    </form>';
}
?>
</table>
    </body>
</html>
