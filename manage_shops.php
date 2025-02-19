<?php
    include 'connect.php';

    if (!isset($_SESSION["id"]) || $_SESSION["id"] == "") {
        header("location:index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการร้านนวด</title>
    <link rel="stylesheet" href="bootstrap.css">
    <style>
        .table img {
            border-radius: 10px;
            object-fit: cover;
        }
        .btn-custom {
            padding: 10px 15px;
            font-size: 16px;
        }
    </style>
</head>
<body class="bg-light">

<?php 
    if ($_SESSION["memtype"] == 1) {
        include 'navbaradmin.php';
    } else {
        echo "<div class='container mt-4'><p class='text-center text-danger'>คุณไม่มีสิทธิ์เข้าถึงหน้านี้</p></div>";
        exit();
    }
?>

<div class="container mt-4 bg-white p-4 rounded shadow">
    <header class="text-center mb-4">
        <h1 class="text-success">จัดการร้านนวด</h1>
    </header>
    <div class="d-flex justify-content-between mb-3">
        <h3>รายชื่อร้านนวด</h3>
        <a href="add_shop.php" class="btn btn-success btn-custom">+ เพิ่มร้านใหม่</a>
    </div>

    <table class="table table-hover table-bordered text-center">
        <thead class="bg-success text-white">
            <tr>
                <th>#</th>
                <th>ชื่อร้าน</th>
                <th>ที่อยู่</th>
                <th>รูปภาพ</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Use prepared statement to avoid SQL injection
            $sql = "SELECT * FROM shop";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $count = 1;

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo htmlspecialchars($row['shop_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['shop_address']); ?></td>
                        <td>
                            <img src="pic/<?php echo isset($row['shop_pic']) ? $row['shop_pic'] : 'default.jpg'; ?>" 
                                 alt="ร้านนวด" width="100" height="100">
                        </td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['shopid']; ?>" class="btn btn-warning btn-sm">แก้ไข</a>
                            <a href="delete.php?id=<?php echo $row['shopid']; ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('ยืนยันการลบร้านนี้?');">ลบ</a>
                        </td>
                    </tr>
                <?php }
            } 

            // Close prepared statement
            mysqli_stmt_close($stmt);
            ?>
        </tbody>
    </table>
</div>

<script src="bootstrap.bundle.min.js"></script>
</body>
</html>
