<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $shop_id = $_GET['id'];

    $sql = "SELECT shop_pic FROM shop WHERE shopid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $shop_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result) && !empty($row['shop_pic'])) {
        header("Content-Type: image/jpeg"); // เปลี่ยนเป็นไฟล์ประเภทที่เหมาะสม
        echo $row['shop_pic'];
    } else {
        header("Content-Type: image/png");
        readfile("pic/default.jpg"); // รูปเริ่มต้น
    }

    mysqli_stmt_close($stmt);
}
?>
