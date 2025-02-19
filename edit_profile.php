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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
        $tel = mysqli_real_escape_string($conn, $_POST['tel']);
        $maddress = mysqli_real_escape_string($conn, $_POST['maddress']);
        $job = mysqli_real_escape_string($conn, $_POST['job']);
        $password = $_POST['password'];

        // อัปโหลดรูปภาพใหม่ (ถ้ามี)
        if (!empty($_FILES["pic"]["name"])) {
            $pic = basename($_FILES["pic"]["name"]);
            $target_file = "pic/" . $pic;
            move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file);
        } else {
            $pic = $user['pic']; // ใช้รูปเดิมถ้าไม่ได้อัปโหลดใหม่
        }

        // อัปเดตข้อมูล
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $update_sql = "UPDATE member SET fullname='$fullname', tel='$tel', maddress='$maddress', job='$job', pass='$hashed_password', pic='$pic' WHERE memid='$memid'";
        } else {
            $update_sql = "UPDATE member SET fullname='$fullname', tel='$tel', maddress='$maddress', job='$job', pic='$pic' WHERE memid='$memid'";
        }

        if (mysqli_query($conn, $update_sql)) {
            echo "<script>alert('อัปเดตโปรไฟล์เรียบร้อย'); window.location='profile.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด! กรุณาลองใหม่');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขโปรไฟล์</title>
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body class="bg-light">
<?php
    if ($_SESSION["memtype"]==1) {
        include 'navbaradmin.php';
    } else if ($_SESSION["memtype"]==2) {
        include 'navbaremployee.php';
    } else if ($_SESSION["memtype"]==3) {
        include 'navbarmember.php';
    } else {
        echo 'ไม่พบข้อมูล';
    }
    ?>
<div class="container mt-4 bg-white p-4 rounded shadow">
    <h2 class="text-center">แก้ไขโปรไฟล์</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3 text-center">
            <img src="pic/<?php echo htmlspecialchars($user['pic']); ?>" alt="Profile Picture" class="rounded-circle" width="120">
            <input type="file" name="pic" class="form-control mt-2">
        </div>
        <div class="mb-3">
            <label class="form-label">ชื่อเต็ม</label>
            <input type="text" name="fullname" class="form-control" value="<?php echo htmlspecialchars($user['fullname']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">เบอร์โทร</label>
            <input type="text" name="tel" class="form-control" value="<?php echo htmlspecialchars($user['tel']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">ที่อยู่</label>
            <input type="text" name="maddress" class="form-control" value="<?php echo htmlspecialchars($user['maddress']); ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">รหัสผ่านใหม่ (ถ้าไม่ต้องการเปลี่ยน ปล่อยว่าง)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-success w-100">บันทึกการเปลี่ยนแปลง</button>
        <a href="profile.php" class="btn btn-secondary w-100 mt-2">ย้อนกลับ</a>
    </form>
</div>

<script src="bootstrap.bundle.min.js"></script>
</body>
</html>
