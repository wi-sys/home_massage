<?php include 'connect.php'; ?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ติดตาม</title>
    <link rel="stylesheet" href="bootstrap.css">
    <style>
        .masseur-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }
        .masseur-card:hover {
            transform: translateY(-5px);
        }
        .masseur-card img {
            width: 100%;
            max-width: 200px;
            margin-bottom: 15px;
            border-radius: 10px;
        }
        .masseur-card .btn-warning {
            font-size: 1.1rem;
            padding: 8px 20px;
            border-radius: 25px;
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <?php
    if ($_SESSION["memtype"]==1) {
        include 'navbaradmin.php';
    } else if ($_SESSION["memtype"]==2) {
        include 'navbaremployee.php';
    } else if ($_SESSION["memtype"]==3) {
        include 'navbarmember.php';
    } else {
        echo 'ไม่พบข้อมูล';
    }
    ?>

    <div class="container">
        <h1 class="text-center my-4">ติดตามสถานะการบริการ</h1>
        <div class="row">
            <?php
            $sql = "SELECT * FROM orders
                    INNER JOIN member ON orders.empid = member.memid
                    WHERE orders.cusid = '$_SESSION[id]'
                    AND (orders.track = 'รอการรับงาน' OR orders.track = 'กำลังออกบริการ')";
            $re = mysqli_query($conn, $sql);

            if (mysqli_num_rows($re) > 0) {
                while ($row = mysqli_fetch_assoc($re)) {
                    echo "<div class='col-md-6 col-lg-4 mb-4'>";
                        echo "<div class='masseur-card text-center'>";
                            echo "<img src='pic/emp.png' alt='หมอนวด'>";
                            echo "<h5>ชื่อหมอนวด: " . htmlspecialchars($row["fullname"]) . "</h5>";
                            echo "<p>เบอร์โทรศัพท์: " . htmlspecialchars($row["tel"]) . "</p>";
                            echo "<button class='btn btn-warning'>" . htmlspecialchars($row['track']) . "</button>";
                        echo "</div>";
                    echo "</div>";
                }
            } else {
                echo '<p class="text-center">ไม่พบข้อมูล</p>';
            }
            ?>
        </div>
    </div>

    <?php include'footer.php'; ?>

    <script src="bootstrap.bundle.js"></script>
</body>
</html>
