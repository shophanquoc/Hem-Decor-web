<?php 
session_start ();
if (isset($_SESSION['id'])) { 
include('../database/dbcon.php');
include ('../header_footer/user_header.php');
$id = $_SESSION['id'];
$sql = mysqli_query($con, "SELECT * FROM Cart WHERE AccountID = '$id'");
$row = mysqli_fetch_assoc($sql);
$cartID = $row['CartID'];
$check_cart = mysqli_query($con, "SELECT * FROM Product_Cart WHERE CartID = '$cartID'");
$num = mysqli_num_rows($check_cart);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/user.css?v=<?php echo time(); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <div class="main">
        <div class="bar">
            <div class="bname">
                <h2><i class="fas fa-shopping-cart"></i> Giỏ Hàng</h2>
            </div>
            <div class="border_bottom"></div>
        </div>
        <?php if ($num == 0) { ?>
        <div class="my-order_box">
            <div class = "message">
                Giỏ hàng rỗng
            </div>
            <div class="cbar">
                <a href="checkout.php"><button type="button" class="checkout1" disabled>Thanh Toán</button></a>
            </div>
        </div>
        <?php }else{ ?>
        <div class="my-order_box">
            <div class="tbox">
                <table width="100%">
                    <thead>
                        <tr>
                            <th>Sản Phẩm</th>
                            <th width="15%">Đơn Giá</th>
                            <th width="8%">Số Lượng</th>
                            <th width="15%">Thành Tiền</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <?php
                        $sql1 = mysqli_query($con, "SELECT p.CategoryID, ThumbnailImage, p.*, CartID, Quantity FROM Categories c
                        INNER JOIN Product p ON c.CategoryID = p.CategoryID 
                        INNER JOIN Product_Cart pc ON p.ProductID = pc.ProductID
                        WHERE CartID = '$cartID' ORDER BY AddedDate DESC");
                        $i = 1;                
                        while ($row1 = mysqli_fetch_assoc($sql1)){
                            $total = $row1['Price']*$row1['Quantity'];
                            //create img path
                            $img =  "../images/product_images/" . $row1['ThumbnailImage'];
                        ?>
                    <tbody>
                        <tr>
                            <th class="sp">
                                <a href='../user_products/view_product.php?cid=<?php echo $row1['CategoryID']; ?>'>
                                    <div class="columna">
                                        <img src="<?php echo $img ?>">
                                    </div>
                                    <div class="columnb">
                                        <?php echo $row1['ProductName'];
                                    if($row1['Size'] != ''){
                                        ?> Size <?php echo $row1['Size'];
                                        }
                                    ?>
                                    </div>

                                </a>
                            </th>
                            <th><a><?php echo number_format($row1['Price']);?></a></th>
                            <th><a>
                                    <?php echo $row1["Quantity"]?></a>
                            </th>
                            <th><a><?php echo number_format($total);?></a></th>
                            <th><a href="view_cart.php?delete=<?php echo $row1['ProductID']; ?>">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                            </th>
                        </tr>
                    </tbody>
                    <?php $i++;} ?>
                </table>
            </div>
            <div class="cbar">
                <a href="checkout.php"><button type="button" class="checkout">Thanh Toán</button></a>
            </div>
        </div>
        <?php } ?>
    </div>

    </div>
    <?php
        if (isset($_GET['delete'])) {
            $delete = mysqli_query($con, "DELETE FROM Product_Cart WHERE ProductID = '$_GET[delete]' ");
            if ($delete) {
                echo "<script>window.open('view_cart.php', '_self')</script>";
            }
        }
        ?>
</body>

</html>
<?php 
}else{
    echo "<script>window.open('../anon/homepage.php', '_self')</script>";
     exit();
}
 ?>