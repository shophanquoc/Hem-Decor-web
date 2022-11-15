<?php
session_start();
if (isset($_SESSION['id'])) {
include('../database/dbcon.php');
include '../header_footer/admin_header.php';
$oid = $_GET['oid'];
$sql = mysqli_query(
    $con,
    "SELECT AccountID, OrderDate, OrderStatus, PaymentStatus, TotalOrder, od.*, OrderQuantity, QuantityPrice, p.*, c.ThumbnailImage, sum(OrderQuantity) AS TotalQuantity, sum(QuantityPrice) AS TotalQuPrice, count(p.ProductID) AS TotalProduct FROM `Order` o 
    INNER JOIN `order_details` od ON o.OrderID = od.OrderID
    INNER JOIN `order_product` op ON o.OrderID = op.OrderID 
    INNER JOIN `product` p ON op.ProductID = p.ProductID 
    INNER JOIN `categories` c ON p.CategoryID = c.CategoryID
    WHERE o.OrderID = '$oid'");
$row = mysqli_fetch_array($sql);
?>
<!doctype html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prettify/r298/run_prettify.js"></script>
    <link rel="stylesheet" href="admin.css">
    <title>Chi Tiết Đơn Hàng</title>
</head>

<body>
    <div class=main><?php include '../header_footer/admin_toggle.php'; ?>
        <section class="confirmation_part padding_top">
            <div class="container">
                <h1>Chi Tiết Đơn Hàng #<?php echo $row["OrderID"] ?></h1>
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
                <div class="row">
                    <div class="col-lg-8">
                        <div class="order_details_iner">
                            <table class="table table-customer">
                                <colgroup>
                                    <col span="1" style="width: 5%;">
                                    <col span="1" style="width: 20%;">
                                    <col span="1" style="width: 25%;">
                                    <col span="1" style="width: 5%;">
                                    <col span="1" style="width: 15%;">
                                    <col span="1" style="width: 30%;">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th scope="col" colspan="6"><i class='fa fa-user'></i> Khách Hàng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><i class='fa fa-user'></i> </td>
                                        <td>Họ tên: </td>
                                        <td><?php echo $row["CustomerName"] ?></td>
                                        <td><i class="fa fa-map-marker"></i> </td>
                                        <td>Địa chỉ: </td>
                                        <td><?php echo $row["CustomerAddress"] ?></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-phone"></i></td>
                                        <td>SĐT:</td>
                                        <td><?php echo $row["CustomerPhoneNo"] ?></td>
                                        <td rowspan = "2"><i class='fa fa-file'></i></td>
                                        <td rowspan = "2">Note: </td>
                                        <td rowspan = "2"><?php echo $row["Note"] ?></td>
                                    </tr>
                                    <tr>
                                        <td><i class='fa fa-calendar'></i></td>
                                        <td>Ngày đặt hàng:</td>
                                        <td><?php echo date('d/m/Y', strtotime($row["OrderDate"])) ?></td>
                                    </tr>
                                </tbody>
                                
                            </table>

                            <table class="table table-product">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th colspan="2">Sản phẩm</th>
                                        <th width = "15%">Số lượng</th>
                                        <th>Giá</th>
                                        <th>Tổng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    $sql1 = mysqli_query(
                                        $con,
                                        "SELECT c.CategoryID, ProductName, Size, OrderQuantity, QuantityPrice, Price FROM  `order_product` op
                                        INNER JOIN `product` p ON op.ProductID = p.ProductID 
                                        INNER JOIN `categories` c ON p.CategoryID = c.CategoryID
                                        WHERE OrderID = '$oid'"); 
                                    while ($row1 = mysqli_fetch_array($sql1)) {?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td colspan="2"><a
                                                href="../admin_manage_product/product-detail.php?cid=<?php echo $row1['CategoryID'] ?>"><?php echo $row1["ProductName"] ?>
                                                Size <?php echo $row1["Size"] ?></a></td>
                                        <td><?php echo $row1["OrderQuantity"] ?></td>
                                        <td><?php echo number_format($row1["Price"]) ?></td>
                                        <td><?php echo number_format($row1["QuantityPrice"]) ?></td>
                                    </tr>
                                    <?php $i++;
                                    } ?>
                                    <tr>
                                        <td></td>
                                        <td colspan="2" style = "text-align: center;"><span><b>Tổng</b></td>
                                        <td><?php echo $row["TotalQuantity"] ?></td>
                                        <td></td>
                                        <td><?php echo number_format($row["TotalQuPrice"]) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4 col-lx-4">
                        <div class="order_details_iner">
                            <table class="table table-pay">
                                <thead>
                                    <tr >
                                        <th scope="col" colspan = "2"><i class='fa fa-money'></i> Thanh Toán</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><i>Tổng tiền sản phẩm: </i> 
                                        <td><?php echo number_format($row["TotalQuPrice"]) ?>
                                    </tr>
                                    <tr>
                                        <td><i>Phí ship: </i> 
                                        <td>30,000
                                    </tr>
                                    <tr>
                                        <td><i>Tổng đơn: </i> 
                                        <td><?php echo number_format($row["TotalOrder"]) ?>
                                    </tr>
                                    <tr>    
                                        <td><i>Phương thức thanh toán:</i> 
                                        <td><?php echo $row["PaymentMethod"] ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</body>

</html>
<?php 
}else{
     header("Location: ../anon/homepage.php");
     exit();
}
 ?>