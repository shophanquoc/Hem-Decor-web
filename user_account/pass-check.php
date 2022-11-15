<?php
session_start ();
if (isset($_SESSION['id'])) { 
    include('../database/dbcon.php');
    //initialise variable
    $id = $_SESSION['id'];
    $old_pass = $_POST['old_pass'];
    $new_pass =  $_POST['new_pass'];
    $new_pass1 =  $_POST['new_pass1'];


    $s = "SELECT * FROM `account` WHERE AccountID = '$id' && AccPassword = '$old_pass'";
    //thực hiện query trong database
    $result = mysqli_query($con, $s);
    //đếm số hàng trả về
    $num = mysqli_num_rows($result);

    ////check các điều kiện thỏa mãn để đổi pass 
    if($num ==1 && strlen($new_pass) >= 6 && strlen($new_pass) <= 20 && $new_pass != $old_pass && $new_pass1 == $new_pass){
        $_SESSION['mort'] = $old_pass;
        $new = "update `account` set AccPassword = '$new_pass' where AccountID = '$id' && AccPassword = '$old_pass'";
        mysqli_query($con, $new);
        header("Location: success-change.php");
        exit();  
    } //các điều kiện ko hợp lệ, báo lỗi nếu ko hợp lệ
    elseif($num == 0){
        //nếu mk cũ ko đúng
        header("Location: change-password.php?error=Sai Mật Khẩu");
        exit();
    } elseif($new_pass == $old_pass){
        //nếu mk mới giống mk cũ
        header("Location: change-password.php?error=Mật Khẩu Mới Phải Khác Mật Khẩu Cũ");
        exit();
    } elseif(strlen($new_pass) < 6){
        //nếu mk mới bé hơn 6
        header("Location: change-password.php?error=Mật Khẩu Quá Ngắn");
        exit();
    }elseif(strlen($new_pass) > 20){
        //nếu mk mới lớn hơn 20
        header("Location: change-password.php?error=Mật Khẩu Quá Dài");
        exit();
    }elseif($new_pass1 != $new_pass){
        //nếu mk đc nhập lại ko giống mk mới
        header("Location: change-password.php?error=Mật Khẩu Không Khớp");
        exit();
    }else{
        header("Location: change-password.php?error=Lỗi");
        exit();  
    }
}else{
    header("Location: ../anon/homepage.php");
    exit();
}
?>