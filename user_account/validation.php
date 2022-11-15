<?php

session_start ();
include('../database/dbcon.php');
//initialise variable
$eot = $_POST['eot'];
$pass =  $_POST['password'];

$s = "SELECT * FROM `account` 
where AccEmail = '$eot' && AccPassword = '$pass'";
$s1 = "SELECT * FROM `account` 
WHERE AccPhoneNo = '$eot' && AccPassword = '$pass'";
$a = "SELECT * FROM `admin` 
where AdminLogInName = '$eot' && AdminPassword = '$pass'";

//thực hiện query trong database
$result = mysqli_query($con, $s);
$result1 = mysqli_query($con, $s1);
$result2 = mysqli_query($con, $a);
//đếm số hàng trả về
$num = mysqli_num_rows($result);
$num1 = mysqli_num_rows($result1);
$num2 = mysqli_num_rows($result2);

if($num == 1){
    $row = mysqli_fetch_assoc($result);
    //check nếu email và password trùng khớp
    if ($row['AccEmail'] === $eot && $row['AccPassword'] === $pass) {
        $_SESSION['id'] = $row["AccountID"];
        header('location:../user_homepage/user_homepage.php');
    }else {
        header("Location: login.php?error=Đăng nhập không thành công. Vui lòng kiểm tra tên đăng nhập và mật khẩu.");
        exit();
    }    
} elseif($num1 == 1) {
    $row = mysqli_fetch_assoc($result1);
    //check nếu sđt và password trùng khớp
    if ($row['AccPhoneNo'] === $eot && $row['AccPassword'] === $pass) {
        $_SESSION['id'] = $row["AccountID"];
        header('location:../user_homepage/user_homepage.php');
    }else {
        header("Location: login.php?error=Đăng nhập không thành công. Vui lòng kiểm tra tên đăng nhập và mật khẩu.");
        exit();
    } 
}elseif($num2 == 1) {
    $row = mysqli_fetch_assoc($result2);
    //nếu tên admin và password trùng khớp
    if ($row['AdminLogInName'] === $eot && $row['AdminPassword'] === $pass) {
        $_SESSION['id'] = $row["AdminID"];
        header('location:../admin_account/admin_homepage.php');
    }else {
        header("Location: login.php?error=Đăng nhập không thành công. Vui lòng kiểm tra tên đăng nhập và mật khẩu.");
        exit();
    } 
}else {
    header("Location: login.php?error=Đăng nhập không thành công. Vui lòng kiểm tra tên đăng nhập và mật khẩu.");
	exit();
}
?>