<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มสมาชิก</title>
    <link href="bootstrap.css" rel="stylesheet" type="text/css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            max-width: 600px;
            margin: auto;
            border-radius: 15px;
        }
        .form-control {
            font-size: 1.2rem;
        }
        .btn-custom {
            width: 100%;
            font-size: 1.2rem;
            padding: 10px;
        }
    </style>
</head>

<body>

<!-- นำเข้า Navbar ตามประเภทสมาชิก -->
<?php 
    if ($_SESSION["memtype"] == 1) {
        include 'navbaradmin.php';
    } else if ($_SESSION["memtype"] == 2) {
        include 'navbaremployee.php';
    } else if ($_SESSION["memtype"] == 3) {
        include 'navbarmember.php';
    } else {
        echo "<div class='container mt-4'><p class='text-center text-danger'>ประเภทสมาชิกไม่ถูกต้อง</p></div>";
        exit();
    } 
?>

<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="text-center text-primary">เพิ่มสมาชิก</h2>
        <form id="form1" name="form1" method="post" action="userinsert.php">
            
            <div class="mb-3">
                <label class="form-label">ชื่อสมาชิก</label>
                <input type="text" class="form-control" name="fullname" required>
            </div>

            <div class="mb-3">
                <label class="form-label">ที่อยู่</label>
                <input type="text" class="form-control" name="maddress" required>
            </div>

            <div class="mb-3">
                <label class="form-label">เบอร์โทร</label>
                <input type="tel" class="form-control" name="tel" required>
            </div>

            <div class="mb-3">
                <label class="form-label">รหัสผ่าน</label>
                <input type="password" class="form-control" name="pass" required>
            </div>

            <div class="mb-3">
                <label class="form-label">ประเภทสมาชิก</label>
                <select class="form-select" name="memtype" required>
                    <option value="" disabled selected>เลือกประเภทสมาชิก</option>
                    <option value="1">แอดมิน</option>
                    <option value="2">พนักงาน</option>
                    <option value="3">ลูกค้า</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-custom">บันทึก</button>
        </form>
    </div>
</div>

<?php include "footer.php"; ?>
<script src="bootstrap.bundle.js"></script>

</body>
</html>
