<?php
include 'connect.php';

if (!isset($_SESSION["id"]) || $_SESSION["id"] == "") {
    header("location:index.php");
    exit();
}

if ($_SESSION["memtype"] != 1) {
    echo "<div class='container mt-4'><p class='text-center text-danger'>คุณไม่มีสิทธิ์เข้าถึงหน้านี้</p></div>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $shop_name = $_POST['shop_name'];
    $shop_address = $_POST['shop_address'];
    $image_data = null;

    if (!empty($_FILES['shop_pic']['name'])) {
        $file_tmp = $_FILES['shop_pic']['tmp_name'];
        $file_size = $_FILES['shop_pic']['size'];
        $file_ext = strtolower(pathinfo($_FILES['shop_pic']['name'], PATHINFO_EXTENSION));

        // ✅ ประเภทไฟล์ที่รองรับ
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'tiff'];

        if (in_array($file_ext, $allowed_ext) && $file_size <= 5 * 1024 * 1024) {
            $image_data = file_get_contents($file_tmp);
        } else {
            echo "<p class='text-danger'>ไฟล์ไม่ถูกต้องหรือขนาดใหญ่เกินไป</p>";
        }
    }

    // ✅ เพิ่มข้อมูลร้านค้า พร้อมรูปภาพลงฐานข้อมูล
    $sql = "INSERT INTO shop (shop_name, shop_address, shop_pic) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sss', $shop_name, $shop_address, $image_data);
    mysqli_stmt_send_long_data($stmt, 2, $image_data);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        header("location: homeadmin.php");
        exit();
    } else {
        echo "<p class='text-danger text-center'>เกิดข้อผิดพลาด: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มร้านนวด</title>
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body class="bg-light">
<?php include 'navbaradmin.php'; ?>

<div class="container mt-4 bg-white p-4 rounded shadow">
    <header class="text-center mb-4">
        <h1 class="text-success">เพิ่มร้านนวด</h1>
    </header>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="shop_name" class="form-label">ชื่อร้าน</label>
            <input type="text" class="form-control" id="shop_name" name="shop_name" required>
        </div>
        <div class="mb-3">
            <label for="shop_address" class="form-label">ที่อยู่</label>
            <textarea class="form-control" id="shop_address" name="shop_address" required></textarea>
        </div>
        <div class="mb-3">
            <label for="shop_pic" class="form-label">รูปภาพร้าน</label>
            <input type="file" class="form-control" id="shop_pic" name="shop_pic" accept="image/*">
        </div>
        <button type="submit" class="btn btn-success">เพิ่มร้านใหม่</button>
    </form>
</div>

<script src="bootstrap.bundle.min.js"></script>
</body>
</html>
