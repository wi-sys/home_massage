<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title>index</title>
<link href="bootstrap.css" rel="stylesheet" type="text/css">
</head>

<body>


    <div class="container fs-1 p-2">
    <h1 class="text-center">สมัครสมาชิก</h1>
        <form action="meminsert.php" method="post" enctype="multipart/form-data">
            <label class="form-label">รูปสมาชิก</label>
            <input type="file" class="form-control" name="fileToUpload" required>
            <label class="form-label">เบอร์โทรศัพท์</label>
            <input type="text" class="form-control" name="tel">
            <label class="form-label">รหัสผ่าน</label>
            <input type="password" class="form-control" name="pass">
            <label class="form-label">ชื่อ</label>
            <input type="text" class="form-control" name="fullname">
            <label class="form-label">ที่อยู่</label>
            <input type="text" class="form-control" name="maddress">
            <button type="submit" class="btn btn-primary">บันทึก</button>
        </form>
    </div>
<script src="bootstrap.bundle.js"></script>
</body>
</html>
