<?php
include 'connect.php';

session_start(); // Start the session at the very beginning

if (!isset($_SESSION["id"]) || $_SESSION["id"] == "") {
    header("location:index.php");
    exit();
}

if ($_SESSION["memtype"] != 1) {
    echo "<div class='container mt-4'><p class='text-center text-danger'>คุณไม่มีสิทธิ์เข้าถึงหน้านี้</p></div>";
    exit();
}

// Initialize error and success messages
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
        $shop_pic = $row['shop_pic'];
    } else {
        $error_message = "ไม่พบข้อมูลร้านนี้"; // Set error message
    }

    mysqli_stmt_close($stmt);
} else {
    $error_message = "ไม่ได้ระบุ ID ร้าน"; // Set error message if ID is missing
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $shop_name = $_POST['shop_name'];
    $shop_address = $_POST['shop_address'];

    if (isset($_FILES['shop_pic']) && $_FILES['shop_pic']['error'] == 0) {
        $file_name = $_FILES['shop_pic']['name'];
        $file_tmp = $_FILES['shop_pic']['tmp_name'];
        $file_size = $_FILES['shop_pic']['size'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        $allowed_exts = array("jpg", "jpeg", "png", "gif");
        $max_size = 5 * 1024 * 1024; // 5MB

        if (!in_array($file_ext, $allowed_exts)) {
            $error_message = "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
        } elseif ($file_size > $max_size) {
            $error_message = "File size exceeds the limit of 5MB.";
        } else {
            $new_file_name = 'shop_' . time() . '.' . $file_ext;
            if (move_uploaded_file($file_tmp, 'pic/' . $new_file_name)) {
                $sql = "UPDATE shop SET shop_name = ?, shop_address = ?, shop_pic = ? WHERE shopid = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 'sssi', $shop_name, $shop_address, $new_file_name, $shop_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                $success_message = "ข้อมูลร้านนวดถูกแก้ไขเรียบร้อยแล้ว";
            } else {
                $error_message = "Error uploading file.";
            }
        }
    } else {
        $sql = "UPDATE shop SET shop_name = ?, shop_address = ? WHERE shopid = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssi', $shop_name, $shop_address, $shop_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $success_message = "ข้อมูลร้านนวดถูกแก้ไขเรียบร้อยแล้ว";
    }

    if (empty($error_message) && !empty($success_message)) {
      header("location: homeadmin.php?success=1"); // Redirect with success parameter
      exit();
  }

}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    </head>
<body class="bg-light">
    <div class="container mt-4 bg-white p-4 rounded shadow">
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            </form>
    </div>

    </body>
</html>