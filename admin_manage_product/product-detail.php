<?php
session_start();
include('../database/dbcon.php');
include '../header_footer/admin_header.php';
//get the catgory id base on the clicked product
if (isset($_SESSION['id'])) {
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
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row["ProductName"] ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <div class="main">
        <?php include '../header_footer/admin_toggle.php'; ?>
        <div class="btn">
            <a href="product-detail.php?cid=<?php echo $row['CategoryID']?>&delete_product">
                <button type="submit" class="button button3" name="delete_all" onclick='return checkdelete()'><i
                        class="fa fa-trash-o"> Xóa Sản Phẩm</i>
                </button>
            </a>
            <a href="edit_product.php?cid=<?php echo $cid?>">
                <button type="button" class="button button1"><i class="fa fa-pencil"> Chỉnh sửa sản phẩm</i></button>
            </a>
        </div>
        <?php
              //create img path
              $img0 =  "../images/product_images/" . $row['ThumbnailImage'];
              $img1 =  "../images/product_images/" . $row['AddPic1'];
              $img2 =  "../images/product_images/" . $row['AddPic2'];
              $img3 =  "../images/product_images/" . $row['AddPic3'];
              $img4 =  "../images/product_images/" . $row['AddPic4'];

            ?>
        <div class="card-wrapper">
            <div class="card1">
                <div class="product-imgs">
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
                    <div class="img-select">
                        <div class="img-item">
                            <a href="#" data-id="1">
                                <?php if ($row['ThumbnailImage'] != "") { ?>
                                <img src="<?php echo $img0 ?>" alt="<?php echo $row["ProductName"] ?>">
                                <?php } ?>
                            </a>
                        </div>
                        <div class="img-item">
                            <a href="#" data-id="2">
                                <?php if ($row['AddPic1'] != "") { ?>
                                <img src="<?php echo $img1 ?>" alt="<?php echo $row["ProductName"] ?>">
                                <?php } ?>
                            </a>
                        </div>
                        <div class="img-item">
                            <a href="#" data-id="3">
                                <?php if ($row['AddPic2'] != "") { ?>
                                <img src="<?php echo $img2 ?>" alt="<?php echo $row["ProductName"] ?>">
                                <?php } ?>
                            </a>
                        </div>
                        <div class="img-item">
                            <a href="#" data-id="4">
                                <?php if ($row['AddPic3'] != "") { ?>
                                <img src="<?php echo $img3 ?>" alt="<?php echo $row["ProductName"] ?>">
                                <?php } ?>
                            </a>
                        </div>
                        <div class="img-item">
                            <a href="#" data-id="5">
                                <?php if ($row['AddPic4'] != "") { ?>
                                <img src="<?php echo $img4 ?>" alt="<?php echo $row["ProductName"] ?>">
                                <?php } ?>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- card right -->

                <div class="product-content">

                    <h2 class="product-title"><?php echo $row['ProductName']; ?></h2>

                    <div class="product-info">
                        <p class="">Tên: <?php echo $row["CategoryName"]; ?></p>
                        <p class="">Mã phân loại: <?php echo $row["CategoryID"]; ?></p>
                        <p class="">Chất liệu: <?php echo $row["Material"]; ?></p>

                    </div>

                    <div class="product-detail">
                        <h2>Mô tả sản phẩm: </h2>
                        <p>
                            <?php
                              //show description and include line break for newline that stored in sql
                              echo nl2br($row["Description"]);
                            ?>
                        </p>
                    </div>

                    <table class = "details_table" style="width:100%">
                        <tr>
                            <th>Mã</th>
                            <th>Size</th>
                            <th>Giá</th>
                            <th>Kho</th>
                        </tr>
                        <?php
                          $product = mysqli_query($con, "SELECT ProductID, Size, Price, ProductQuantity
                          FROM categories c INNER JOIN product p ON c.CategoryID = p.CategoryID
                          WHERE c.CategoryID = '$cid' ORDER BY p.CreateDate DESC");
                          $i = 1;
                          while ( $row1 = mysqli_fetch_assoc($product)) { ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row1["ProductID"]; ?></td>
                            <td style="text-align: right;"><?php echo $row1["Size"]; ?></td>
                            <td style="text-align: right;"><?php echo number_format($row1["Price"]); ?></td>
                            <td style="text-align: right;"><?php echo $row1["ProductQuantity"]; ?></td>

                        </tr>
                        <?php $i++;
                          } ?>
                    </table>

                </div>
            </div>
        </div>
        <!-- confirm delete function -->
        <script>
        function checkdelete() {
            return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');
        }
        </script>
        <?php
                  // Delete Product by icon
                    if (isset($_GET['delete_product'])) {
                        //delete img from folder first
                        unlink($img0);
                        unlink($img1);
                        unlink($img2);
                        unlink($img3);
                        unlink($img4); 

                        $delete_product = mysqli_query($con, "DELETE FROM categories WHERE CategoryID = '$cid' ");
                        if ($delete_product) {
                            echo "<script> alert('Xóa Thành Công')</script>";
                            echo "<script>window.open('manage_category.php', '_self')</script>";
                        }
                    }
                  ?>
</body>

</html>

<script>
const imgs = document.querySelectorAll('.img-select a');
const imgBtns = [...imgs];
let imgId = 1;

imgBtns.forEach((imgItem) => {
    imgItem.addEventListener('click', (event) => {
        event.preventDefault();
        imgId = imgItem.dataset.id;
        slideImage();
    });
});

function slideImage() {
    const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

    document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
}

window.addEventListener('resize', slideImage);

function toggleMenu() {
    let navigation = document.querySelector('.navigation');
    let toggle = document.querySelector('.toggle');
    let main = document.querySelector('.main');
    navigation.classList.toggle('active');
    toggle.classList.toggle('active');
    main.classList.toggle('active');
}
</script>
<?php }else {
        echo "<script>window.open('product_page.php', '_self')</script>";
        exit();
    }
    ?>