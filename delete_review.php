<?php
include 'connect.php';

if (!isset($_SESSION["id"])) {
    header("location:index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ตรวจสอบว่ารีวิวที่ต้องการลบมีอยู่หรือไม่
    if (isset($_POST['review_id'])) {
        $review_id = $_POST['review_id'];

        // ลบรีวิวจากฐานข้อมูล
        $sql = "DELETE FROM reviews WHERE review_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $review_id);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['message'] = "รีวิวถูกลบเรียบร้อยแล้ว";
        } else {
            $_SESSION['error_message'] = "ไม่สามารถลบรีวิวได้";
        }

        mysqli_stmt_close($stmt);
    }
    // เปลี่ยนเส้นทางกลับไปยังหน้ารีวิว
    header("location: homeadmin.php");
    exit();
}
?>
