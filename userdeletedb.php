<?php
//นำเข้าไฟล์เชื่อมฐานข้อมูล
include "connect.php";
//รับข้อมูล
$memid = $_GET["memid"];

$sql = "DELETE FROM member WHERE memid='$memid' ";
mysqli_query($conn, $sql);

header("location:users.php");

?>