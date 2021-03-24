<?php
session_start();
include 'SQL connect.php';
if(isset($_SESSION['username'])&&isset($_SESSION['password'])){
$username=$_SESSION['username'];
$password=$_SESSION['password'];
$txt1="pv";
$txt2="ch";
$data1=mysqli_query($con,"SELECT * FROM grup");
$data2=mysqli_query($con,"SELECT * FROM signup WHERE username='$username' AND password='$password'");
if($_SERVER["REQUEST_METHOD"]=="POST"){
    while($row=mysqli_fetch_array($data1))
    {
        $check2=$row['grup'];
    }
    if(!empty($_POST["groupcat"])&&!empty($_POST["passwordcat"])&&!empty($_POST["jumlah"])){
        $gru=$_POST["groupcat"];
        $pua=$_POST["passwordcat"];
        $jlh=$_POST["jumlah"];
        if(mysqli_num_rows($data1)>0){
        if($gru==$check2){
            echo "<script> alert('grup sudah dibuat sebelumnya / nama grup sudah dipakai');
            document.location.href='private.php';</script>";
        }
        }
        $buat1=mysqli_query($con,"INSERT INTO grup(grup,password,sesi) VALUES('$gru','$pua','$jlh')");
        $buat2=mysqli_query($con,"CREATE TABLE ".$gru.$txt1."(
            user varchar(255) not null,
            status varchar(255) default 'unblock'
        ); ");
        $buat3=mysqli_query($con,"CREATE TABLE ".$gru.$txt2."(
            foto varchar(255),
            username varchar(255),
            pesan longtext,
            tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ); ");
        if($buat1&&$buat2&&$buat3){
        echo "<script> alert('anda berhasil membuat private grup!');
            document.location.href='private.php';</script>";
            $_SESSION["grup"]=$gru;
            $_SESSION["gruppas"]=$pua;
            mysqli_query($con,"INSERT INTO ".$gru.$txt1."(user) VALUES('$username')");
        }else{
            mysqli_query($con,"DELETE FROM grup WHERE grup='$gru' AND password='$pua'");
            mysqli_query($con,"DROP TABLE ".$gru.$txt1."");
            mysqli_query($con,"DROP TABLE ".$gru.$txt2."");
            echo "<script> alert('anda gagal membuat grup private, coba lagi!');
            document.location.href='creategroup.php';</script>";
        }
    }else{
        echo 'inputan form anda tidak boleh kosong';
    }
    }
}
?>
<!DOCTYPE php>
<html lang="In-ID">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>group maker</title>
		<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/style.css">
    </head>
    <body>
        <?php
        echo '
        <div style="margin-top:25%;background-color:green;border:1px solid black;outline: 1px solid blue;">
        <form action="';?><?php echo $_SERVER['PHP_SELF'];?><?php echo'" method="POST">
        <p>ID group :</p> <input type="text" name="groupcat" required>
        <p>Password group :</p><input type="text" name="passwordcat" required>
        <p>Jumlah member yang diperbolehkan :</p><input type="number" name="jumlah" min="2" value="2" required>
        <br/>
        <button type="submit">Buat private disccussion forum</button>
        <button type="button" onclick="document.location.href=\'private.php\'">Kembali</button>
        </form>
        </div> ';
        ?>
    </body>
</html>
