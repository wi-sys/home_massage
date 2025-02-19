<?php include 'connect.php'; ?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รับงาน</title>
    <link href="bootstrap.css" rel="stylesheet" type="text/css">
    <style>
        /* ปรับแต่งการ์ด */
        .card-custom {
            border-radius: 10px;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
        }

        .card-custom img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
        }

        .card-custom .card-body {
            text-align: center;
        }

        .card-custom .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-top: 15px;
        }

        .order-info p {
            font-size: 1rem;
            margin-bottom: 5px;
        }

        .card-custom .btn {
            width: 48%;
            margin: 10px 5px;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: #007bff;
            text-align: center;
        }

        .order-info {
            font-size: 1.1rem;
            margin-top: 10px;
        }

        .order-info p {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?php
    if ($_SESSION["memtype"] == 1) {
        include 'navbaradmin.php';
    } else if ($_SESSION["memtype"] == 2) {
        include 'navbaremployee.php';
    } else if ($_SESSION["memtype"] == 3) {
        include 'navbarmember.php';
    } else {
        echo 'ไม่พบข้อมูล';
    }
    ?>

    <div class="container my-5">
        <h1 class="section-title">รับงาน</h1>

        <div class="row">
            <?php
            $empid = $_SESSION["id"];
            $track = "รอการรับงาน";

            $sql = "SELECT * FROM orders
                    INNER JOIN member
                    ON orders.cusid = member.memid
                    WHERE orders.empid = '$empid'
                    AND orders.track = '$track'";

            $re = mysqli_query($conn, $sql);

            if (mysqli_num_rows($re) > 0) {
                while ($row = mysqli_fetch_assoc($re)) {
                    echo "<div class='col-md-4 mb-4'>";
                    echo "<div class='card card-custom'>";
                    echo "<img src='pic/emp.png' class='card-img-top' alt='Employee Image'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . $row["fullname"] . "</h5>";
                    echo "<div class='order-info'>";
                    echo "<p>เบอร์โทรศัพท์: " . $row["tel"] . "</p>";
                    echo "<p>ที่อยู่: " . $row["maddress"] . "</p>";
                    echo "</div>";
                    echo "<div class='d-flex justify-content-between'>";
                    echo "<a href='track-go.php?track=กำลังออกบริการ&orderid=$row[orderid]' class='btn btn-warning'>รับงาน</a>";
                    echo "<a href='track-cencel.php?track=ยกเลิก&orderid=$row[orderid]' class='btn btn-danger'>ยกเลิก</a>";
                    echo "</div>";
                    echo "</div>"; // .card-body
                    echo "</div>"; // .card-custom
                    echo "</div>"; // .col-md-4
                }
            } else {
                echo '<div class="col-12 text-center"><p>ไม่พบข้อมูล</p></div>';
            }
            ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="bootstrap.bundle.js"></script>
</body>
</html>
