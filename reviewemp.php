<?php
    include 'connect.php';

    if (!isset($_SESSION['id']) || $_SESSION['memtype'] != 2) { // ตรวจสอบว่าเป็นพนักงาน
        header("Location: index.php");
        exit();
    }

    $reviews = [];
    $emp_id = $_SESSION['id'];
    $sql = "SELECT * FROM reviews WHERE employee_id = ? ORDER BY created_at DESC";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $emp_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $reviews[] = $row;
        }
    } else {
        $error_message = "ไม่สามารถดึงข้อมูลรีวิวได้";
    }
    mysqli_stmt_close($stmt);
?>

<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รีวิวจากลูกค้า</title>
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body class="bg-light">
    <?php include 'navbaremployee.php'; ?>

    <div class="container my-5">
        <h1 class="text-center mb-4">รีวิวจากลูกค้า</h1>
        <div class="bg-white p-4 rounded shadow-sm">
            <?php if (!empty($reviews)): ?>
                <?php foreach ($reviews as $review): ?>
                    <div class="mb-3 border-bottom pb-3">
                        <h5 class="mb-1"><?= htmlspecialchars($review['name']) ?> 
                            <span class="text-warning">
                                <?= str_repeat('★', $review['rating']) ?><?= str_repeat('☆', 5 - $review['rating']) ?>
                            </span>
                        </h5>
                        <p class="mb-0">"<?= htmlspecialchars($review['review']) ?>"</p>
                        <small class="text-muted">โพสต์เมื่อ: <?= $review['created_at'] ?></small>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">ยังไม่มีรีวิวในขณะนี้</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="bootstrap.bundle.min.js"></script>
</body>
</html>