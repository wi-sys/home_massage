<?php 
include 'connect.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติการให้บริการ</title>
    <link rel="stylesheet" href="bootstrap.css">
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
        echo '<div class="alert alert-danger text-center">ไม่พบข้อมูล</div>';
    }
    ?>

    <div class="container mt-4">
        <h1 class="text-center text-primary fw-bold">ประวัติการให้บริการ</h1>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover bg-white shadow-sm rounded">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>รูปภาพ</th>
                                <th>ลูกค้า</th>
                                <th>เบอร์โทรศัพท์</th>
                                <th>ที่อยู่</th>
                                <th>ค่าบริการ</th>
                                <th>สถานะ</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">

                        <?php
                        $empid = $_SESSION["id"];

                        $sql = "SELECT * FROM orders
                                INNER JOIN member ON orders.cusid = member.memid
                                WHERE orders.empid = '$empid' 
                                AND (orders.track = 'จบงาน' OR orders.track = 'ยกเลิก')";
                        $re = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($re) > 0) {
                            while ($row = mysqli_fetch_assoc($re)) {
                                echo "<tr>";
                                echo "<td><img src='pic/emp.png' width='80' class='rounded-circle'></td>";
                                echo "<td>" . $row["fullname"] . "</td>";
                                echo "<td>" . $row["tel"] . "</td>";
                                echo "<td>" . $row["maddress"] . "</td>";
                                echo "<td>" . number_format($row["pay"], 2) . " บาท</td>";
                                echo "<td>";
                                if ($row["track"] == "จบงาน") {
                                    echo "<span class='badge bg-success'>จบงาน</span>";
                                } else {
                                    echo "<span class='badge bg-danger'>ยกเลิก</span>";
                                }
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo '<tr><td colspan="6" class="text-center text-muted">ไม่พบข้อมูล</td></tr>';
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="bootstrap.bundle.js"></script>
</body>
</html>
