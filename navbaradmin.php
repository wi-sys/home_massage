<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Massage Navigation</title>
    
    <!-- ใช้ไฟล์ Bootstrap ที่อัปโหลด -->
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4d6b56;">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand text-light" href="homeadmin.php">
                <img src="pic/1.png" alt="Logo" width="65" height="65" class="d-inline-block align-text-center">
                HOME MASSAGE
            </a>
            
            <!-- Toggler for mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <!-- Menu -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    
                    <li class="nav-item">
                        <a class="nav-link text-light" href="follow.php">ติดตาม</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="orders.php">เลือกหมอนวด</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-light" href="users.php">จัดการบัญชีผู้ใช้</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="homeadmin.php">จัดการความคิดเห็น</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-light" href="manager_profile.php">ผู้จัดทำ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="logout.php">ออกจากระบบ</a>
                    </li>
                </ul>

                <!-- Search Form -->
                <form class="d-flex" role="search">
                    <input class="form-control me-2 bg-light text-dark" type="search" placeholder="ค้นหา" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div>
    </nav>

    <!-- ใช้ไฟล์ Bootstrap JS ที่อัปโหลด -->
    <script src="bootstrap.bundle.min.js"></script>
</body>
</html>
