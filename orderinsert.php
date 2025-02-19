<?php
    include 'connect.php';

    $cusid=$_SESSION["id"];
    $empid=$_GET["empid"];
    $checkin=date("Y-m-d H-i-s");
    $track="รอการรับงาน";

    $sql = "INSERT INTO orders (cusid, empid, checkin, track)
    VALUES ('$cusid','$empid','$checkin','$track')";
    $re = mysqli_query($conn,$sql);
    
    if ($re) {
        header("location:follow.php");
    } else {
        echo 'ไม่พบข้อมูล';
    }

?>