<?php
    session_start();
    date_default_timezone_set("Asia/Bangkok");
    
    $host="localhost";
    $user="root";
    $pass="";
    $dbname="sabai";

    $conn = mysqli_connect($host,$user,$pass,$dbname);

    if (!$conn) {
        echo"การเชื่อมต่อผิดพลาด";
    }
?>