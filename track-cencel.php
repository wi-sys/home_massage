<?php
    include 'connect.php';

    $orderid=$_GET["orderid"];
    $empid=$_GET["empid"];
    $checkout=date("Y-m-d H-i-s");
    $track="ยกเลิก";
    $memid=$_SESSION["id"];

    $sql = "UPDATE orders SET 
    checkout='$checkout',
    track='$track',
    pay=0
    WHERE orderid='$orderid'";
    mysqli_query($conn,$sql);

    $sql = "UPDATE member SET job='ว่าง'
   WHERE memid='$memid'";
    mysqli_query($conn,$sql);

    header("location:historyemp.php");

?>