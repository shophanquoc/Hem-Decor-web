<?php
session_start ();
include('../database/dbcon.php');
//initialise variable
$id = $_SESSION['id'];
$cid = $_GET['cid'];
$pid = $_POST['pid'];
if($pid == ""){
    echo "<script>
    window.open('view_product.php?cid=$cid&error=Vui lòng chọn Size', '_self')
    </script>";
}
$sql = mysqli_query($con, "SELECT * FROM Cart WHERE AccountID = '$id'");
$row = mysqli_fetch_assoc($sql);
$cartID = $row['CartID'];
$quantity = $_POST['quantity'];
$sql1 = mysqli_query($con, "SELECT * FROM Product WHERE ProductID = '$pid'");
$row1 = mysqli_fetch_assoc($sql1);
$stock = $row1['ProductQuantity'];

$sql2 = mysqli_query($con, "SELECT * FROM Product_Cart WHERE CartID = '$cartID' AND ProductID = '$pid'");
$row2 = mysqli_fetch_assoc($sql2);
$num = mysqli_num_rows($sql2);

$sql3 = mysqli_query($con, "SELECT * FROM Categories WHERE CategoryID = '$cid'");
$row3 = mysqli_fetch_assoc($sql3);

if ($quantity>$stock) {
    echo "<script>
    window.open('view_product.php?cid=$cid&error=Vượt quá số lượng có sẵn của sản phẩm', '_self')
    </script>";
}elseif ($quantity==0) {
    echo "<script>
    window.open('view_product.php?cid=$cid&error=Số lượng sản phẩm không hợp lệ', '_self')
    </script>";
} elseif($num == 1){
    $cart_quantity = $row2['Quantity'];
    $total_quantity = $cart_quantity + $quantity;
    $allow = $stock - $cart_quantity;
    if($cart_quantity == $stock) {
        echo "<script>
        window.open('view_product.php?cid=$cid&error=Vượt quá số lượng có sẵn của sản phẩm', '_self')
        </script>";
    }elseif($total_quantity>$stock){
        echo "<script>
        window.open('view_product.php?cid=$cid&error=Bạn đã có $cart_quantity sản phẩm trong giỏ hàng, bạn chỉ có thể thêm $allow sản phẩm', '_self')
        </script>";
    }
    elseif ($total_quantity<=$stock) {
        mysqli_query($con, "UPDATE Product_Cart SET Quantity = (Quantity+'$quantity') WHERE CartID = '$cartID' AND ProductID = '$pid'");
        echo "<script>window.open('view_product.php?cid=$cid&success=Đã Thêm Vào Giỏ Hàng', '_self')</script>";
    }
}elseif($num == 0){
    mysqli_query($con, "INSERT INTO Product_Cart(`ProductID`,`CartID`,`Quantity`)  VALUES('$pid', '$cartID', '$quantity')");
    echo "<script>window.open('view_product.php?cid=$cid&success=Đã Thêm Vào Giỏ Hàng', '_self')</script>";
}
?>
