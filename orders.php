<?php include 'connect.php'; ?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เลือกหมอนวด</title>
    <link href="bootstrap.css" rel="stylesheet" type="text/css">
    <style>
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .card-img-top {
            height: 250px;
            object-fit: cover;
        }
        .card-body {
            background-color: #fff;
            padding: 20px;
            text-align: center;
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .card-text {
            font-size: 1rem;
            color: #6c757d;
        }
        .btn-success {
            font-size: 1rem;
        }
        .container {
            max-width: 1200px;
        }
        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #28a745;
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

    <div class="container mt-5">
        <header class="text-center mb-5">
            <h1>เลือกหมอนวด</h1>
        </header>

        <div class="row">
            <?php
            $sql = "SELECT * FROM member WHERE memtype=2";
            $re = mysqli_query($conn,$sql);
            
            if (mysqli_num_rows($re) > 0) {
                while ($row = mysqli_fetch_assoc($re)) {
                    $picname = $row['pic'];
                    ?>
                    <div class="col-md-4 text-center">
                        <div class="card-center shadow-sm border-light rounded">
                            <img src='pic/emp.png' width='150' height='150'>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['fullname']); ?></h5>
                                <p class="card-text">ราคา 400 บาท</p>
                                <a href="orderinsert.php?empid=<?php echo $row['memid']; ?>" class="btn btn-success btn-lg">เลือก</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<p class="text-center text-danger">ไม่พบข้อมูล</p>';
            }
            ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="bootstrap.bundle.min.js"></script>
</body>
</html>
