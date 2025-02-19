<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Massage Navigation</title>
    <link rel="stylesheet" href="bootstrap.css"> <!-- ใช้ Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"> <!-- ไอคอน Bootstrap -->
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg" style="background-color: #4d6b56; color: light;">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand text-light" href="job.php">
                <img src="pic/1.png" alt="Logo" width="65" height="65" class="d-inline-block align-text-center">
                HOME MASSAGE
            </a>
            <!-- Toggler for mobile -->
            <button class="navbar-toggler text-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <!-- Menu -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    
                    <li class="nav-item">
                        <a class="nav-link text-light" href="homeemployee.php">รับงาน</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-light" href="track-finish.php">ประวัติการรับงาน</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-light" href="reviewemp.php">รีวิวการทำงาน</a>
                    </li>

                    <!-- แก้ไขโปรไฟล์ -->
                    <li class="nav-item">
                        <a class="nav-link text-light" href="edit_profile.php">แก้ไขโปรไฟล์</a>
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

    <script src="bootstrap.bundle.min.js"></script>
</body>
</html>
