<?php 
include 'connect.php'; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ติดตามการให้บริการ</title>
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

    <div class="container mt-4 text-center">
        <h1 class="text-center text-primary fw-bold">กำลังออกบริการ</h1>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mt-3">

            <?php
            $empid = $_SESSION["id"];
            $track = "กำลังออกบริการ";

            $sql = "SELECT * FROM orders
                    INNER JOIN member ON orders.cusid = member.memid
                    WHERE orders.empid = '$_SESSION[id]' 
                    AND orders.track = '$track'";
            $re = mysqli_query($conn, $sql);

            if (mysqli_num_rows($re) > 0) {
                while ($row = mysqli_fetch_assoc($re)) {
                    ?>
                    <div class="col-md-12">
                        <div class="card shadow-sm border-2 rounded-2">
                            <img src="pic/emp.png" class="card-img-top p-3" alt="รูปหมอนวด">
                            <div class="card-body text-center">
                                <h5 class="card-title text-success fw-bold">ชื่อหมอนวด: <?php echo $row["fullname"]; ?></h5>
                                <p class="card-text"><strong>เบอร์โทรศัพท์:</strong> <?php echo $row["tel"]; ?></p>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="track-finish.php?track=จบงาน&orderid=<?php echo $row['orderid']; ?>" class="btn btn-warning">จบงาน</a>
                                    <a href="track-cencel.php?track=ยกเลิก&orderid=<?php echo $row['orderid']; ?>" class="btn btn-danger">ยกเลิก</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                } 
            } else {
                echo '<div class="col-md-12 text-center text-muted">ไม่พบข้อมูล</div>';
            }
            ?>
        </div>
    </div>
<br>
    <?php include 'footer.php'; ?>
    <script src="bootstrap.bundle.js"></script>
</body>
</html>
