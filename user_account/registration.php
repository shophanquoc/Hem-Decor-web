<?php

session_start ();
include('../database/dbcon.php');
//initialise variable
$name = $_POST['user'];
$email = $_POST['email'];
$tel = $_POST['telephone'];
$pass =  $_POST['password'];

$e = "SELECT * FROM `account` where AccEmail = '$email'";
$t = "SELECT * FROM `account` where AccPhoneNo = '$tel'";

//Perform query against a database
$result = mysqli_query($con, $e);
$result1 = mysqli_query($con, $t);
//count number of row that appear
$num = mysqli_num_rows($result);
$num1 = mysqli_num_rows($result1);

//check if the email is duplicate or not
if($num == 1){
    header("Location: signup.php?error=Email đã được sử dụng");
    exit();
} elseif($num1 == 1) { //check if the phone number is duplicate or not
    header("Location: signup.php?error=Số Điện Thoại Đã Được Sử Dụng");
    exit();
} //check invalid phone number
elseif(strlen($tel) > 10 || strlen($tel) < 10 || !preg_match('/^[0-9]+$/', $tel)){
    header("Location: signup.php?error=Số Điện Thoại Không Hợp Lệ");
	exit();
} //check password length 
elseif(strlen($pass) < 6){
    header("Location: signup.php?error=Mật Khẩu Quá Ngắn");
	exit();
} elseif(strlen($pass) > 20){
    header("Location: signup.php?error=Mật Khẩu Quá Dài");
	exit();
} //check email length
elseif(strlen($email) > 50){
    header("Location: signup.php?error=Email Quá Dài");
	exit();
} //check username
elseif(strlen($name) > 30){
    header("Location: signup.php?error=Tên Đăng Ký Quá Dài");
	exit();
} //check invalid username
elseif(!preg_match('/^[a-zA-Z0-9\s]+$/', $name)) {
    header("Location: signup.php?error=Tên Đăng Ký Không Được Chứa Ký Tự Đặc Biệt");
	exit();
}//insert into database
else{
    $reg = "insert into account(AccName, AccPassword, AccPhoneNo, AccEmail) values ('$name', '$pass', '$tel', '$email')";
    mysqli_query($con, $reg);
    $result2 = mysqli_query($con, "SELECT * FROM Account WHERE AccEmail = '$email'");
    $row2 = mysqli_fetch_array($result2);
    $id = $row2['AccountID'];
    $cartID = "cart" . rand(00000, 99999);
    mysqli_query($con, "INSERT INTO Cart VALUES ('$cartID','$id' )");
    echo "<script> window.location.href = 'signup.php?success=Đăng Ký Thành Công';</script>";
    exit();
}
?>