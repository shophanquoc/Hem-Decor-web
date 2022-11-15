<?php
session_start();
if (isset($_SESSION['id'])) {
	include('../database/dbcon.php');
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Trang Chủ </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include '../header_footer/admin_header.php'; ?>
    <div class="main">
        <?php include '../header_footer/admin_toggle.php'; ?>
        <div class="cardHeader">
            <h2>Tổng quan</h2>
        </div>
        <div class="cardBox">
            <a href="../admin_manage_product/manage_category.php">
                <div class="card">
                    <div>
                        <div class="numbers">
                            <?php
										$product = "SELECT ProductID FROM product";  
										$product_run = mysqli_query($con, $product);
										$product_count = mysqli_num_rows($product_run);
										echo $product_count;
									?>
                        </div>
                        <div class="cardName">Sản phẩm</div>
                    </div>
                    <div class="iconBx">
                        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    </div>
                </div>
            </a>
            <a href="../admin_manage_orders/manage_orders.php?sort=all">
                <div class="card">
                    <div>
                        <div class="numbers">
                            <?php
										$order = "SELECT OrderID FROM `order`";  
										$order_run = mysqli_query($con, $order);
										$order_count = mysqli_num_rows($order_run);
										echo $order_count;
									?>
                        </div>
                        <div class="cardName">Đơn hàng</div>
                    </div>
                    <div class="iconBx">
                        <i class="fa fa-archive" aria-hidden="true"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="cardHeader">
            <h2>Đơn hàng</h2>
        </div>
        <div class="cardBox2">
            <a href="../admin_manage_orders/manage_orders.php?sort=cod">
                <div class="card2">
                    <div>
                        <div class="numbers">
                            <?php
								$unconfirm = "SELECT OrderID FROM `order` where OrderStatus = 'Chờ Xác Nhận'";  
								$unconfirm_run = mysqli_query($con, $unconfirm);
								$unconfirm_count = mysqli_num_rows($unconfirm_run);
								echo $unconfirm_count;
							?>
                        </div>
                        <div class="cardName">Chưa xác nhận</div>
                    </div>
                    <div class="iconBx">
                        <i class="fa fa-square-o" aria-hidden="true"></i>
                    </div>
                </div>
            </a>
            <a href="../admin_manage_orders/manage_orders.php?sort=ready">
                <div class="card2">
                    <div>
                        <div class="numbers">
                            <?php
								$prepare = "SELECT OrderID FROM `order` where OrderStatus = 'Đang Chuẩn Bị Hàng'";  
								$prepare_run = mysqli_query($con, $prepare);
								$prepare_count = mysqli_num_rows($prepare_run);
								echo $prepare_count;
							?>
                        </div>
                        <div class="cardName">Đang chuẩn bị hàng</div>
                    </div>
                    <div class="iconBx">
                        <i class="fa fa-hourglass-half" aria-hidden="true"></i>
                    </div>
                </div>
            </a>
            <a href="../admin_manage_orders/manage_orders.php?sort=ship">
                <div class="card2">
                    <div>
                        <div class="numbers">
                            <?php
								$ship = "SELECT OrderID FROM `order` where OrderStatus = 'Đang Giao Hàng'";  
								$ship_run = mysqli_query($con, $ship);
								$ship_count = mysqli_num_rows($ship_run);
								echo $ship_count;
							?>
                        </div>
                        <div class="cardName">Đang giao hàng</div>
                    </div>
                    <div class="iconBx">
                        <i class="fa fa-truck fa-flip-horizontal" aria-hidden="true"></i>

                    </div>
                </div>
            </a>
            <a href="../admin_manage_orders/manage_orders.php?sort=complete">
                <div class="card2">
                    <div>
                        <div class="numbers">
                            <?php
						$completed = "SELECT OrderID FROM `order` where OrderStatus = 'Đã Hoàn Thành'";  
						$completed_run = mysqli_query($con, $completed);
						$completed_count = mysqli_num_rows($completed_run);
						echo $completed_count;
					?>
                        </div>
                        <div class="cardName">Đã hoàn thành</div>
                    </div>
                    <div class="iconBx">
                        <i class="fa fa-check-square" aria-hidden="true"></i>
                    </div>
                </div>
            </a>
            <a href="../admin_manage_orders/manage_orders.php?sort=cancel">
                <div class="card2">
                    <div>
                        <div class="numbers">
                            <?php
						$completed = "SELECT OrderID FROM `order` where OrderStatus = 'Đã Hủy'";  
						$completed_run = mysqli_query($con, $completed);
						$completed_count = mysqli_num_rows($completed_run);
						echo $completed_count;
					?>
                        </div>
                        <div class="cardName">Đã hủy</div>
                    </div>
                    <div class="iconBx">
                        <i class="fa fa-ban" aria-hidden="true"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
</body>

</html>
<?php 
}else{
     header("Location: ../anon/homepage.php");
     exit();
}
 ?>