<?php

session_start ();
include('../database/dbcon.php');
//initialise variable
$cartID = $_COOKIE["cart"];
$cid = $_GET['cid'];
$pid = $_GET['pid'];
if($pid == 0){
    echo "<script>
    window.open('view_product.php?cid=$cid&error=Vui lòng chọn Size', '_self')
    </script>";
}
$quantity = $_POST['quantity'];
$sql1 = mysqli_query($con, "SELECT * FROM Product WHERE ProductID = '$pid'");
$row1 = mysqli_fetch_assoc($sql1);
$stock = $row1['ProductQuantity'];

$sql2 = mysqli_query($con, "SELECT * FROM Anon_Cart WHERE ProductID = '$pid'");
$num = mysqli_num_rows($sql2);
if ($quantity>$stock) {
    echo "<script>
    window.open('view_product.php?cid=$cid&pid=$pid&error=Vượt quá số lượng có sẵn của sản phẩm', '_self')
    </script>";
}elseif ($quantity==0) {
    echo "<script>
    window.open('view_product.php?cid=$cid&pid=$pid&error=Số lượng sản phẩm không hợp lệ', '_self')
    </script>";
} elseif($num == 1){
    mysqli_query($con, "UPDATE Anon_Cart SET Quantity = (Quantity+'$quantity') WHERE ProductID = '$pid'");
    echo "<script>window.open('view_product.php?cid=$cid&pid=$pid&success=Đã Thêm Vào Giỏ Hàng', '_self')</script>";
}
else{
    mysqli_query($con, "INSERT INTO Anon_Cart(`ProductID`,`CartID`,`Quantity`)  VALUES('$pid', '$cartID', '$quantity')");
    echo "<script>window.open('view_product.php?cid=$cid&pid=$pid&success=Đã Thêm Vào Giỏ Hàng', '_self')</script>";
}
?>
