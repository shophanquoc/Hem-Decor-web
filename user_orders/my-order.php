<?php 
session_start ();
if (isset($_SESSION['id'])) { 
include('../database/dbcon.php');
include ('../header_footer/user_header.php');
?>
<html>
    <head>
        <title>Đơn Của Tôi</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/user.css?v=<?php echo time(); ?>">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <div class = "main">
        <?php if (isset($_GET['success'])) { ?>
            <div class="success1"><?php echo $_GET['success']; ?>
            </div>
            
          <?php } ?>
        <div class="bar">
            <div class="bname">
                <h2>Đơn Của Tôi</h2>
            </div>
            <div class="border_bottom"></div>
        </div>
        <div class = "my-order_box">    
            <table width = "100%">
                <thead>
                    <tr>
                        <th>Mã Đơn</th>
                        <th>Trạng Thái Thanh Toán</th>
                        <th>Trạng Thái Thực Hiện</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <?php
                $id = $_SESSION['id'];
                $all_orders = mysqli_query($con, "SELECT * FROM `Order` WHERE AccountID = '$id' ORDER BY OrderDate DESC");
                $i = 1;                
                while ($row = mysqli_fetch_assoc($all_orders)){
                ?>
                <tbody>
                    <tr>
                        <th><a href = 'order-details.php?oid=<?php echo $row['OrderID']; ?>'> <?php echo $row['OrderID'];?></a></th>
                        <th><a href = 'order-details.php?oid=<?php echo $row['OrderID']; ?>'><?php echo $row['PaymentStatus'];?></a></th>
                        <th><a href = 'order-details.php?oid=<?php echo $row['OrderID']; ?>'><?php echo $row['OrderStatus'];?></a></th>
                        <th><a href = 'order-details.php?oid=<?php echo $row['OrderID']; ?>'><?php echo number_format($row['TotalOrder']);?></a></th>
                    </tr>
                </tbody>
                <?php $i++;} ?>
            </table>
        </div>
        <footer><?php include '../header_footer/user_footer.php'; ?></footer>
        </div>
    </body>
</html>
<?php 
}else{
    echo "<script>window.open('../anon/homepage.php', '_self')</script>";
     exit();
}
 ?>
