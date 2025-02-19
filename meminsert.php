<?php
    include 'conn.php';

    if(!empty($_FILES["fileToUpload"]["tmp_name"])){
        $picname = basename($_FILES["fileToUpload"]["name"]);
        echo $picname;
        $target_dir = "pic/"; //โฟลเดอร์เก็บรูปภาพ
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    } else {
            $picname = "nopic.jpg";
    }

    $tel=$_POST["tel"];
    $pass=$_POST["pass"];
    $maddress=$_POST["maddress"];
    $fullname=$_POST["fullname"];
    $mdate=date("Y-m-d");
    $memtype=2;


    $sql = "INSERT INTO member (pic,tel, pass, maddress, mdate,memtype)
    VALUES ('$picname','$tel','$pass','$maddress','$mdate','$memtype')";
    $re = mysqli_query($conn,$sql);

    header("location:index.php");
?>