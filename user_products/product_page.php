<?php
session_start ();
if (isset($_SESSION['id'])) { 
include('../database/dbcon.php');
include '../header_footer/user_header.php';
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/user.css?v=<?php echo time(); ?>">
</head>

<body id="pro-page">
    <div class="name">
        <h3>Sản Phẩm</h3>
    </div>
    <div class="topnav" id="myTopnav">
        <a href="product_page.php" class="active">Tất cả</a>
        <a href="khay.php">Khay</a>
        <a href="thot.php">Thớt</a>
        <a href="khac.php">Khác</a>
    </div>
    <div class="main">
        <form action="" method="get">
            <div class="row">
                <div class="col1">
                    <div class="sort-box">
                        <select name="sort" id="sort" class="form-control" onchange="this.form.submit();">
                            <!-- select sorting option and remember the option when the page is reload -->
                            <option value="new"
                                <?php if(isset($_GET['sort']) && $_GET['sort'] == "new"){echo "selected";}?>>Mới Nhất
                            </option>
                            <option value="low"
                                <?php if(isset($_GET['sort']) && $_GET['sort'] == "low"){echo "selected";}?>>Giá: Thấp
                                đến Cao</option>
                            <option value="high"
                                <?php if(isset($_GET['sort']) && $_GET['sort'] == "high"){echo "selected";}?>>Giá: Cao
                                đến Thấp</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
        <div class="container-p" id="1">
            <?php
                //initialise variable
                $sort = "";  
                $sort_option = "";
                //check điều kiện để sort
                if(isset($_GET['sort'])){
                    if($_GET['sort'] == "new"){ //phân loại theo ngày thêm sp và thứ tự giảm dần
                        $sort = "c.CreateDate";
                        $sort_option = "DESC";
                    } elseif($_GET['sort'] == "low"){ //phân loại theo giá và thứ tự tăng dần
                        $sort = "Price";
                        $sort_option = "ASC";
                    }elseif($_GET['sort'] == "high"){ //phân loại theo giá và thứ tự giảm dần
                        $sort = "Price";
                        $sort_option = "DESC";
                    }
                } else {
                    $sort = "c.CreateDate";  
                    $sort_option = "DESC";
                }
                // PAGINATION
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
                define("PER_PAGE", "12"); // ENTRIES PER PAGE
                $stmt = $pdo->prepare("SELECT CEILING(COUNT(*) / " . PER_PAGE . ") `pages` FROM `categories`");
                $stmt->execute();
                $pageTotal = $stmt->fetchColumn();
                $pageNow = isset($_GET["page"]) ? $_GET["page"] : 1;
                $limX = ($pageNow - 1) * PER_PAGE;
                $limY = PER_PAGE;
                //thực hiện query trong database
                $all_products = mysqli_query(
                    $con,
                    "SELECT c.CategoryID, ProductID, ProductName, ThumbnailImage, 
                    min(Price) AS `min`, max(Price) AS `max`, SUM(ProductQuantity) AS Quantity 
                    FROM `Categories` c INNER JOIN product p ON c.CategoryID = p.CategoryID                    
                    GROUP BY c.CategoryID ORDER BY $sort $sort_option
                    LIMIT $limX, $limY"
                );
                $i = 1;
                //retreat data from the previous query
                while ($row = mysqli_fetch_array($all_products)) {
                    //check if the product is still available
                    if($row["Quantity"] > 0){
                ?>
            <div class="card-p">
                <!-- echo the category id -->

                <div class="img">
                    <a href="view_product.php?cid=<?php echo $row["CategoryID"]?>">
                        <?php 
                                        //create img path
                                        $img =  "../images/product_images/".$row['ThumbnailImage'];
                                        ?>
                        <!-- display img -->
                        <img src="<?php echo $img ?>">
                    </a>
                </div>

                <div class="content">
                    <a href="view_product.php?cid=<?php echo $row["CategoryID"]?>">
                        <div class="productName">
                            <!-- display product name -->
                            <h3><?php echo $row['ProductName'];?></h3>
                        </div>
                    </a>
                    <div class="price">
                        <!-- if min = max then display only 1 price -->
                        <?php if($row['min'] == $row['max']){?>
                        <h2><?php echo number_format($row['min']);?>
                        </h2>
                        <!-- else display price range from min to max -->
                        <?php } else {?>
                        <h2><?php echo number_format($row['min']);?> - <?php echo number_format($row['max']);?>
                        </h2>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php 
                    } //if the product is out of stock
                    else { ?>
            <div class="card-p1">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- echo the category id -->
                    <div class="img">
                        <?php 
                                        //create img path
                                        $img =  "../images/product_images/".$row['ThumbnailImage'];
                                        ?>
                        <!-- display img -->
                        <img src="<?php echo $img ?>">
                        <div class="middle">
                            <div class="text">Hết Hàng</div>
                        </div>
                    </div>
                    <div class="content">
                        <div class="productName">
                            <!-- display product name -->
                            <h3><?php echo $row['ProductName'];?></h3>
                        </div>
                        <div class="price">
                            <!-- if min = max then display only 1 price -->
                            <?php if($row['min'] == $row['max']){?>
                            <h2><?php echo number_format($row['min']);?>
                            </h2>
                            <!-- else display price range from min to max -->
                            <?php } else {?>
                            <h2><?php echo number_format($row['min']);?> - <?php echo number_format($row['max']);?>
                            </h2>
                            <?php } ?>
                        </div>
                    </div>
                </form>
            </div>
            <?php }
                $i++;
                } ?>
        </div>
    </div>
    <br>
    <div class="pagination" id="pagination">
        <?php
        $all_products1 = mysqli_query(
            $con,
            "SELECT c.CategoryID, ProductID, ProductName, ThumbnailImage, 
            min(Price) AS `min`, max(Price) AS `max`, SUM(ProductQuantity) AS Quantity 
            FROM `Categories` c INNER JOIN product p ON c.CategoryID = p.CategoryID   
            GROUP BY c.CategoryID ORDER BY $sort $sort_option");
            $num = mysqli_num_rows($all_products1);
            $num1 = $num%10;
            if ($num1 > 1) {
                $page = $num/12 + 1;
            }elseif ($num1 <= 1) {
                $page = $num/12;
            }
                    if(isset($_GET['sort'])){
                        if($_GET['sort'] == "new"){ //phân loại theo ngày thêm sp và thứ tự giảm dần
                            for ($i = 1; $i <= $page; $i++) {
                                printf(
                                    "<a %shref='product_page.php?sort=new&page=%s'>%s</a> ",
                                    $i == $pageNow ? "class='current' " : "",
                                    $i,
                                    $i
                                );
                            } 
                        }elseif($_GET['sort'] == "low"){ //phân loại theo giá và thứ tự tăng dần
                            for ($i = 1; $i <= $page; $i++) {
                                printf(
                                    "<a %shref='product_page.php?sort=low&page=%s'>%s</a> ",
                                    $i == $pageNow ? "class='current' " : "",
                                    $i,
                                    $i
                                );
                            }
                        }elseif($_GET['sort'] == "high"){ //phân loại theo giá và thứ tự giảm dần
                            for ($i = 1; $i <= $page; $i++) {
                                printf(
                                    "<a %shref='product_page.php?sort=high&page=%s'>%s</a> ",
                                    $i == $pageNow ? "class='current' " : "",
                                    $i,
                                    $i
                                );
                            }
                        } 
                    }else {
                        for ($i = 1; $i <= $page; $i++) {
                        printf(
                            "<a %shref='product_page.php?page=%s'>%s</a> ",
                            $i == $pageNow ? "class='current' " : "",
                            $i,
                            $i
                        );
                        }
                    }
                    ?>
    </div>
    <div class="view-footer" style="bottom: 0; left: 0;right: 0; position:absolute;">
        <?php include '../header_footer/user_footer.php'; ?></div>
</body>

</html>
<?php 
}else{
    echo "<script>window.open('../anon/homepage.php', '_self')</script>";
     exit();
}
 ?>