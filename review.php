<?php
include 'connect.php';

if (!isset($_SESSION["id"])) {
    header("location:index.php");
    exit();
}

// ดึงข้อมูลรีวิว
$reviews = [];
$sql = "SELECT * FROM reviews ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $reviews[] = $row;
    }
} else {
    $error_message = "ไม่สามารถดึงข้อมูลรีวิวได้";
}

// ดึงชื่อผู้ใช้จากฐานข้อมูล
if (!isset($_SESSION['name'])) {
    $sql = "SELECT fullname FROM member WHERE memid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['name'] = $row['fullname'];
    }
    mysqli_stmt_close($stmt);
}

// ดึงรายชื่อพนักงานที่ให้บริการ
$employees = [];
$sql = "SELECT memid, fullname FROM member WHERE memtype = 2"; // memtype = 2 คือพนักงาน
$result = mysqli_query($conn, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $employees[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รีวิวการใช้บริการ</title>
    <link rel="stylesheet" href="bootstrap.css">
    <style>
        .review-card {
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-light">

<?php
if ($_SESSION["memtype"] == 1) {
    include 'navbaradmin.php';
} elseif ($_SESSION["memtype"] == 2) {
    include 'navbaremployee.php';
} elseif ($_SESSION["memtype"] == 3) {
    include 'navbarmember.php';
} else {
    echo "ประเภทสมาชิกไม่ถูกต้อง";
}
?>

<div class="container my-5">
    <h1 class="text-center text-primary mb-4">รีวิวการใช้บริการ</h1>

    <div class="bg-white p-4 rounded review-card mb-5">
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger text-center"><?= $error_message ?></div>
        <?php endif; ?>

        <form action="submit_review.php" method="POST">
            <div class="mb-3">
                <label class="form-label">ชื่อของคุณ</label>
                <input type="text" name="name" class="form-control fs-5" value="<?= htmlspecialchars($_SESSION['name']) ?>" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">รีวิว</label>
                <textarea name="review" class="form-control fs-5" rows="4" placeholder="พิมพ์รีวิวของคุณที่นี่..." required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">ให้คะแนน (1-5)</label>
                <select name="rating" class="form-select fs-5" required>
                    <option value="5">5 - ดีเยี่ยม</option>
                    <option value="4">4 - ดี</option>
                    <option value="3">3 - ปานกลาง</option>
                    <option value="2">2 - พอใช้</option>
                    <option value="1">1 - แย่</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">เลือกพนักงานที่ให้บริการ</label>
                <select name="memid" class="form-select fs-5" required>
                    <option value="" disabled selected>เลือกพนักงาน</option>
                    <?php foreach ($employees as $employee): ?>
                        <option value="<?= $memid['memid'] ?>"><?= htmlspecialchars($employee['fullname']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-success w-100 fs-5">ส่งรีวิว</button>
        </form>
    </div>

    <h2 class="mb-3">รีวิวทั้งหมด</h2>
    <div class="bg-white p-4 rounded review-card">
        <?php if (!empty($reviews)): ?>
            <?php foreach ($reviews as $review): ?>
                <div class="mb-3 border-bottom pb-3">
                    <h5 class="mb-1"> <?= htmlspecialchars($review['name']) ?> 
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
