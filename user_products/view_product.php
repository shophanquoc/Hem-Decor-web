<?php
session_start();
if (isset($_SESSION['id'])) { 
    include('../database/dbcon.php');
    include('../header_footer/user_header.php');
    //get the catgory id base on the clicked product
if (isset($_GET['cid'])) { 
    $cid = $_GET['cid'];
    $result = mysqli_query($con, "SELECT c.*, ProductID, ProductName, Size, Price, ProductQuantity
    FROM categories c INNER JOIN product p ON c.CategoryID = p.CategoryID
    WHERE c.CategoryID = '$cid'");
    //retreat data from the previous query               
    $row0 = mysqli_fetch_assoc($result);
    $pid1 = $row0["ProductID"];
?>
<!DOCTYPE html>
<html>

<head>
    <title><?php echo $row0["ProductName"] ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/user.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/ccd3f2c1ca.js" crossorigin="anonymous"></script>
    <script data-require="jquery@3.1.1" data-semver="3.1.1"
        src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>

<body style="left: 0;right: 0;">
    <?php
        $cid = $_GET['cid'];
        $pro_details = "SELECT c.*, ProductID, ProductName, Size, Price, ProductQuantity
    FROM categories c INNER JOIN product p ON c.CategoryID = p.CategoryID
    WHERE c.CategoryID = '$cid'";
        $sql = mysqli_query($con, $pro_details);
        //retreat data from the previous query               
        $row = mysqli_fetch_assoc($sql);
        //count number of row
        $num = mysqli_num_rows($sql);
    ?>
    <?php
        //create img path
        $img0 =  "../images/product_images/" . $row['ThumbnailImage'];
        $img1 =  "../images/product_images/" . $row['AddPic1'];
        $img2 =  "../images/product_images/" . $row['AddPic2'];
        $img3 =  "../images/product_images/" . $row['AddPic3'];
        $img4 =  "../images/product_images/" . $row['AddPic4'];

        ?>
    <div class="card-wrapper">
        <div class="card">
            <div class="product-imgs">
                <!-- image box -->
                <div class="img-display">
                    <div class="img-showcase">
                        <?php if ($row['ThumbnailImage'] != "") { ?>
                        <img src="<?php echo $img0 ?>" alt="<?php echo $row["ProductName"] ?>">
                        <?php } ?>
                        <?php if ($row['AddPic1'] != "") { ?>
                        <img src="<?php echo $img1 ?>" alt="<?php echo $row["ProductName"] ?>">
                        <?php } ?>
                        <?php if ($row['AddPic2'] != "") { ?>
                        <img src="<?php echo $img2 ?>" alt="<?php echo $row["ProductName"] ?>">
                        <?php } ?>
                        <?php if ($row['AddPic3'] != "") { ?>
                        <img src="<?php echo $img3 ?>" alt="<?php echo $row["ProductName"] ?>">
                        <?php } ?>
                        <?php if ($row['AddPic4'] != "") { ?>
                        <img src="<?php echo $img4 ?>" alt="<?php echo $row["ProductName"] ?>">
                        <?php } ?>
                    </div>
                </div>
                <!-- click on image to see -->
                <div class="img-select">
                    <?php if ($row['ThumbnailImage'] != "") { ?>
                    <div class="img-item">
                        <a href="#" data-id="0">
                            <img src="<?php echo $img0 ?>" alt="<?php echo $row["ProductName"] ?>">
                        </a>
                    </div>
                    <?php } ?>
                    <?php if ($row['AddPic1'] != "") { ?>
                    <div class="img-item">
                        <a href="#" data-id="1">
                            <img src="<?php echo $img1 ?>" alt="<?php echo $row["ProductName"] ?>">
                        </a>
                    </div>
                    <?php } ?>
                    <?php if ($row['AddPic2'] != "") { ?>
                    <div class="img-item">
                        <a href="#" data-id="2">
                            <img src="<?php echo $img2 ?>" alt="<?php echo $row["ProductName"] ?>">
                        </a>
                    </div>
                    <?php } ?>
                    <?php if ($row['AddPic3'] != "") { ?>
                    <div class="img-item">
                        <a href="#" data-id="3">
                            <img src="<?php echo $img3 ?>" alt="<?php echo $row["ProductName"] ?>">
                        </a>
                    </div>
                    <?php } ?>
                    <?php if ($row['AddPic4'] != "") { ?>
                    <div class="img-item">
                        <a href="#" data-id="4">
                            <img src="<?php echo $img4 ?>" alt="<?php echo $row["ProductName"] ?>">
                        </a>
                    </div>
                    <?php } ?>


                </div>
            </div>
            <div class="product-content">
                <!-- product name -->
                <h2 class="product-title">
                    <?php echo $row["ProductName"]; ?>
                </h2>
                <!-- product price -->
                <div class="product-price">
                    <p id="price">
                        <?php
                            //if there's only 1 result match, there's only 1 price
                            if ($num == 1) {
                                echo number_format($row["Price"]);
                            } //else: there's a prcie range, which mean there's min & max
                            else {
                                //show min price
                                $sql1 = mysqli_query($con, "SELECT Price FROM categories c INNER JOIN product p 
                            ON c.CategoryID = p.CategoryID WHERE c.CategoryID = '$cid' AND Price
                            = (SELECT min(Price) FROM categories c INNER JOIN product p 
                            ON c.CategoryID = p.CategoryID
                            WHERE c.CategoryID = '$cid')");
                                $row1 = mysqli_fetch_array($sql1);
                                echo number_format($row1["Price"]);
                            ?> - <?php
                                    //show max price
                                    $sql2 = mysqli_query($con, "SELECT Price FROM categories c INNER JOIN product p 
                            ON c.CategoryID = p.CategoryID WHERE c.CategoryID = '$cid' AND Price
                            = (SELECT max(Price) FROM categories c INNER JOIN product p 
                            ON c.CategoryID = p.CategoryID
                            WHERE c.CategoryID = '$cid')");
                                    $row2 = mysqli_fetch_array($sql2);
                                    echo number_format($row2["Price"]);
                                } ?>
                    </p>
                </div>

                <!-- product size -->

                <?php if ($row0["Size"] != ''){ ?>
                <div class="size">
                    <div class="size1">
                        <p>Size </p>
                    </div>
                    <div class="size2">
                        <?php
                                $sql3 = mysqli_query($con, $pro_details);
                                $num3 = mysqli_num_rows($sql3);
                                $i = 0;
                                //print out the product size
                                while ($row3 = mysqli_fetch_array($sql3)) {                  
                                ?>
                        <!-- choose size -->
                        <div class="dsize">
                            <span class="psize" id="size<?php echo $i?>"
                                onclick="changeColor()"><?php echo $row3["Size"]; ?>
                                <input id="product<?php echo $i?>" value="<?php echo $row3['ProductID'];?>"
                                    style="display: none;">
                                <input id="price<?php echo $i?>" value="<?php echo $row3['Price'];?>"
                                    style="display: none;">
                                <input id="pnumber<?php echo $i?>" value="<?php echo $row3['ProductQuantity'];?>"
                                    style="display: none;">
                            </span>
                        </div>
                        <?php 
                                $i++;
                                }
                                ?>
                    </div>
                </div>
                <?php }  ?>

                <!-- product quantity -->
                <form action="add_cart.php?cid=<?php echo $cid?>" method="post" enctype="multipart/form-data">
                    <input id="pid" name="pid" value="<?php echo $pid1?>" type="text" style="display: none;">
                    <div class="number">
                        <p class="quantity"> Số lượng </p>
                        <span class="minus">-</span>

                        <!-- allow only number from 0-9 -->

                        <input type="text" name="quantity" value="1" required
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 13" />
                        <span class="plus">+</span>

                        <p class="pnumber" id="pnumber">
                            <?php
                                //calculate the total amount of product
                                $sum = mysqli_query($con, "SELECT sum(ProductQuantity) AS `sum` FROM categories c 
                            INNER JOIN product p ON c.CategoryID = p.CategoryID
                            WHERE c.CategoryID = '$cid'");
                                $sum1 = mysqli_fetch_array($sum);
                                $sum2 = $sum1["sum"];
                                echo $sum2;
                                ?> sản phẩm
                        </p>

                    </div>
                    <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
                    <?php if (isset($_GET['success'])) { ?>
                    <p class="success"><?php echo $_GET['success']; ?></p>
                    <?php } ?>
                    <div class="purchase-info">
                        <button type="submit" class="btn">
                            <i class="fas fa-cart-plus"></i> Thêm Vào Giỏ Hàng
                        </button>
                    </div>
                </form>

            </div>
        </div>
        <?php if ($row['Description'] != "") { ?>
        <div class="product-description">
            <h4>Mô tả sản phẩm</h4>
            <p>
                <?php
                    //show description and include line break for newline that stored in sql
                    echo nl2br($row["Description"]);
                    ?>
            </p>
        </div>
        <?php } ?>
    </div>

    </div>
    <?php if ($row['Description'] != "") { ?>
    <div class="view-footer" style="bottom: 0; left: 0;right: 0;">
        <?php include '../header_footer/user_footer.php'; ?>
    </div>
    <?php } elseif ($row['Description'] == "") { ?>
    <div class="view-footer" style="bottom: 0; left: 0;right: 0; position: absolute;">
        <?php include '../header_footer/user_footer.php'; ?>
    </div>
    <?php }?>
    <script>
    $(document).ready(function() {
        $('.minus').click(function() {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
            $input.val(count);
            $input.change();
            return false;

        });
        $('.plus').click(function() {
            var $input = $(this).parent().find('input');
            $input.val(parseInt($input.val()) + 1);
            $input.val();
            $input.change();
            return false;
        });
        for (let index = 0; index < <?php echo $num3?>; index++) {
            var sizeID = "#size" + index;
            $(sizeID).click(function(e) {
                var productID = "#product" + index;
                var priceID = "#price" + index;
                var pnumberID = "#pnumber" + index;

                var product = $(productID).val();
                var price = parseInt($(priceID).val()).toLocaleString('en-US');
                var pnumber = $(pnumberID).val() + " sản phẩm";
                console.log(sizeID, priceID, price, pnumber, productID, product);
                $("#pid").val(product);
                $("#price").text(price);
                $("#pnumber").text(pnumber);
                e.preventDefault();
            });
        }

    });

    var prevDiv = null

    function changeColor() {
        if (prevDiv) {
            prevDiv.style.backgroundColor = "white";
        }
        var target = event.currentTarget
        target.style.backgroundColor = "#f1e4b8"
        selected = true
        prevDiv = target;
    }
    const imgs = document.querySelectorAll('.img-select a');
    const imgBtns = [...imgs];
    let imgId = 1;
    imgBtns.forEach((imgItem) => {
        imgItem.addEventListener('click', (e) => {
            event.preventDefault();
            imgId = imgItem.dataset.id;
            slideImage();
        });
    });

    function slideImage() {
        const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;
        const displayHeight = document.querySelector('.img-showcase img:first-child').clientHeight;
        const imgShowcase = document.querySelector('.img-showcase');
        imgShowcase.style.transform = `translateX(${ -(imgId) * displayWidth}px)`;

    }
    window.addEventListener('resize', slideImage);
    </script>
</body>

</html>
<?php }
}else{
    echo "<script>window.open('../anon/homepage.php', '_self')</script>";
     exit();
}
?>