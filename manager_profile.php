<?php
    //ป้องกันคนที่ไม่ล็อกอินเข้าถึงไฟล์
    include 'connect.php';
    if($_SESSION["id"]==""){
        header("location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติผู้จัดทำ</title>
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body class="bg-success text-white">
<?php 
        if ($_SESSION["memtype"]==1) {
            //เซสชันประเภทสมาชิกเป็น 1 คือ แอดมิน ให้นำเข้า เนฟบาร์แอดมิน
            include'navbaradmin.php';
        } else if ($_SESSION["memtype"]==2) {
            //เซสชันประเภทสมาชิกเป็น 2 คือ แอดมิน ให้นำเข้า เนฟบาร์พนักงานนวด
            include'navbaremployee.php';
        } else if ($_SESSION["memtype"]==3) {
            //เซสชันประเภทสมาชิกเป็น 3 คือ แอดมิน ให้นำเข้า เนฟบาร์ลูกค้า
            include'navbarmember.php';
        } else {
            //นอกเหนือจากนี้ให้แสดงข้อความประเภทสมาชิกไม่ถูกต้อง
            echo "ประเภทสมาชิกไม่ถูกต้อง";
        } 
    ?>
    <div class="container py-5">
        <h2 class="text-center mb-4">ประวัติผู้จัดทำ</h2>
        <div class="row justify-content-center">

            <?php
            // ข้อมูลผู้จัดทำ
            $profiles = [
                [
                    'name' => 'นางสาววิภาดา',
                    'surname' => 'คุณชัย',
                    'id' => '25',
                    'nickname' => 'น้ำ',
                    'age' => '20',
                    'birthdate' => '20/11/2547',
                    'student_id' => '66302040025',
                    'major' => 'เทคโนโลยีธุรกิจดิจิทัล',
                    'college' => 'วิทยาลัยอาชีวศึกษาอุตรดิตถ์',
                    'image' => 'pic/wiphada.png'
                ],
                [
                    'name' => 'นางสาวชัญญา',
                    'surname' => 'สุขเกษม',
                    'id' => '03',
                    'nickname' => 'พั้นซ์',
                    'age' => '19',
                    'birthdate' => '15/08/2548',
                    'student_id' => '66302040003',
                    'major' => 'เทคโนโลยีธุรกิจดิจิทัล',
                    'college' => 'วิทยาลัยอาชีวศึกษาอุตรดิตถ์',
                    'image' => 'pic/chanya.jpg'
                ],
                // สามารถเพิ่มข้อมูลโปรไฟล์เพิ่มเติมได้
            ];

            // วนลูปแสดงข้อมูล
            foreach ($profiles as $profile) :
            ?>
                <div class="col-md-6 mb-4">
                    <div class="bg-white text-dark p-4 rounded shadow text-center">
                        <h4>ข้อมูลผู้จัดทำ</h4>
                        <img src="<?= $profile['image'] ?>" alt="Profile Image" class="img-fluid rounded mb-3" style="max-width: 120px;">
                        <p><strong>ชื่อ:</strong> <?= $profile['name'] ?> <strong>สกุล:</strong> <?= $profile['surname'] ?> <strong>เลขที่:</strong> <?= $profile['id'] ?></p>
                        <p><strong>ชื่อเล่น:</strong> <?= $profile['nickname'] ?> <strong>อายุ:</strong> <?= $profile['age'] ?> <strong>เกิด:</strong> <?= $profile['birthdate'] ?></p>
                        <p><strong>รหัสนักศึกษา:</strong> <?= $profile['student_id'] ?></p>
                        <p><strong>สาขาวิชา:</strong> <?= $profile['major'] ?></p>
                        <p><?= $profile['college'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <script src="bootstrap.bundle.min.js"></script>
</body>
</html>
