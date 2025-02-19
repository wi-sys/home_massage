<?php
session_start();
include 'connect.php';

if (!isset($_SESSION["id"]) || $_SESSION["id"] == "") {
    header("location:index.php");
    exit();
}

if ($_SESSION["memtype"] != 1) {
    echo "<div class='container mt-4'><p class='text-center text-danger'>คุณไม่มีสิทธิ์เข้าถึงหน้านี้</p></div>";
    exit();
}

if (isset($_GET['id'])) {
    $shop_id = $_GET['id'];

    // Fetch shop details to delete the image file
    $sql = "SELECT shop_pic FROM shop WHERE shopid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $shop_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $shop_pic = $row['shop_pic'];
        // Delete the image file if it exists
        if ($shop_pic && file_exists("pic/$shop_pic")) {
            unlink("pic/$shop_pic");
        }

        // Delete shop from database
        $sql = "DELETE FROM shop WHERE shopid = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $shop_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    header("location: homeadmin.php");
    exit();
} else {
    echo "<div class='container mt-4'><p class='text-center text-danger'>ไม่พบข้อมูลร้านที่ต้องการลบ</p></div>";
}
?>
