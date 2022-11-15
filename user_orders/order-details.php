<?php
session_start();
if (isset($_SESSION['id'])) { 
    include('../database/dbcon.php');
    //get the catgory id base on the clicked product
    if (isset($_GET['oid'])) { 
        $id = $_SESSION['id'];
        $oid = $_GET['oid'];
        $order_content = mysqli_query($con, "SELECT AccountID, OrderDate, OrderStatus, PaymentStatus, TotalOrder, od.*, OrderQuantity, QuantityPrice, p.*, c.ThumbnailImage, sum(OrderQuantity) AS TotalQuantity, sum(QuantityPrice) AS TotalQuPrice, count(p.ProductID) AS TotalProduct FROM `Order` o 
        INNER JOIN `order_details` od ON o.OrderID = od.OrderID
        INNER JOIN `order_product` op ON o.OrderID = op.OrderID 
        INNER JOIN `product` p ON op.ProductID = p.ProductID 
        INNER JOIN `categories` c ON p.CategoryID = c.CategoryID
        WHERE AccountID = '$id' && o.OrderID = '$oid'");
        $row = mysqli_fetch_array($order_content);

?>
<!doctype html>
<html lang="zxx">

<head>
    <title>Chi tiết đơn hàng</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://kit.fontawesome.com/ccd3f2c1ca.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prettify/r298/run_prettify.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/user.css?v=<?php echo time(); ?>">
</head>

<body>
    <header>
        <a href="../user_homepage/user_homepage.php"><img class="logo" src="../images/hem_logo_circle_yellow.png"
                alt="logo"></a>
        <a href="../user_homepage/user_homepage.php" class="web_name1" style="font-size:3vw;">Hẻm Decor</a>

        <form action="../user_products/search.php" class="search-form" id="search" method="post">
            <input type="search" name="keyword" placeholder="Tìm Kiếm" id="search-box" required>
            <label for="search-box" class="fas fa-search" onclick="myFunc()"></label>
        </form>

        <script>
        function myFunc() {
            document.getElementById("search").submit();
        }
        </script>
        <input type="checkbox" name="" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>


        <nav class="navbar1">
            <ul>
                <li> <a href="../user_homepage/user_homepage.php">Trang Chủ</a></li>
                <li> <a href="../user_products/product_page.php">Cửa Hàng</a></li>
                <li> <a href="../user_homepage/about_us.php">Giới Thiệu</a></li>
                <li><a class="cta" href="#contact">Liên hệ</a></li>
            </ul>
        </nav>


        <div class="icons1">
            <a href="../user_cart/view_cart.php" class="fas fa-shopping-cart">
            </a>
            <div class="dropdown"><a class="fas fa-user"></a>
                <div class="dropdown-content">
                    <a href="../user_orders/my-order.php">Đơn Của Tôi</a>
                    <a href="../user_account/change-password.php">Đổi Mật Khẩu</a>
                    <a href="../user_account/logout.php">Đăng Xuất</a>
                </div>
            </div>
        </div>

    </header>
    <section class="confirmation_part padding_top">
        <h1>Đơn Hàng #<?php echo $row["OrderID"] ?></h1>
        <?php if($row["OrderStatus"] == "Chờ Xác Nhận"){ ?>
        <h3 class="wait"><?php echo $row["OrderStatus"] ?></h3>
        <?php } elseif($row["OrderStatus"] == "Đang Chuẩn Bị Hàng"){ ?>
        <h3 class="ready"><?php echo $row["OrderStatus"] ?></h3>
        <?php } elseif($row["OrderStatus"] == "Đang Giao Hàng"){ ?>
        <h3 class="ship"><?php echo $row["OrderStatus"] ?></h3>
        <?php } elseif($row["OrderStatus"] == "Đã Hoàn Thành") { ?>
        <h3 class="complete"><?php echo $row["OrderStatus"] ?></h3>
        <?php } elseif($row["OrderStatus"] == "Đã Hủy") { ?>
        <h3 class="cancel"><?php echo $row["OrderStatus"] ?></h3>
        <?php }?>
        <div class="container">
            <div class="row">

                <div class="col-lg-7">
                    <div class="order_details_iner">
                        <h2>Thời gian đặt hàng: <?php echo $row["OrderDate"] ?></h2>
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col" colspan="2"><span>Sản phẩm</span></th>
                                    <th scope="col"><span>Giá</span></th>
                                    <th scope="col" width = "15%"><span>Số lượng</span></th>
                                    <th scope="col"><span>Tổng</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                        $sql1 = mysqli_query($con, "SELECT OrderID, OrderQuantity, QuantityPrice, 
                                                    p.* FROM order_product op INNER JOIN product p ON op.ProductID = p.ProductID
                                                    WHERE OrderID = '$oid'");
                        while ($row1 = mysqli_fetch_assoc($sql1)){ ?>
                                <tr>
                                    <td colspan="2">
                                        <span><a
                                                href='../user_products/view_product.php?cid=<?php echo $row1['CategoryID']; ?>&pid=<?php echo $row1['ProductID']; ?>'>
                                                <?php echo $row1["ProductName"] ?>
                                            </a></span>
                                    </td>
                                    <td><span style = "cursor: auto;"><?php echo number_format($row1["Price"]) ?></span></td>
                                    <td><span style = "cursor: auto;"><?php echo $row1["OrderQuantity"] ?></span></td>
                                    <td> <span style = "cursor: auto;"><?php echo number_format($row1["QuantityPrice"]) ?></span></td>
                                </tr>
                                <?php $i++;} ?>

                            </tbody>

                            <tr>
                                <td colspan="4"><span style = "cursor: auto;">Tổng tiền hàng: <br>Phí Vận Chuyển (Mặc định):</span> <br><b>Tổng
                                        Đơn</b></td>
                                <td> <span style = "cursor: auto;"> <?php echo number_format($row["TotalQuPrice"]) ?> <br>30,000
                                    <br><b><?php echo number_format($row["TotalOrder"]) ?></b></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-lg-5 col-lx-4">
                    <div class="single_confirmation_details">
                        <h4>Thông tin người nhận</h4>
                        <p><b>Tên: </b><span><?php echo $row["CustomerName"] ?></span></p>
                        <p><b>Số Điện Thoại: </b><span><?php echo $row["CustomerPhoneNo"] ?></span></p>
                        <p><b>Địa Chỉ: </b><span><?php echo $row["CustomerAddress"] ?></span></p>
                        <p><b>Hình thức thanh toán: </b><span><?php echo $row["PaymentMethod"] ?></span></p>
                        <?php if($row["OrderStatus"] == "Chờ Xác Nhận"){ ?>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#demo-1"><i
                                class='fa fa-trash-alt'></i> Hủy Đơn Hàng</button>
                        <?php } else {?>
                        <button type="button" class="btn btn-secondary" disabled><i class='fa fa-trash-alt'></i> Hủy Đơn
                            Hàng</button>
                        <?php }?>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="demo-2" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal"><i class="icon-xs-o-md"></i></button>
                        <div class="modal-header">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <div class="modal-body">
                            <h4 class="modal-title caps">Hủy Đơn Hàng Thành Công</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="demo-1" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal"><i class="icon-xs-o-md"></i></button>
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4 class="modal-title caps">Bạn có chắc muốn hủy đơn hàng?</h4>
                            <h5>Chú ý: Nếu đơn hàng của bạn sử dụng phương thức thanh toán Banking, 
                                vui lòng nhắn tin cho fanpage <a href = "https://www.facebook.com/xuonggo.hemdecor">HemDecor</a>
                                theo cú pháp: Mã Đơn, Họ và Tên, SĐT, STK cùng chi nhánh ngân hàng để 
                                được xác nhận và hoàn trả tiền sản phẩm.</h5>
                        </div>
                        <div class="modal-footer">
                            <a href="order-details.php?oid=<?php echo $row["OrderID"] ?>&cancel=<?php echo $row["OrderID"] ?>">
                                <!-- data-toggle="modal" data-target="#demo-2"
                                    data-dismiss="modal" -->
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#demo-2">Hủy Đơn Hàng</button>
                            </a>
                            <button type="button" class="btn btn-info" data-dismiss="modal">Quay lại</button>
                            <?php 
                            if (isset($_GET['cancel'])){
                                $cancel = mysqli_query($con, "UPDATE `Order` SET OrderStatus = 'Đã Hủy' WHERE OrderID = '$_GET[cancel]'");
                                if ($cancel) {
                                    // show demo-2 in 3s


                                                        
                                    echo "<script>$('#demo-2').modal('show');</script>";
                                    // echo "<script>window.open('order-details.php?oid=$_GET[cancel]', '_self')</script>";
                                    echo "<script>setTimeout(function(){window.open('order-details.php?oid=$_GET[cancel]', '_self')}, 2000);</script>";
                                    //after 3s redirect to order-details.php

                                }

                            }
                            
                             ?>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <footer><?php include '../header_footer/user_footer.php'; ?></footer>
</body>

</html>
<?php
    }
}else{
    echo "<script>window.open('../anon/homepage.php', '_self')</script>";
    exit();
}
?>