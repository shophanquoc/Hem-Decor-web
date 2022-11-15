<?php
session_start ();
if (isset($_SESSION['id'])) {
include('../database/dbcon.php');
include '../header_footer/admin_header.php';

?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Đơn Hàng </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <div class=main><?php include '../header_footer/admin_toggle.php'; ?>
        <div class="product_box">
            <div class="cardHeader">
                <h2>Đơn Hàng</h2>
            </div>
            <div class="border_bottom"></div>
            <?php $_SESSION['sort'] = $_GET['sort']; 
            if(!isset($_GET['search'])){?>
            <form action="search.php?sort=" class="search-form" method="post">
                <input type="search" name="keyword" placeholder="Tìm Kiếm" id="search-box" required>
                <button type="submit" class="fa fa-search"></button>
            </form>
            <?php } ?>
            <?php if(isset($_GET['search'])){?>
            <form action="search.php?sort=" class="search-form" method="post">
                <input type="search" name="keyword" placeholder="Tìm Kiếm" value="<?php echo "$_GET[search]"?>"
                    id="search-box" required>
                <button type="submit" class="fa fa-search"></button>
            </form>
            <?php } ?>

            <!-- delete and show product -->

            <form action="" method="get">
                <div class="row">
                    <div class="col1">
                        <div class="sort-box">
                            <select name="sort" id="sort" class="form-control" onchange="this.form.submit();">
                                <option value="all"
                                    <?php if(isset($_GET['sort']) && $_GET['sort'] == "all"){echo "selected";}?>>Tất cả
                                </option>
                                <option value="cod"
                                    <?php if(isset($_GET['sort']) && $_GET['sort'] == "cod"){echo "selected";}?>>Chờ
                                    xác
                                    nhận - COD
                                </option>
                                <option value="bank"
                                    <?php if(isset($_GET['sort']) && $_GET['sort'] == "bank"){echo "selected";}?>>Chờ
                                    xác
                                    nhận - Banking
                                </option>
                                <option value="ready"
                                    <?php if(isset($_GET['sort']) && $_GET['sort'] == "ready"){echo "selected";}?>>Đang
                                    chuẩn bị
                                    hàng</option>
                                <option value="ship"
                                    <?php if(isset($_GET['sort']) && $_GET['sort'] == "ship"){echo "selected";}?>>
                                    Đang giao hàng</option>
                                <option value="complete"
                                    <?php if(isset($_GET['sort']) && $_GET['sort'] == "complete"){echo "selected";}?>>Đã
                                    hoàn
                                    thành
                                </option>
                                <option value="cancel"
                                    <?php if(isset($_GET['sort']) && $_GET['sort'] == "cancel"){echo "selected";}?>>Đã
                                    hủy
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <?php
                if(isset($_GET['sort'])){
                    if($_GET['sort'] == "cod" || $_GET['sort'] == "bank" || $_GET['sort'] == "ready" || $_GET['sort'] == "ship"){ ?>
            <form action="" method="post" enctype="multipart/form-data">
                <button type="submit" class="button button6"><i class="fa fa-exchange"> Chuyển trạng
                        thái</i></button>
                <?php } elseif($_GET['sort'] == "complete" || $_GET['sort'] == "cancel" || $_GET['sort'] == "all") {?>
                <form action="" method="post" enctype="multipart/form-data">
                    <button type="button" class="button button7"><i class="fa fa-exchange"> Chuyển trạng
                            thái</i></button>
                    <?php } 
                } else {
              ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <button type="button" class="button button7"><i class="fa fa-exchange"> Chuyển trạng
                                thái</i></button>
                        <?php } ?>
                        <?php
                //initialise variable
                $sort = "";
                $search = "";  
                //check điều kiện để sort
                if(isset($_GET['sort']) && !isset($_GET['search'])){
                    if($_GET['sort'] == "all"){ 
                      $sort = "";
                      $search = "";
                    } elseif($_GET['sort'] == "cod"){ 
                        $sort = "WHERE OrderStatus = 'Chờ Xác Nhận' AND PaymentMethod = 'COD'";
                        $search = "";
                    }elseif($_GET['sort'] == "bank"){ 
                        $sort = "WHERE OrderStatus = 'Chờ Xác Nhận' AND PaymentMethod = 'Banking'";
                        $search = "";
                    }elseif($_GET['sort'] == "ready"){ 
                        $sort = "WHERE OrderStatus = 'Đang Chuẩn Bị Hàng'";
                        $search = "";
                    }elseif($_GET['sort'] == "ship"){ 
                      $sort = "WHERE OrderStatus = 'Đang Giao Hàng'";
                      $search = "";
                    }elseif($_GET['sort'] == "complete"){ 
                      $sort = "WHERE OrderStatus = 'Đã Hoàn Thành'";
                      $search = "";
                    }elseif($_GET['sort'] == "cancel"){ 
                        $sort = "WHERE OrderStatus = 'Đã Hủy'";
                        $search = "";
                      }
                } //check điều kiện để search
                elseif(isset($_GET['sort']) && isset($_GET['search'])){
                    if($_GET['sort'] == "all" && $_GET['search'] != '' ){ 
                        $sort = "";
                        $search = "WHERE o.OrderID LIKE '%$_GET[search]%' OR CustomerName LIKE '%$_GET[search]%'";
                    } elseif($_GET['sort'] == "cod" && $_GET['search'] != ''){ 
                        $sort = "WHERE OrderStatus = 'Chờ Xác Nhận' AND PaymentMethod = 'COD'";
                        $search = "AND (o.OrderID LIKE '%$_GET[search]%' OR CustomerName LIKE '%$_GET[search]%')";
                    }elseif($_GET['sort'] == "bank" && $_GET['search'] != ''){ 
                        $sort = "WHERE OrderStatus = 'Chờ Xác Nhận' AND PaymentMethod = 'Banking'";
                        $search = "AND (o.OrderID LIKE '%$_GET[search]%' OR CustomerName LIKE '%$_GET[search]%')";
                    }elseif($_GET['sort'] == "ready" && $_GET['search'] != ''){ 
                        $sort = "WHERE OrderStatus = 'Đang Chuẩn Bị Hàng'";
                        $search = "AND (o.OrderID LIKE '%$_GET[search]%' OR CustomerName LIKE '%$_GET[search]%')";
                    }elseif($_GET['sort'] == "ship" && $_GET['search'] != ''){ 
                        $sort = "WHERE OrderStatus = 'Đang Giao Hàng'";
                        $search = "AND (o.OrderID LIKE '%$_GET[search]%' OR CustomerName LIKE '%$_GET[search]%')";
                    }elseif($_GET['sort'] == "complete" && $_GET['search'] != ''){ 
                        $sort = "WHERE OrderStatus = 'Đã Hoàn Thành'";
                        $search = "AND (o.OrderID LIKE '%$_GET[search]%' OR CustomerName LIKE '%$_GET[search]%')";
                    }elseif($_GET['sort'] == "cancel" && $_GET['search'] != ''){ 
                          $sort = "WHERE OrderStatus = 'Đã Hủy'";
                          $search = "AND (o.OrderID LIKE '%$_GET[search]%' OR CustomerName LIKE '%$_GET[search]%')";
                    }
                }
              ?>
                        <?php 
              try {
                $pdo = new PDO(
                    "mysql:host=$sname;dbname=$db_name",
                    $uname,
                    $password,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
                );
            } catch (Exception $ex) {
                exit($ex->getMessage());
            }

            // (B) TOTAL NUMBER OF PAGES
            define("PER_PAGE", "5"); // ENTRIES PER PAGE
            $stmt = $pdo->prepare("SELECT CEILING(COUNT(*) / " . PER_PAGE . ") `pages` FROM `categories`");
            $stmt->execute();
            $pageTotal = $stmt->fetchColumn();

            // (C) GET ENTRIES FOR CURRENT PAGE
            // (C1) LIMIT (X, Y) FOR SQL QUERY
            $pageNow = isset($_GET["page"]) ? $_GET["page"] : 1;
            $limX = ($pageNow - 1) * PER_PAGE;
            $limY = PER_PAGE;
            $all_order = mysqli_query(
                $con,
                "SELECT AccountID, OrderDate, OrderStatus, PaymentStatus, TotalOrder, od.*, OrderQuantity, p.*, c.ThumbnailImage FROM `Order` o 
                INNER JOIN `order_details` od ON o.OrderID = od.OrderID
                INNER JOIN `order_product` op ON o.OrderID = op.OrderID 
                INNER JOIN `product` p ON op.ProductID = p.ProductID 
                INNER JOIN `categories` c ON p.CategoryID = c.CategoryID $sort $search
                GROUP BY o.OrderID ORDER BY o.OrderDate DESC
                LIMIT $limX, $limY"
            ); 
            $num = mysqli_num_rows($all_order);
            if($num == 0){?>
                        <div class="message">Không Có Kết Quả Trùng Khớp</div>
                        <?php } else{?>

                        <table width=100% class="orders">
                            <thead>
                                <tr>
                                    <th style="width:5%;">
                                        <?php if(isset($_GET['sort'])){
                                if($_GET['sort'] == "cod" || $_GET['sort'] == "bank" || $_GET['sort'] == "ready" || $_GET['sort'] == "ship"){ ?>
                                        <input type="checkbox" id="checkAll" value="" />
                                        <?php }elseif($_GET['sort'] == "complete" || $_GET['sort'] == "cancel" || $_GET['sort'] == "all"){?>
                                        <input type="checkbox" id="checkAll" value="" disabled />
                                        <?php }
                            } else{?>
                                        <input type="checkbox" id="checkAll" value="" disabled />
                                        <?php }
                            ?>
                                    </th>
                                    <!-- check all the checkbox -->
                                    <script>
                                    $('#checkAll').click(function(event) {
                                        if (this.checked) {
                                            // Iterate each checkbox
                                            $(':checkbox').each(function() {
                                                this.checked = true;
                                            });
                                        } else {
                                            $(':checkbox').each(function() {
                                                this.checked = false;
                                            });
                                        }
                                    });
                                    </script>

                                    <th style="font-weight: 550;">Mã đơn hàng</th>
                                    <th style="font-weight: 550;">Chi tiết</th>
                                    <th style="font-weight: 550; width:10%;">Phương thức thanh toán</th>
                                    <th style="font-weight: 550;">Trạng thái</th>
                                    <th style="font-weight: 550;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                          
                          $i = 1;
                          while ($row = mysqli_fetch_array($all_order)) {

                          ?>
                                <tr>
                                    <td>
                                        <?php if(isset($_GET['sort'])){
                                if($_GET['sort'] == "cod" || $_GET['sort'] == "bank" || $_GET['sort'] == "ready" || $_GET['sort'] == "ship"){ ?>
                                        <input type="checkbox" name="choose_all[]"
                                            value="<?php echo $row['OrderID']; ?>" />
                                        <?php }elseif($_GET['sort'] == "complete" || $_GET['sort'] == "cancel" || $_GET['sort'] == "all"){?>
                                        <input type="checkbox" name="choose_all[]"
                                            value="<?php echo $row['OrderID']; ?>" disabled />
                                        <?php }
                            } else{?>
                                        <input type="checkbox" name="choose_all[]"
                                            value="<?php echo $row['OrderID']; ?>" disabled />
                                        <?php }
                            ?>
                                    </td>
                                    <td><?php echo $row['OrderID']; ?></td>
                                    <td class="sp">
                                        <a>
                                            <div class="columna">
                                                <?php 
                                    //create img path
                                    $thumbnail =  "../images/product_images/".$row['ThumbnailImage'];
                                    ?>
                                                <img src="<?php echo $thumbnail ?>" width="100">
                                            </div>
                                            <div class="columnb">
                                                Tên: <?php echo $row['CustomerName']; ?> <br>
                                                Sản phẩm: <?php echo $row['ProductName']; ?>
                                                <?php if($row['Size'] != ''){?>
                                                Size <?php echo $row['Size']; 
                                      } ?>
                                                <br>Số Lượng: <?php echo $row['OrderQuantity']; ?>
                                                <br>Tổng: <?php echo number_format($row['TotalOrder']); ?>đ
                                            </div>
                                        </a> <br>

                                    </td>
                                    <td><?php echo $row['PaymentMethod']; ?></td>
                                    <td><?php echo $row['OrderStatus']; ?></td>
                                    <td>
                                        <a href="view_order.php?oid=<?php echo $row['OrderID'] ?>"><button type="button"
                                                class="fa fa-list" style="cursor: pointer;"></button></a>
                                        <?php if(isset($_GET['sort'])){
                                if($_GET['sort'] == "all"){ ?>
                                        <button type="button" class="fa fa-exchange" disabled>
                                            <?php }elseif($_GET['sort'] == "cod"){ ?>
                                            <a href="manage_orders.php?sort=cod&change=<?php echo $row['OrderID']; ?>"><button
                                                    type="button" class="fa fa-exchange"
                                                    style="cursor: pointer;"></button></a>
                                            <a href="manage_orders.php?sort=cod&cancel=<?php echo $row['OrderID']; ?>"><button
                                                    type="button" class="fa fa-ban" style="cursor: pointer;"
                                                    onclick='return checkCancel()'></button></a>
                                            <?php }elseif($_GET['sort'] == "bank"){ ?>
                                            <a href="manage_orders.php?sort=bank&change=<?php echo $row['OrderID']; ?>"><button
                                                    type="button" class="fa fa-exchange"
                                                    style="cursor: pointer;"></button></a>
                                            <a href="manage_orders.php?sort=bank&cancel=<?php echo $row['OrderID']; ?>"><button
                                                    type="button" class="fa fa-ban" style="cursor: pointer;"
                                                    onclick='return checkCancel()'></button></a>
                                            <?php }elseif($_GET['sort'] == "ready"){ ?>
                                            <a
                                                href="manage_orders.php?sort=ready&change=<?php echo $row['OrderID']; ?>"><button
                                                    type="button" class="fa fa-exchange"
                                                    style="cursor: pointer;"></button></a>
                                            <?php }elseif($_GET['sort'] == "ship"){ ?>
                                            <a href="manage_orders.php?sort=ship&change=<?php echo $row['OrderID']; ?>"><button
                                                    type="button" class="fa fa-exchange"
                                                    style="cursor: pointer;"></button></a>
                                            <?php }elseif($_GET['sort'] == "complete"){ ?>
                                            <button type="button" class="fa fa-exchange" disabled>
                                                <?php }elseif($_GET['sort'] == "cancel"){ ?>
                                                <button type="button" class="fa fa-exchange" disabled>
                                                    <?php }
                            } else { ?>
                                                    <button type="button" class="fa fa-exchange" disabled>
                                                        <?php } ?>

                                                        </a>
                                                        </th>

                                </tr>
                                <?php $i++;
                    } ?>
                            </tbody>
                        </table>
                        <!-- confirm delete function -->
                        <script>
                        function checkCancel() {
                            return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');
                        }
                        </script>
                        <?php
        // update order status by icon 
        if (isset($_GET['change'])){
        if ($_GET['sort'] == "cod") {
            $ready1 = mysqli_query($con, "UPDATE `Order` SET OrderStatus = 'Đang Chuẩn Bị Hàng' WHERE OrderID = '$_GET[change]'");
            if ($ready1) {
                echo "<script>window.open('manage_orders.php?sort=cod', '_self')</script>";
            }
        }elseif ($_GET['sort'] == "bank") {
            $ready2 = mysqli_query($con, "UPDATE `Order` SET OrderStatus = 'Đang Chuẩn Bị Hàng' WHERE OrderID = '$_GET[change]'");
            if ($ready2) {
                echo "<script>window.open('manage_orders.php?sort=bank', '_self')</script>";
            }
        }elseif ($_GET['sort'] == "ready") {
            $ship = mysqli_query($con, "UPDATE `Order` SET OrderStatus = 'Đang Giao Hàng' WHERE OrderID = '$_GET[change]'");
            if ($ship) {
                echo "<script>window.open('manage_orders.php?sort=ready', '_self')</script>";
            }
        }elseif ($_GET['sort'] == "ship") {
            $complete = mysqli_query($con, "UPDATE `Order` SET OrderStatus = 'Đã Hoàn Thành' WHERE OrderID = '$_GET[change]'");
            $payment = mysqli_query($con, "UPDATE `Order` SET PaymentStatus = 'Đã Hoàn Thành' WHERE OrderID = '$_GET[change]'");
            if ($complete && $payment) {
                echo "<script>window.open('manage_orders.php?sort=ship', '_self')</script>";
            }
        }}
        //cancel order 
        elseif (isset($_GET['cancel'])){
            if ($_GET['sort'] == "cod") {
                $cancel1 = mysqli_query($con, "UPDATE `Order` SET OrderStatus = 'Đã Hủy' WHERE OrderID = '$_GET[cancel]'");
                if ($cancel1) {
                    echo "<script>window.open('manage_orders.php?sort=cod', '_self')</script>";
                }
            }elseif ($_GET['sort'] == "bank") {
                $cancel2 = mysqli_query($con, "UPDATE `Order` SET OrderStatus = 'Đã Hủy' WHERE OrderID = '$_GET[cancel]'");
                if ($cancel2) {
                    echo "<script>window.open('manage_orders.php?sort=bank', '_self')</script>";
                }
            }
        }

        // Update selected items
        //if check bock is checked
        if (isset($_POST['choose_all'])){
            $update = $_POST['choose_all'];
            if ($_GET['sort'] == "cod"){
                foreach ($update as $key){
                    $run_update = mysqli_query($con, "UPDATE `Order` SET OrderStatus = 'Đang Chuẩn Bị Hàng' WHERE OrderID = '$key' ");
                    if ($run_update) {
                        echo "<script>window.open('manage_orders.php?sort=cod', '_self')</script>";
                    } else {
                        echo "<script>alert('Lỗi: mysqli_error($con)!')</script>";
                    }
                }
            }elseif ($_GET['sort'] == "bank"){
                foreach ($update as $key){
                    $run_update = mysqli_query($con, "UPDATE `Order` SET OrderStatus = 'Đang Chuẩn Bị Hàng' WHERE OrderID = '$key' ");
                    if ($run_update) {
                        echo "<script>window.open('manage_orders.php?sort=bank', '_self')</script>";
                    } else {
                        echo "<script>alert('Lỗi: mysqli_error($con)!')</script>";
                    }
                }
            }elseif ($_GET['sort'] == "ready"){
                foreach ($update as $key){
                    $run_update = mysqli_query($con, "UPDATE `Order` SET OrderStatus = 'Đang Giao Hàng' WHERE OrderID = '$key' ");
                    if ($run_update) {
                        echo "<script>window.open('manage_orders.php?sort=ready', '_self')</script>";
                    } else {
                        echo "<script>alert('Lỗi: mysqli_error($con)!')</script>";
                    }
                }
            }elseif ($_GET['sort'] == "ship"){
                foreach ($update as $key){
                    $run_update = mysqli_query($con, "UPDATE `Order` SET OrderStatus = 'Đã Hoàn Thành' WHERE OrderID = '$key' ");
                    if ($run_update) {
                        echo "<script>window.open('manage_orders.php?sort=ship', '_self')</script>";
                    } else {
                        echo "<script>alert('Lỗi: mysqli_error($con)!')</script>";
                    }
                }
            }
            
            
        }
        ?>
        </div>
        <div class="pagination" id="pagination">
            <?php
            $all_order1 = mysqli_query(
                $con,
                "SELECT AccountID, OrderDate, OrderStatus, PaymentStatus, TotalOrder, od.*, OrderQuantity, p.*, c.ThumbnailImage FROM `Order` o 
                INNER JOIN `order_details` od ON o.OrderID = od.OrderID
                INNER JOIN `order_product` op ON o.OrderID = op.OrderID 
                INNER JOIN `product` p ON op.ProductID = p.ProductID 
                INNER JOIN `categories` c ON p.CategoryID = c.CategoryID $sort $search
                GROUP BY o.OrderID"
            ); 
            $num1 = mysqli_num_rows($all_order1);
            $num2 = $num1%5;
            if ($num2 >= 1) {
                $page = $num1/5 + 1;
            }elseif ($num2 < 1) {
                $page = $num1/5;
            }
            if(isset($_GET['sort']) && !isset($_GET['search'])){
                if($_GET['sort'] == "all"){
                      
                    for ($i = 1; $i <= $page; $i++) {
                        printf(
                            "<a %shref='manage_orders.php?sort=all&page=%s'>%s</a> ",
                            $i == $pageNow ? "class='current' " : "",
                            $i,
                            $i
                        );
                    }
                }elseif($_GET['sort'] == "cod"){
                    
                    for ($i = 1; $i <= $page; $i++) {
                        printf(
                            "<a %shref='manage_orders.php?sort=cod&page=%s'>%s</a> ",
                            $i == $pageNow ? "class='current' " : "",
                            $i,
                            $i
                        );
                    }
                }elseif($_GET['sort'] == "bank"){
                    
                    for ($i = 1; $i <= $page; $i++) {
                        printf(
                            "<a %shref='manage_orders.php?sort=bank&page=%s'>%s</a> ",
                            $i == $pageNow ? "class='current' " : "",
                            $i,
                            $i
                        );
                    }
                }  elseif($_GET['sort'] == "ready"){ 
                    
                    for ($i = 1; $i <= $page; $i++) {
                        printf(
                            "<a %shref='manage_orders.php?sort=ready&page=%s'>%s</a> ",
                            $i == $pageNow ? "class='current' " : "",
                            $i,
                            $i
                        );
                    }
                } elseif($_GET['sort'] == "ship"){
                    
                    for ($i = 1; $i <= $page; $i++) {
                        printf(
                            "<a %shref='manage_orders.php?sort=ship&page=%s'>%s</a> ",
                            $i == $pageNow ? "class='current' " : "",
                            $i,
                            $i
                        );
                    }
                } elseif($_GET['sort'] == "complete"){ 
                    
                    for ($i = 1; $i <= $page; $i++) {
                        printf(
                            "<a %shref='manage_orders.php?sort=complete&page=%s'>%s</a> ",
                            $i == $pageNow ? "class='current' " : "",
                            $i,
                            $i
                        );
                    }
                } elseif($_GET['sort'] == "cancel"){
                     
                    for ($i = 1; $i <= $page; $i++) {
                        printf(
                            "<a %shref='manage_orders.php?sort=cancel&page=%s'>%s</a> ",
                            $i == $pageNow ? "class='current' " : "",
                            $i,
                            $i
                        );
                    }
                }
             } elseif(isset($_GET['sort']) && isset($_GET['search'])){
              if($_GET['sort'] == "all" && $_GET['search'] != ''){ 
                    
                    $search1 = $_GET['search'];
                    for ($i = 1; $i <= $page; $i++) {
                        printf(
                            "<a %shref='manage_orders.php?sort=all&search=$search1&page=%s'>%s</a> ",
                            $i == $pageNow ? "class='current' " : "",
                            $i,
                            $i
                        );
                    }
                } elseif($_GET['sort'] == "cod" && $_GET['search'] != ''){ 
                    
                    $search1 = $_GET['search'];
                    for ($i = 1; $i <= $page; $i++) {
                        printf(
                            "<a %shref='manage_orders.php?sort=cod&search=$search1&page=%s'>%s</a> ",
                            $i == $pageNow ? "class='current' " : "",
                            $i,
                            $i
                        );
                    }
                } elseif($_GET['sort'] == "bank" && $_GET['search'] != ''){ 
                    
                    $search1 = $_GET['search'];
                    for ($i = 1; $i <= $page; $i++) {
                        printf(
                            "<a %shref='manage_orders.php?sort=bank&search=$search1&page=%s'>%s</a> ",
                            $i == $pageNow ? "class='current' " : "",
                            $i,
                            $i
                        );
                    }
                } elseif($_GET['sort'] == "ready" && $_GET['search'] != ''){ 
                    
                    $search1 = $_GET['search'];
                    for ($i = 1; $i <= $page; $i++) {
                        printf(
                            "<a %shref='manage_orders.php?sort=ready&search=$search1&page=%s'>%s</a> ",
                            $i == $pageNow ? "class='current' " : "",
                            $i,
                            $i
                        );
                    }
                } elseif($_GET['sort'] == "ship" && $_GET['search'] != ''){ 
                    
                    $search1 = $_GET['search'];
                    for ($i = 1; $i <= $page; $i++) {
                        printf(
                            "<a %shref='manage_orders.php?sort=ship&search=$search1&page=%s'>%s</a> ",
                            $i == $pageNow ? "class='current' " : "",
                            $i,
                            $i
                        );
                    }
                } elseif($_GET['sort'] == "complete" && $_GET['search'] != ''){ 
                    
                    $search1 = $_GET['search'];
                    for ($i = 1; $i <= $page; $i++) {
                        printf(
                            "<a %shref='manage_orders.php?sort=complete&search=$search1&page=%s'>%s</a> ",
                            $i == $pageNow ? "class='current' " : "",
                            $i,
                            $i
                        );
                    }
                } elseif($_GET['sort'] == "cancel" && $_GET['search'] != ''){ 
                    
                    $search1 = $_GET['search'];
                    for ($i = 1; $i <= $page; $i++) {
                        printf(
                            "<a %shref='manage_orders.php?sort=cancel&search=$search1&page=%s'>%s</a> ",
                            $i == $pageNow ? "class='current' " : "",
                            $i,
                            $i
                        );
                    }
                } 
            }

                
                
                ?>
        </div>
        <?php } ?>
        </form>
    </div>

</body>

</html>
<?php 
}else{
     header("Location: ../anon/homepage.php");
     exit();
}
 ?>