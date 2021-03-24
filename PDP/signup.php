<?php 
session_start();
if(isset($_SESSION['username'])&&isset($_SESSION['password']))
        {
            header("location:forum.php");
        }
?>
<!DOCTYPE html>
<html lang="in-ID">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PDP~Private Discussion Project</title>
        <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/style.css">
        <script src="bootstrap-3.3.7-dist/jquery-3.2.1.js"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <style>
            
            .carousel-inner img {
      width: 100%; /* Set width to 100% */
      margin: auto;
      min-height:200px;
  }
   @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
    }
   }
   label{
       position:relative;
       top:50%;
       left: 25%;
       bottom:50%;
   }
        </style>
    </head>
    <body>
        <div class="jumbotron">
        <header>
        <h1>Private Discussion Project</h1>
        </header>
        </div>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" value="data" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="logo.png" target="_blank"><img src="logo.png" height="300%" width="135%" style="overflow:auto;position:relative;left:0;"></a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav" style="margin-left:1%;">
                <li><a href="index.html" target="_self">Laman Awal</a></li>
                <li><a href="tentang kami.html" target="_self">Tentang</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li id="login" class="active"><a href="signup.php"><span class="glyphicon glyphicon-log-in" target="_self"></span> Login</a></li>
                <li id="daftar"><a href="daftar.html" target="_self"><span class="glyphicon glyphicon-user"></span> Daftar</a></li>
            </ul>
                    </div>
            </div>
        </nav>
        <label style="width:50%;height:100%">
            <legend>Silakan Masuk</legend>
        <form class="form-horizontal" action="forum.php" method="POST">
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input id="username" type="text" name="username" class="form-control" placeholder="Username" autocomplete="off" required/>
      <span class="help-block">Username dan password case sensitif!</span>
    </div>
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      <input id="password" type="password" name="password" class="form-control" placeholder="Password" autocomplete="off" required/>
      <span class="help-block">Belum punya akun? silakan <a href="daftar.html"> daftar</a></span>
    </div>
    <br>
  <div class="input-group">
        <button type="submit" class="btn btn-default">Submit</button>
      </div> 
  </form>
  <form class="form-horizontal" action="cek nim.php" method="POST">
  <div class="input-group">
    <input type="text" name="nomor" class="form-control" placeholder="Mencari apakah NIM anda terdaftar" required>
    <div class="input-group-btn">
      <button class="btn btn-default" type="submit">
        <i class="glyphicon glyphicon-search"></i>
      </button>
    </div>
  </div>
    </form>
        </label>
         <hr>
        <p style="text-align:center;">Kalau anda lupa password ataupun username. Anda harus hubungi admin untuk reset akun kemudian anda bisa daftar ulang!</p>
        <p style="text-align:center;">Untuk saat ini belum ada sistem verifikasi email ataupun kode pemulihan akun. jadi agak merepotkan harus hubungi admin.</p>
        <footer class="container-fluid text-center">
            Hakcipta &copy; Milik: Winto Junior Khosasih dan robby walsen
        </footer>
    </body>
</html>