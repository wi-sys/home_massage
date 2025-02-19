<?php
    include 'conn.php';

    $tel=$_POST["tel"];
    $pass=$_POST["pass"];

    $sql = "SELECT * FROM member WHERE tel='$tel' AND pass='$pass'";
    $re = mysqli_query($conn,$sql);
    
    if (mysqli_num_rows($re)>0) {
        $row = mysqli_fetch_assoc($re);
        $_SESSION["id"]=$row["memid"];
        $_SESSION['name'] = $row['fullname'];
        if ($row["memtype"]==1) {
            $_SESSION["memtype"]=1;
            header("location:homeadmin.php");
        } else if ($row["memtype"]==2) {
            $_SESSION["memtype"]=2;
            header("location:homeemployee.php");
        } else if ($row["memtype"]==3) {
            $_SESSION["memtype"]=3;
            header("location:orders.php");
        } else {
            echo 'ชนิดของข้อมูลไม่ถูกต้อง';
        }
    } else {
        echo 'ชื่อหรือรหัสผ่านไม่ถูกต้อง';
    }

?>