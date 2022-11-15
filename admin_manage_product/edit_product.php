<?php
session_start();
include('../database/dbcon.php');
include '../header_footer/admin_header.php';
//get the catgory id base on the clicked product
if (isset($_SESSION['id'])) {
  $cid = $_GET['cid'];
  $_SESSION['cid'] = $cid;
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
        <?php include '../header_footer/admin_toggle.php'; 
        //create img path
        $img0 =  "../images/product_images/" . $row['ThumbnailImage'];
        $img1 =  "../images/product_images/" . $row['AddPic1'];
        $img2 =  "../images/product_images/" . $row['AddPic2'];
        $img3 =  "../images/product_images/" . $row['AddPic3'];
        $img4 =  "../images/product_images/" . $row['AddPic4'];
      ?>
        <a href="product-detail.php?cid=<?php echo $cid?>">
            <button type="button" class="button button4"><i class="fa fa-ban"> Hủy</i></button>
        </a>
        <button type="submit" class="button button1" form="my-form" id="save"><i class="fa fa-floppy-o">
                Lưu</i></button>
        <div class="card-wrapper">
            <div class="card">
                <form action="save.php?action=edit" id="my-form" method="post" enctype="multipart/form-data">
                    <div class="product-imgs">
                        <div class="img-display">
                            <div class="img-showcase" id="img0">
                                <?php if ($row['ThumbnailImage'] != "") { ?>
                                <img src="<?php echo $img0 ?>" alt="<?php echo $row["ProductName"] ?>">
                                <?php } ?>
                            </div>
                            <div class="img0" id="choose">
                                <label for="image0"><span style="color:red; display:inline;">* </span>Chọn ảnh bìa</label>
                                <input type="file" name="image0" id="image0"
                                    accept="image/png, image/jpeg, image/jpg, img/gif">
                                <i class="fa fa-times" onclick="delImage(0)" id="x0" style="display: none;"></i>
                                <div id="preview0"></div>
                            </div>
                        </div>
                        <div class="img-select">
                            <div class="img-item" style="width: 25%; height: 25%;">
                                <?php if ($row['AddPic1'] != "") { ?>
                                <div class="img" id="img1"><img src="<?php echo $img1 ?>"
                                        alt="<?php echo $row["ProductName"] ?>"></div>
                                <div class="file" id="choose">
                                    <label for="image1">Chọn ảnh</label>
                                    <input type="file" name="image1" id="image1"
                                        accept="image/png, image/jpeg, image/jpg, img/gif">
                                    <i class="fa fa-times" onclick="delImage(1)" id="x1" style="display: none;"></i>
                                    <div id="preview1"></div>
                                </div>
                                <?php } elseif ($row['AddPic3'] == "") { ?>
                                <div class="img" id="img1">
                                    <img src="../images/blank.jpg" alt="<?php echo $row["ProductName"] ?>"
                                        style="color: #707070">
                                    <!-- <i class="fa fa-file-image-o"></i>-->
                                </div>
                                <div class="file" id="choose">
                                    <label for="image1">Chọn ảnh</label>
                                    <input type="file" name="image1" id="image1"
                                        accept="image/png, image/jpeg, image/jpg, img/gif">
                                    <i class="fa fa-times" onclick="delImage(1)" id="x1" style="display: none;"></i>
                                    <div id="preview1"></div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="img-item" style="width: 25%; height: 25%;">
                                <?php if ($row['AddPic2'] != "") { ?>
                                <div class="img" id="img2"><img src="<?php echo $img2 ?>"
                                        alt="<?php echo $row["ProductName"] ?>"></div>
                                <div class="file" id="choose">
                                    <label for="image2">Chọn ảnh</label>
                                    <input type="file" name="image2" id="image2"
                                        accept="image/png, image/jpeg, image/jpg, img/gif">
                                    <i class="fa fa-times" onclick="delImage(2)" id="x2" style="display: none;"></i>
                                    <div id="preview2"></div>
                                </div>
                                <?php } elseif ($row['AddPic2'] == "") { ?>
                                <div class="img" id="img2">
                                    <img src="../images/blank.jpg" alt="<?php echo $row["ProductName"] ?>"
                                        style="color: #707070">
                                    <!-- <i class="fa fa-file-image-o"></i>-->
                                </div>
                                <div class="file" id="choose">
                                    <label for="image2">Chọn ảnh</label>
                                    <input type="file" name="image2" id="image2"
                                        accept="image/png, image/jpeg, image/jpg, img/gif">
                                    <i class="fa fa-times" onclick="delImage(2)" id="x2" style="display: none;"></i>
                                    <div id="preview2"></div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="img-item" style="width: 25%; height: 25%;">
                                <?php if ($row['AddPic3'] != "") { ?>
                                <div class="img" id="img3"><img src="<?php echo $img3 ?>"
                                        alt="<?php echo $row["ProductName"] ?>"></div>
                                <div class="file" id="choose">
                                    <label for="image3">Chọn ảnh</label>
                                    <input type="file" name="image3" id="image3"
                                        accept="image/png, image/jpeg, image/jpg, img/gif">
                                    <i class="fa fa-times" onclick="delImage(3)" id="x3" style="display: none;"></i>
                                    <div id="preview3"></div>
                                </div>
                                <?php } elseif ($row['AddPic3'] == "") { ?>
                                <div class="img" id="img3">
                                    <img src="../images/blank.jpg" alt="<?php echo $row["ProductName"] ?>"
                                        style="color: #707070">
                                    <!-- <i class="fa fa-file-image-o"></i>-->
                                </div>
                                <div class="file" id="choose">
                                    <label for="image3">Chọn ảnh</label>
                                    <input type="file" name="image3" id="image3"
                                        accept="image/png, image/jpeg, image/jpg, img/gif">
                                    <i class="fa fa-times" onclick="delImage(3)" id="x3" style="display: none;"></i>
                                    <div id="preview3"></div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="img-item" style="width: 25%; height: 25%;">
                                <?php if ($row['AddPic4'] != "") { ?>
                                <div class="img" id="img4"><img src="<?php echo $img4 ?>"
                                        alt="<?php echo $row["ProductName"] ?>"></div>
                                <div class="file" id="choose">
                                    <label for="image4">Chọn ảnh</label>
                                    <input type="file" name="image4" id="image4"
                                        accept="image/png, image/jpeg, image/jpg, img/gif">
                                    <i class="fa fa-times" onclick="delImage(4)" id="x4" style="display: none;"></i>
                                    <div id="preview4"></div>
                                </div>
                                <?php } elseif ($row['AddPic4'] == "") { ?>
                                <div class="img" id="img4">
                                    <img src="../images/blank.jpg" alt="<?php echo $row["ProductName"] ?>"
                                        style="color: #707070">
                                    <!-- <i class="fa fa-file-image-o"></i>-->
                                </div>
                                <div class="file" id="choose">
                                    <label for="image4">Chọn ảnh</label>
                                    <input type="file" name="image4" id="image4"
                                        accept="image/png, image/jpeg, image/jpg, img/gif">
                                    <i class="fa fa-times" onclick="delImage(4)" id="x4" style="display: none;"></i>
                                    <div id="preview4"></div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <!-- card right -->

                    <div class="product-content">
                        <?php //display error message
                            if (isset($_GET['error'])) { ?>
                        <div id="error" style="font-size: 20px">
                            <p class="error"><?php echo $_GET['error']; ?></p>
                        </div>
                        <?php } ?>
                        <?php if (isset($_GET['success'])) { ?>
                        <p class="success"><?php echo $_GET['success']; ?></p>
                        <?php } ?>
                        <h2 class="product-title"><?php echo $row['ProductName']; ?></h2>

                        <div class="product-info">
                            <p class=""><span style="color:red; display:inline;">* </span>Tên:
                                <input type="text" id="cname" name="cname" value="<?php echo $row["CategoryName"]; ?>"
                                    required>
                            </p>
                            <p class=""><span style="color:red; display:inline;">* </span>Mã phân loại: <input type="text" id="cateid" name="cateid"
                                    value="<?php echo $row["CategoryID"]; ?>" required></p>
                            <p class="">Chất liệu: <input type="text" id="material" name="material"
                                    value="<?php echo $row["Material"]; ?>"></p>

                        </div>

                        <div class="product-detail">
                            <h2>Mô tả sản phẩm: </h2>
                            <p><textarea id="desc" name="desc">
                            <?php echo $row["Description"]; ?>
                          </textarea>
                            </p>
                        </div>

                    </div>
                </form>
                <div class="size-edit">
                    <div class="btn">
                        <button type="button" class="button button9" id="new_size"><i class="fa fa-plus"> Thêm
                                Size</i></button>
                        <!-- The Modal -->
                        <div id="myModal" class="modal" style="font-size: 20px;">
                            <!-- Modal content -->
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <h2>Thông tin chi tiết </h2>
                                <form action="save.php?action=new" method="POST" role="form"
                                    enctype="multipart/form-data">
                                    <div class="modal-details">
                                        <p class="">Mã sản phẩm <span style="color:red; display:inline;">*</span>
                                        <div><input type="text" name="proid" required></div>
                                        </p>
                                        <p class="">Size
                                        <div><input type="text" name="size"></div>
                                        </p>
                                        <p class="">Giá <span style="color:red; display:inline;">*</span>
                                        <div><input type="text" name="price"></div>
                                        </p>

                                        <p class="">Số Lượng <span style="color:red; display:inline;">*</span>
                                        <div><input type="text" name="quantity" required></div>
                                        </p>
                                    </div>
                                    <p style=" display: flex; justify-content: center; align-items: center;">
                                        <button type="submit" class="button8">Lưu</button>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="details_table" style="width:100%">
                        <tr>
                            <th>Mã</th>
                            <th>Size</th>
                            <th>Giá</th>
                            <th>Kho</th>
                            <th>Thao Tác</th>
                        </tr>
                        <?php
                          $product = mysqli_query($con, "SELECT ProductID, Size, Price, ProductQuantity
                          FROM categories c INNER JOIN product p ON c.CategoryID = p.CategoryID
                          WHERE c.CategoryID = '$cid' ORDER BY p.CreateDate DESC");
                          $count = mysqli_num_rows($product);
                          $i = 0;
                          while ( $row1 = mysqli_fetch_assoc($product)) { ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row1["ProductID"]; ?></td>
                            <td style="text-align: right;"><?php echo $row1["Size"]; ?></td>
                            <td style="text-align: right;"><?php echo number_format($row1["Price"]); ?></td>
                            <td style="text-align: right;"><?php echo $row1["ProductQuantity"]; ?></td>
                            <td style="text-align: center;">
                                <a style="text-decoration: none;">
                                    <button type="button" id="edit<?php echo $i?>" class="fa fa-pencil-square-o"
                                        style="border: none; font-size: 25px; "></button>
                                </a>
                                <!-- The Modal -->
                                <div id="myModal<?php echo $i?>" class="modal">
                                    <!-- Modal content -->
                                    <div class="modal-content">
                                        <span class="close" id="close<?php echo $i?>">&times;</span>
                                        <h2>Thông tin chi tiết </h2>
                                        <form action="save.php?action=edit-size&pid=<?php echo $row1["ProductID"]; ?>"
                                            method="POST" role="form" enctype="multipart/form-data">
                                            <div class="modal-details">
                                                <p class="">Mã sản phẩm <span
                                                        style="color:red; display:inline;">*</span>
                                                <div><input type="text" name="proid"
                                                        value="<?php echo $row1["ProductID"]; ?>" required></div>
                                                </p>
                                                <p class="">Size
                                                <div><input type="text" name="size"
                                                        value="<?php echo $row1["Size"]; ?>">
                                                </div>
                                                </p>

                                                <p class="">Giá <span style="color:red; display:inline;">*</span>
                                                <div><input type="text" name="price"
                                                        value="<?php echo $row1["Price"]; ?>">
                                                </div>
                                                </p>

                                                <p class="">Số Lượng <span style="color:red; display:inline;">*</span>
                                                <div><input type="text" name="quantity"
                                                        value="<?php echo $row1["ProductQuantity"]; ?>" required></div>
                                                </p>
                                            </div>
                                            <p style=" display: flex; justify-content: center; align-items: center;">
                                                <button type="submit" class="button8">Lưu</button>
                                            </p>
                                        </form>
                                    </div>
                                </div>
                </div>

            </div>
            <a
                href="edit_product.php?cid=<?php echo $row['CategoryID'] ?>&delete_size=<?php echo $row1['ProductID']; ?>">
                <button type="button" id="delete" class="fa fa-trash-o" style="border: none; font-size: 25px;"
                    onclick='return checkdelete()'></button>
            </a>
            </td>

            </tr>
            <?php $i++;
                          } ?>
            </table>

        </div>
    </div>
    </div>
    <!-- confirm delete function -->
    <script>
    //ảnh bìa
    const delImage = (i) => {
        const image = document.getElementById(`image${i}`);
        image.value = "";
        const preview = document.getElementById(`preview${i}`);
        preview.innerHTML = "";
    }
    $("#image0").change(function() { //
        $("#img0").text("");
        imagePreview0(this); //
        var x0 = document.getElementById("x0");
        x0.style.display = "block";
    });

    function imagePreview0(fileInput) {
        if (fileInput.files && fileInput.files[0]) {
            var fileReader = new FileReader();
            fileReader.onload = function(event) {
                $('#preview0').html('<img src="' + event.target.result + '" width="100%" height="auto"/>');
            };
            fileReader.readAsDataURL(fileInput.files[0]);
        }
    }

    //ảnh 1
    $("#image1").change(function() { //
        $("#img1").text("");
        imagePreview1(this); //
        var x1 = document.getElementById("x1");
        x1.style.display = "block";
    });

    function imagePreview1(fileInput) {
        if (fileInput.files && fileInput.files[0]) {
            var fileReader = new FileReader();
            fileReader.onload = function(event) {
                $('#preview1').html('<img src="' + event.target.result + '" width="100%" height="auto"/>');
            };
            fileReader.readAsDataURL(fileInput.files[0]);
        }
    }

    //ảnh 2
    $("#image2").change(function() { //
        $("#img2").text("");
        imagePreview2(this); //
        var x2 = document.getElementById("x2");
        x2.style.display = "block";
    });

    function imagePreview2(fileInput) {
        if (fileInput.files && fileInput.files[0]) {
            var fileReader = new FileReader();
            fileReader.onload = function(event) {
                $('#preview2').html('<img src="' + event.target.result + '" width="100%" height="auto"/>');
            };
            fileReader.readAsDataURL(fileInput.files[0]);
        }
    }

    //ảnh 3
    $("#image3").change(function() { //
        $("#img3").text("");
        imagePreview3(this); //
        var x3 = document.getElementById("x3");
        x3.style.display = "block";
    });

    function imagePreview3(fileInput) {
        if (fileInput.files && fileInput.files[0]) {
            var fileReader = new FileReader();
            fileReader.onload = function(event) {
                $('#preview3').html('<img src="' + event.target.result + '" width="100%" height="auto"/>');
            };
            fileReader.readAsDataURL(fileInput.files[0]);
        }
    }

    //ảnh 4
    $("#image4").change(function() { //
        $("#img4").text("");
        imagePreview4(this); //
        var x4 = document.getElementById("x4");
        x4.style.display = "block";
    });

    function imagePreview4(fileInput) {
        if (fileInput.files && fileInput.files[0]) {
            var fileReader = new FileReader();
            fileReader.onload = function(event) {
                $('#preview4').html('<img src="' + event.target.result + '" width="100%" height="auto"/>');
            };
            fileReader.readAsDataURL(fileInput.files[0]);
        }
    }

    function checkdelete() {
        return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');
    }

    for (let index = 0; index < <?php echo $count?>; index++) {
        var editID0 = "#edit" + index;
        $(editID0).click(function(e) {
            var modalID = "myModal" + index;
            var modal = document.getElementById(modalID);
            var editID = "edit" + index;
            var btn = document.getElementById(editID);
            console.log(modalID, editID);
            var closeID = "close" + index;
            var span = document.getElementById(closeID);
            modal.style.display = "block";
            span.onclick = function() {
                modal.style.display = "none";
            }
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });


    }

    // Get the modal
    var modal0 = document.getElementById("myModal");
    // Get the button that opens the modal
    var btn0 = document.getElementById("new_size");
    // Get the <span> element that closes the modal
    var span0 = document.getElementsByClassName("close")[0];
    // When the user clicks the button, open the modal 
    btn0.onclick = function() {
        modal0.style.display = "block";
    }
    span0.onclick = function() {
        modal0.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal0) {
            modal0.style.display = "none";
        }
    }
    </script>
    <?php
        // Delete Product by button
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

        // Delete size by icon
        if (isset($_GET['delete_size'])) {
          $delete_size = mysqli_query($con, "DELETE FROM product WHERE ProductID = '$_GET[delete_size]' ");
          if ($delete_size) {
              echo "<script>window.open('edit_product.php?cid=$cid', '_self')</script>";
          }
      }
                  ?>
</body>

</html>

<?php }else {
        echo "<script>window.open(' ../anon/homepage.php', '_self')</script>";
        exit();
    }
    ?>