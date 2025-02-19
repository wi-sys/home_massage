<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Massage Login</title>
    <!-- CSS  -->
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body class="bg-success d-flex justify-content-center align-items-center p-2" style="min-height: 95vh;">

    <div class="container bg-white rounded shadow-lg p-0" style="max-width: 900px; width: 100%;">
        <div class="row g-0">
            <!-- โลโก้ ฝั่งซ้าย -->
            <div class="col-lg-6 d-none d-lg-flex flex-column justify-content-center align-items-center text-center bg-success text-white p-4">
                <img src="pic/1.png" alt="Massage Logo" class="img-fluid mb-3" style="max-height: 300px;">
            </div>

            <!-- ฝั่งขวา -->
            <div class="col-lg-6 col-12 p-4">
                <h2 class="mb-4 text-center">เข้าสู่ระบบ</h2>
                <form action="logincheck.php" method="POST">
                    <div class="mb-3">
                        <label for="phone" class="form-label">เบอร์โทรศัพท์</label>
                        <input type="text" id="phone" name="tel" class="form-control" placeholder="เบอร์โทรศัพท์" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">รหัสผ่าน</label>
                        <input type="password" id="password" name="pass" class="form-control" placeholder="รหัสผ่าน" required>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember" class="form-check-label">จดจำรหัสผ่าน</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success w-100">เข้าสู่ระบบ</button>
                </form>
                <div class="text-center mt-3">
                    <p>ยังไม่มีบัญชีใช่ไหม? <a href="signin.php" class="text-decoration-none text-success">สร้างบัญชีผู้ใช้</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript  -->
    <script src="bootstrap.bundle.min.js"></script>
</body>
</html>