<?php
include 'connect.php';

// ตรวจสอบว่ามีค่า memid ที่ส่งมาหรือไม่
if (!isset($_GET["memid"]) || empty($_GET["memid"])) {
    die("<div class='container text-danger fs-4 mt-4'>ข้อผิดพลาด: ไม่พบข้อมูลสมาชิก</div>");
}

$memid = mysqli_real_escape_string($conn, $_GET["memid"]);

// ดึงข้อมูลสมาชิกจากฐานข้อมูล
$sql = "SELECT * FROM member WHERE memid = '$memid'";
$result = mysqli_query($conn, $sql);

// ตรวจสอบว่าพบข้อมูลหรือไม่
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    die("<div class='container text-danger fs-4 mt-4'>ไม่พบข้อมูลสมาชิก</div>");
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>แก้ไขข้อมูลสมาชิก</title>
    <link href="bootstrap.css" rel="stylesheet">
    <style>
        .container {
            max-width: 600px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-light">

<?php 
// นำเข้า Navigation ตามประเภทสมาชิก
if ($_SESSION["id"] == 1) {
    include 'navbaradmin.php';
} else {
    include 'navbarmember.php';
} 
?>

<div class="container mt-5">
    <div class="card p-4">
        <h2 class="text-center text-primary">แก้ไขข้อมูลสมาชิก</h2>

        <form method="post" action="userupdatedb.php">
            <div class="mb-3">
                <label class="form-label">ชื่อสมาชิก</label>
                <input type="text" class="form-control fs-5" name="fullname" value="<?php echo htmlspecialchars($row['fullname']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">อัปโหลดรูปภาพ</label>
                <input type="file" class="form-control fs-5" name="profile_image" accept="image/*">
            </div>
            <div class="mb-3">
                <label class="form-label">ที่อยู่</label>
                <input type="text" class="form-control fs-5" name="maddress" value="<?php echo htmlspecialchars($row['maddress']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">เบอร์โทร</label>
                <input type="tel" class="form-control fs-5" name="tel" value="<?php echo htmlspecialchars($row['tel']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">รหัสผ่าน</label>
                <input type="password" class="form-control fs-5" name="pass" value="<?php echo htmlspecialchars($row['pass']); ?>" required>
            </div>

            <input type="hidden" name="memid" value="<?php echo $row['memid']; ?>">

            <div class="text-center">
                <button type="submit" class="btn btn-primary fs-5 px-4">บันทึก</button>
                <a href="users.php" class="btn btn-secondary fs-5 px-4">ยกเลิก</a>
            </div>
        </form>
    </div>
</div>

<?php include "footer.php"; ?>

<script src="bootstrap.bundle.js"></script>
</body>

</html>
