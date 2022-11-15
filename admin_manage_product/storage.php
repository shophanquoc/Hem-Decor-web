<?php
session_start();
if (isset($_SESSION['id'])) {
include('../database/dbcon.php');
include '../header_footer/admin_header.php';
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Chi Tiết Kho Hàng </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <div class=main><?php include '../header_footer/admin_toggle.php'; ?>
        <div class="product_box">
            <div class="cardHeader">
                <h2>Kho</h2>
            </div>
            <div class="border_bottom"></div>
            <!-- search box -->
            <?php if(!isset($_GET['search'])){?>
            <form action="search.php?type=product" class="search-form" method="post">
                <input type="search" name="keyword" placeholder="Tìm Kiếm" id="search-box" required>
                <button type="submit" class="fa fa-search"></button>
            </form>
            <?php } ?>
            <?php if(isset($_GET['search'])){?>
            <form action="search.php?type=product" class="search-form" method="post">
                <input type="search" name="keyword" placeholder="Tìm Kiếm" value= "<?php echo "$_GET[search]"?>" id="search-box" required>
                <button type="submit" class="fa fa-search"></button>
            </form>
            <?php } ?>
            <a href="manage_category.php">
                <button type="button" class="button button2"><i class="fa fa-arrow-circle-left"> Quay Lại</i></button>
            </a>
            <?php if(!isset($_GET['search'])){ ?>
            <table width="100%">
                <colgroup>
                    <col span="1" style="width: 10%;">
                    <col span="1" style="width: 15%;">
                 </colgroup>
                <thead>
                    <tr>
                        <th>Phân Loại</th>
                        <th>Mã Sản Phẩm</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Size</th>
                        <th>Giá</th>
                        <th>Số Lượng</th>
                    </tr>
                </thead>
                <?php
                // $i = 1;
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
                define("PER_PAGE", "10"); // ENTRIES PER PAGE
                $stmt = $pdo->prepare("SELECT CEILING(COUNT(*) / " . PER_PAGE . ") `pages` FROM `product`");
                $stmt->execute();
                $pageTotal = $stmt->fetchColumn();

                // (C) GET ENTRIES FOR CURRENT PAGE
                // (C1) LIMIT (X, Y) FOR SQL QUERY
                $pageNow = isset($_GET["page"]) ? $_GET["page"] : 1;
                $limX = ($pageNow - 1) * PER_PAGE;
                $limY = PER_PAGE;
                $all_products = mysqli_query($con, "SELECT * FROM product ORDER BY CreateDate DESC LIMIT $limX, $limY");

                while ($row = mysqli_fetch_array($all_products)) {

                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $row['CategoryID']; ?></td>
                            <td><?php echo $row['ProductID']; ?></td>
                            <td><?php echo $row['ProductName']; ?></td>
                            <td><?php echo $row['Size']; ?></td>
                            <td><?php echo number_format($row['Price']); ?></td>
                            <td><?php echo $row['ProductQuantity']; ?></td>
                        </tr>
                    </tbody>
                <?php
                } ?>
            </table>

            <div class="pagination" id="pagination">
            <?php
            $all_products1 = mysqli_query($con,"SELECT * FROM product");
            $num = mysqli_num_rows($all_products1);
            $num1 = $num%10;
            if ($num1 > 1) {
                $page = $num/10 + 1;
            }elseif ($num1 <= 1) {
                $page = $num/10;
            }

            for ($i = 1; $i <= $page; $i++) {
                printf(
                    "<a %shref='storage.php?page=%s'>%s</a> ",
                    $i == $pageNow ? "class='current' " : "",
                    $i,
                    $i
                );
            }
            
            ?> 
            </div>
            <?php } elseif(isset($_GET['search'])){
                $product = "$_GET[search]";
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
                define("PER_PAGE", "10"); // ENTRIES PER PAGE
                $stmt = $pdo->prepare("SELECT CEILING(COUNT(*) / " . PER_PAGE . ") `pages` FROM `categories`");
                $stmt->execute();
                $pageTotal = $stmt->fetchColumn();
    
                // (C) GET ENTRIES FOR CURRENT PAGE
                // (C1) LIMIT (X, Y) FOR SQL QUERY
                $pageNow = isset($_GET["page"]) ? $_GET["page"] : 1;
                $limX = ($pageNow - 1) * PER_PAGE;
                $limY = PER_PAGE;
                $result = mysqli_query($con,"SELECT * FROM product 
                WHERE CategoryID LIKE '%$product%' OR ProductID LIKE '%$product%' OR ProductName LIKE '%$product%'                     
                ORDER BY ProductID LIMIT $limX, $limY");
                $num = mysqli_num_rows($result);
                if($num == 0){?>
                    <div class="message">Không Có Kết Quả Trùng Khớp</div>
                <?php } else{
                ?>
                <table width="100%">
                <colgroup>
                    <col span="1" style="width: 10%;">
                    <col span="1" style="width: 15%;">
                 </colgroup>
                <thead>
                    <tr>
                        <th>Phân Loại</th>
                        <th>Mã Sản Phẩm</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Size</th>
                        <th>Giá</th>
                        <th>Số Lượng</th>
                    </tr>
                </thead>
                <?php 
                $i = 1;
                while ($row = mysqli_fetch_array($result)) {

                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $row['CategoryID']; ?></td>
                            <td><?php echo $row['ProductID']; ?></td>
                            <td><?php echo $row['ProductName']; ?></td>
                            <td><?php echo $row['Size']; ?></td>
                            <td><?php echo number_format($row['Price']); ?></td>
                            <td><?php echo $row['ProductQuantity']; ?></td>
                        </tr>
                    </tbody>
                <?php $i++;
                } ?>
            </table>

            <div class="pagination" id="pagination">
            <?php
            $all_products1 = mysqli_query($con,"SELECT * FROM product 
            WHERE CategoryID LIKE '%$product%' OR ProductID LIKE '%$product%' OR ProductName LIKE '%$product%'");
            $num = mysqli_num_rows($all_products1);
            $num1 = $num%10;
            if ($num1 > 1) {
                $page = $num/10 + 1;
            }elseif ($num1 <= 1) {
                $page = $num/10;
            }

            for ($i = 1; $i <= $page; $i++) {
                printf(
                    "<a %shref='storage.php?search=$product&page=%s'>%s</a> ",
                    $i == $pageNow ? "class='current' " : "",
                    $i,
                    $i
                );
            }
            
            ?> 
            </div>
            <?php }
            }
            ?>
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