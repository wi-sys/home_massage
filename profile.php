<?php

    include 'connect.php';

    if (!isset($_SESSION["id"]) || $_SESSION["id"] == "") {
        header("location:index.php");
        exit();
    }

    $memid = $_SESSION["id"];

    // ดึงข้อมูลสมาชิก
    $sql = "SELECT * FROM member WHERE memid = '$memid'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โปรไฟล์ของฉัน</title>
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body class="bg-light">
<div class="container mt-4 bg-white p-4 rounded shadow text-center">
    <h2>โปรไฟล์ของฉัน</h2>
    <div class="mb-3">
        <img src="pic/<?php echo htmlspecialchars($user['pic']); ?>" 
             alt="Profile Picture" 
             class="rounded-circle border" 
             width="150">
    </div>
    <p><strong>ชื่อเต็ม:</strong> <?php echo htmlspecialchars($user['fullname']); ?></p>
    <p><strong>เบอร์โทร:</strong> <?php echo htmlspecialchars($user['tel']); ?></p>
    <p><strong>ที่อยู่:</strong> <?php echo htmlspecialchars($user['maddress']); ?></p>
    <p><strong>วันที่สมัคร:</strong> <?php echo htmlspecialchars($user['mdate']); ?></p>

    <a href="edit_profile.php" class="btn btn-warning w-100 mt-3">แก้ไขโปรไฟล์</a>
    <a href="logout.php" class="btn btn-danger w-100 mt-2">ออกจากระบบ</a>
</div>

<script src="bootstrap.bundle.min.js"></script>
</body>
</html>
