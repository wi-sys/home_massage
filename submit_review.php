<?php
    include 'connect.php';
    session_start();

    if (!isset($_SESSION['id'])) {
        header("Location: index.php");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_SESSION['name'];
        $review = trim($_POST['review']);
        $rating = (int)$_POST['rating'];
        $employee_id = (int)$_POST['employee_id']; // รับค่า employee_id จากฟอร์ม

        if (!empty($review) && $rating >= 1 && $rating <= 5 && $employee_id > 0) {
            $sql = "INSERT INTO reviews (name, review, rating, employee_id, created_at) VALUES (?, ?, ?, ?, NOW())";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssii", $name, $review, $rating, $employee_id);
            
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['success_message'] = "รีวิวของคุณถูกบันทึกเรียบร้อยแล้ว";
            } else {
                $_SESSION['error_message'] = "เกิดข้อผิดพลาดในการบันทึกรีวิว";
            }
            mysqli_stmt_close($stmt);
        } else {
            $_SESSION['error_message'] = "กรุณากรอกข้อมูลให้ถูกต้อง";
        }
    }

    header("Location: review.php");
    exit();
?>
