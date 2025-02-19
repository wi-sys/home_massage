<?php 
  include 'connect.php'; 
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลสมาชิก</title>
    <link href="bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="style.css" rel="stylesheet" type="text/css" />
    <style>
        .member-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s;
        }
        .member-card:hover {
            transform: scale(1.05);
        }
        .member-card img {
            border-radius: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Navbar -->
    <?php 
        if ($_SESSION["memtype"] == 1) {
            include 'navbaradmin.php';
        } else if ($_SESSION["memtype"] == 2) {
            include 'navbaremployee.php';
        } else if ($_SESSION["memtype"] == 3) {
            include 'navbarmember.php';
        } else {
            echo "<div class='alert alert-danger text-center'>ประเภทสมาชิกไม่ถูกต้อง</div>";
        }
    ?>

    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="text-success">ข้อมูลสมาชิก</h1>
            <a href="useradd.php" class="btn btn-primary">+ เพิ่มสมาชิก</a>
        </div>

        <div class="row g-4">
            <?php
                $sql = "SELECT * FROM member";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='col-md-4'>";
                        echo "<div class='member-card p-3'>";
                        echo "<img src='pic/emp.png' width='150' height='150' class='img-fluid'>";
                        echo "<h5 class='mt-3'>{$row['fullname']}</h5>";
                        echo "<p><strong>ที่อยู่:</strong> {$row['maddress']}</p>";
                        echo "<p><strong>สมัครเมื่อ:</strong> {$row['mdate']}</p>";
                        echo "<div class='d-grid gap-2'>";
                        echo "<a href='userupdate.php?memid={$row['memid']}' class='btn btn-warning'>แก้ไข</a>";
                        echo "<a href='userdeletedb.php?memid={$row['memid']}' class='btn btn-danger' onclick=\"return confirm('ยืนยันการลบสมาชิกนี้?');\">ลบ</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='col-12 text-center text-danger'><p>ไม่มีข้อมูลสมาชิก</p></div>";
                }
            ?>
        </div>
    </div>

    <?php include "footer.php"; ?>
    <script src="bootstrap.bundle.js"></script>
</body>
</html>
