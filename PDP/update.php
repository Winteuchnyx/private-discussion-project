<?php
session_start();
include 'SQL connect.php';
if(isset($_SESSION['username'])&&isset($_SESSION['password']))
{
$username=$_SESSION['username'];
$password=$_SESSION['password'];
$cek1=mysqli_query($con,"SELECT * FROM signup WHERE username='$username' AND password='$password'");
while($row=mysqli_fetch_array($cek1))
{
    $foto=$row['foto'];
    $nama=$row['nama'];
    $email=$row['email'];
    $user=$row['username'];
    $pass=$row['password'];
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(!empty($_FILES["file"]["name"])){
    $target_dir = "ikon/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$x = explode('.', $target_file);
$imageFileType = strtolower(end($x));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "<div class='alert alert-success alert-dismissable'>
    <a class='close' data-dismiss='alert' aria-label='close'>×</a>
    <strong>Success!</strong> File adalah foto dengan -" .$check["mime"]. ".
  </div>";
        $uploadOk = 1;
    } else {
        echo "<div class='alert alert-danger alert-dismissable'>
    <a class='close' data-dismiss='alert' aria-label='close'>×</a>
    <strong>gagal!</strong> File bukan foto.
  </div>";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "<div class='alert alert-warning alert-dismissable'>
    <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <strong>peringatan!</strong> Maaf nama file sudah ada,coba yang lain.
  </div>";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["file"]["size"] > 500000) {
    echo "<div class='alert alert-warning alert-dismissable'>
    <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <strong>peringatan!</strong> Maaf file anda kebesaran ukuran datanya(tidak boleh melebihi 500kb).
  </div>";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "<div class='alert alert-warning alert-dismissable'>
    <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <strong>peringatan!</strong> Maaf, hanya file JPG, JPEG, PNG & GIF diizinkan.
  </div>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<div class='alert alert-danger alert-dismissable'>
    <a class='close' data-dismiss='alert' aria-label='close'>×</a>
    <strong>gagal!</strong> file anda gagal upload.
  </div>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "<div class='alert alert-success alert-dismissable'>
    <a class='close' data-dismiss='alert' aria-label='close'>×</a>
    <strong>Success!</strong>file" .basename( $_FILES['file']['name']). "berhasil upload.
  </div>";
    $fotos=$target_file;
    } else {
        echo "<div class='alert alert-warning alert-dismissable'>
    <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <strong>peringatan!</strong> maaf ada kesalahan dengan file anda! coba lihat pesan errornya!.
  </div>";
    }
}
    }
}
    if(!empty($fotos))
    {
        $fot=$fotos;
    }else{
        $fot=$foto;
    }
    if(!empty($_POST['nama'])){
    $nam=$_POST['nama'];
    }else{
        $nam=$nama;
    }
    if(!empty($_POST['email'])){
    $emai=$_POST['email'];
    }else{
        $emai=$email;
    }
    if(!empty($_POST['username'])){
    $use=$_POST['username'];
    }else{
        $use=$user;
    }
    if(!empty($_POST['password'])){
    $pas=$_POST['password'];
    }else{
        $pas=$pass;
    }
    $cek2=mysqli_query($con,"UPDATE signup SET foto='$fot',nama='$nam',email='$emai',username='$use',password='$pas' WHERE username='$username' AND password='$password'");
    if($_SERVER["REQUEST_METHOD"]=="POST"){
    if($cek2&&!empty($_POST["nama"])||!empty($_POST["email"])||!empty($_POST["username"])||!empty($_POST["password"]))
    {
        $_SESSION['username']=$use;
        $_SESSION['password']=$pas;
        echo "<div class='alert alert-success alert-dismissable'>
    <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <strong>Success!</strong> data anda telah diupdate!
  </div>";
    }
}
}else{
    echo "<script>alert('Akses dilarang! anda tidak terdeteksi sebagai user!');
    document.location.href='signup.php'</script>";
}
?>
<!DOCTYPE php>
<html lang="in-ID">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PDP~Private Discussion Project</title>
        <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
        <script src="bootstrap-3.3.7-dist/jquery-3.2.1.js"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
  <h1>Account management</h1>
  <p>Untuk mengganti informasi akun anda, cukup mengetikkan(overwrite) data anda pada kotak input yang tersedia. kalau mau mengganti foto anda harus pilih file dahulu!</p>                                                                                      
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>Foto</th>
        <th>Data anda</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td rowspan="2"><img src="<?php echo $fot; ?>" alt="Foto gagal dimuat" width="50%"></td>
        <td>
            <label>
                <legend>Form untuk upload foto</legend>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
            <label class="control-label col-sm-2">Browse file:</label>
            <div class="col-sm-10">
            <input type="file" class="form-control" name="file">
            </div>
            </div>
            <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success btn-block" name="submit">Upload foto</button>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
            <button type="button" class="btn btn-danger btn-block" onclick="document.location.href='reset.php'">Menghapus foto menjadi bawaan</button>
            </div>
            </div>
            </form>
            </label>
            </td>
            </tr>
            <tr>
                <td>
            <label>
                <legend>Form untuk informasi akun</legend>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i> username</span>
                <input type="text" class="form-control" name="username" placeholder="<?php echo $use;?>">
                </div>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i> password</span>
                <input type="password" class="form-control" name="password" placeholder="<?php echo $pas;?>">
                </div>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i> nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <input type="text" class="form-control" name="nama" placeholder="<?php echo $nam;?>">
                </div>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i> E-mail&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <input type="email" class="form-control" name="email" placeholder="<?php echo $emai;?>">
                </div>
                <div class="input-group-btn">
                <button class="btn btn-success btn-block" type="submit">
                <i class="glyphicon glyphicon-ok-sign"></i>Update informasi akun anda
                </button>
                </div>
                </form>
            </label>
            </td>
      </tr>
    </tbody>
  </table>
  </div>
</div>
<footer>
     <div class="btn-group btn-group-justified">
    <a href="forum2.php" class="btn btn-warning">Batal/kembali</a>
    <a href="logout.php" class="btn btn-danger">Logout</a>
    </div> 
</footer>
    </body>
</html>
