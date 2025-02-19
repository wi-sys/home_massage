<?php
// นำเข้าไฟล์เชื่อมต่อฐานข้อมูล
include "connect.php";

// รับข้อมูลจากฟอร์ม
$tel = $_POST["tel"];
$profile_image = $_POST["pic"];
$pass = $_POST["pass"];
$fullname = $_POST["fullname"];
$maddress = $_POST["maddress"];
$memtype = $_POST["memtype"]; // รับค่าชนิดสมาชิกจากฟอร์ม

$job = "ว่าง"; // ค่าตั้งต้น
$mdate = date("Y-m-d"); // วันที่สมัคร

// ตรวจสอบค่าที่รับมา
echo "เบอร์โทร: $tel | รหัสผ่าน: $pass | ชื่อสกุล: $fullname | ที่อยู่: $maddress | ชนิด: $memtype";

// คำสั่ง SQL สำหรับเพิ่มข้อมูล
$sql = "INSERT INTO member (tel, pass, fullname, maddress, memtype, job, mdate) 
        VALUES ('$tel', '$pass', '$fullname', '$maddress', '$memtype', '$job', '$mdate')";

// ทำคำสั่ง SQL
$re = mysqli_query($conn, $sql);

// ตรวจสอบผลลัพธ์
if ($re) {
    header("Location: users.php"); // ไปหน้ารายชื่อสมาชิก
    exit();
} else {
    echo "<p class='text-danger'>ผิดพลาดในการบันทึกข้อมูล: " . mysqli_error($conn) . "</p>";
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>
