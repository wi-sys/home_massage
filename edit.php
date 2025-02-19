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

$error_message = "";
$success_message = "";

if (isset($_GET['id'])) {
    $shop_id = $_GET['id'];

    $sql = "SELECT * FROM shop WHERE shopid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $shop_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $shop_name = $row['shop_name'];
        $shop_address = $row['shop_address'];
        $shop_pic = $row['shop_pic']; // รูปภาพเป็น BLOB
    } else {
        $error_message = "ไม่พบข้อมูลร้านนี้";
    }

    mysqli_stmt_close($stmt);
} else {
    $error_message = "ไม่ได้ระบุ ID ร้าน";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $shop_name = $_POST['shop_name'];
    $shop_address = $_POST['shop_address'];

    if (isset($_FILES['shop_pic']) && $_FILES['shop_pic']['error'] == 0) {
        $file_tmp = $_FILES['shop_pic']['tmp_name'];
        $file_size = $_FILES['shop_pic']['size'];
        $file_ext = strtolower(pathinfo($_FILES['shop_pic']['name'], PATHINFO_EXTENSION));

        $allowed_exts = array("jpg", "jpeg", "png", "gif");
        $max_size = 5 * 1024 * 1024; // 5MB

        if (!in_array($file_ext, $allowed_exts)) {
            $error_message = "ไฟล์รูปภาพต้องเป็น JPG, JPEG, PNG หรือ GIF เท่านั้น";
        } elseif ($file_size > $max_size) {
            $error_message = "ขนาดไฟล์รูปภาพต้องไม่เกิน 5MB";
        } else {
            $image_data = file_get_contents($file_tmp);

            $sql = "UPDATE shop SET shop_name = ?, shop_address = ?, shop_pic = ? WHERE shopid = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'ssbi', $shop_name, $shop_address, $image_data, $shop_id);
            mysqli_stmt_send_long_data($stmt, 2, $image_data);

            if (mysqli_stmt_execute($stmt)) {
                $success_message = "ข้อมูลร้านนวดถูกแก้ไขเรียบร้อยแล้ว";
                header("location: homeadmin.php?success=1");
                exit();
            } else {
                $error_message = "เกิดข้อผิดพลาดในการอัปเดตข้อมูล";
            }
            mysqli_stmt_close($stmt);
        }
    } else {
        $sql = "UPDATE shop SET shop_name = ?, shop_address = ? WHERE shopid = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssi', $shop_name, $shop_address, $shop_id);
        if (mysqli_stmt_execute($stmt)) {
            $success_message = "ข้อมูลร้านนวดถูกแก้ไขเรียบร้อยแล้ว";
            header("location: homeadmin.php?success=1");
            exit();
        } else {
            $error_message = "เกิดข้อผิดพลาดในการอัปเดตข้อมูล";
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลร้านนวด</title>
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body class="bg-light">
<?php include 'navbaradmin.php'; ?>
<div class="container mt-4 bg-white p-4 rounded shadow">
    <header class="text-center mb-4">
        <h1 class="text-success">แก้ไขข้อมูลร้านนวด</h1>
    </header>

    <?php if (!empty($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <?php if (!empty($success_message)): ?>
        <div class="alert alert-success"><?php echo $success_message; ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">ชื่อร้าน</label>
            <input type="text" class="form-control" name="shop_name" value="<?php echo htmlspecialchars($shop_name); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">ที่อยู่</label>
            <textarea class="form-control" name="shop_address" required><?php echo htmlspecialchars($shop_address); ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">รูปภาพร้าน</label>
            <input type="file" class="form-control" name="shop_pic">
            <?php if (!empty($shop_pic)): ?>
                <img src="get_image.php?id=<?php echo $shop_id; ?>" alt="ร้านนวด" width="100" height="100" class="mt-2">
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-success">บันทึกการเปลี่ยนแปลง</button>
    </form>
</div>
<script src="bootstrap.bundle.min.js"></script>
</body>
</html>
