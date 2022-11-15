<?php

session_start ();


include('../database/dbcon.php');

//initialise vảiable
$random_password_length = 6;
$email = $_POST['email'];
$tel = $_POST['telephone'];
$new_pass =  generateRandomString( $random_password_length );

$s = "SELECT * FROM `account` where AccEmail = '$email' && AccPhoneNo = '$tel'";
//thực hiện query trong database
$result = mysqli_query($con, $s);
//đếm số hàng trả về
$num = mysqli_num_rows($result);
//random 1 string ngẫu nhiên bao gồm 3 chữ cái và 3 chữ số làm pass mới
function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

//nếu số hàng trả về là 1 thì gửi pass mới
if($num == 1){
    $new = "update `account` set AccPassword = '$new_pass' where AccEmail = '$email'";
    mysqli_query($con, $new);
    header("Location: forget-password.php?success=Mật Khẩu Mới Của Bạn Là '$new_pass'");
    exit();
}else{ //ko thì báo lỗi
    header("Location: forget-password.php?error=Sai Email hoặc Số Điện Thoại");
    exit(); 
}
?>