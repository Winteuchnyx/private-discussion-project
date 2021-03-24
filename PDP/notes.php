<?php 
    session_start();
    require 'engine.php';
    include 'SQL connect.php';
    $catatan=mysqli_query($con,"SELECT * FROM notes");
    mysqli_query($con,"DELETE * FROM notes WHERE tanggal < (NOW() - INTERVAL 60 DAY) ");
    while($bar=mysqli_fetch_array($catatan))
    {
    echo"
        <li style='font-weight:bold;font-style:italic;font-size:150%;color:#B80047'><span> User: " .$usernotes=$bar["username"]. "</span></li>
        <li style='float:right;'><span>" .$notedate=$bar["tanggal"]. "</span></li>
        <li><p style='overflow:auto;white-space:pre-wrap;font-size:130%;'>" .$notemessage=$bar["pesan"]. "</p></li>
    ";}
    /*$catatan=mysqli_query($con,"SELECT * FROM notes");
    mysqli_query($con,"DELETE * FROM notes WHERE tanggal < (NOW() - INTERVAL 60 DAY) ");
    while($bar=mysqli_fetch_array($catatan))
    {
    echo"
    <div style='background-color: yellowgreen;'>
    <ul style='list-style-type:none;padding:0;margin:0;'>
        <li style='font-weight:bold;font-style:italic;font-size:150%;color:#B80047'><span> User: " .$usernotes=$bar["username"]. "</span></li>
        <li style='float:right;'><span>" .$notedate=$bar["tanggal"]. "</span></li>
        <li><p style='overflow:auto;white-space:pre-wrap;font-size:130%;'>" .$notemessage=$bar["pesan"]. "</p></li>
    <ul>
    </div>
    ";}*/
    ?>