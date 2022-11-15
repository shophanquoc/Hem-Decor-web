<?php
session_start();
if (isset($_SESSION['id'])) {
include('../database/dbcon.php');
include '../header_footer/admin_header.php';
?>

<!doctype html>
<html>

<head>
    <title>Thêm Sản Phẩm</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



</head>


<body>
    <div class=main><?php include '../header_footer/admin_toggle.php'; ?>
        <div class="info-box">
            <h1> <u>Thêm mới sản phẩm</u></h1>
            <br>
            <br>
            <div class="content">
                <!-- allow to upload file -->
                <form action="" method="POST" role="form" enctype="multipart/form-data">
                    <h2>Thông tin cơ bản</h2>
                    <div class="panel-body">

                        <!-- ảnh bìa -->
                        <div class="form-group">
                            <p style="padding-bottom: 10px;">
                                <span class="" style="display:inline;">Ảnh Bìa</span> <span
                                    style="color:red; display:inline;">*</span>
                            </p>
                            <br>
                            <label for="image0"> Chọn ảnh bìa</label>
                            <a onclick="delImage(0)">&times;</a>
                            <input type="file" name="image0" id="image0">
                            <div id="preview0"></div>
                        </div>
                        <!-- ảnh mô tả -->
                        <br>

                        <div class="form-group">
                            <span class="image_detail">Ảnh Mô Tả</span>

                            <div class="table_image">

                                <table class="preview-img">
                                    <tr>
                                        <th><label for="image1">Ảnh 1</label> <input type="file" name="image1"
                                                id="image1"><span onclick="delImage(1)">&times;</span></th>
                                        <th><label for="image2">Ảnh 2</label> <input type="file" name="image2"
                                                id="image2"><span onclick="delImage(2)">&times;</span></th>
                                        <th><label for="image3">Ảnh 3</label> <input type="file" name="image3"
                                                id="image3"><span onclick="delImage(3)">&times;</span> </th>
                                        <th><label for="image4">Ảnh 4</label> <input type="file" name="image4"
                                                id="image4"><span onclick="delImage(4)">&times;</span> </th>
                                    </tr>


                                    <tr>
                                        <td>
                                            <div id="preview1" class="col"></div>
                                        </td>

                                        <td>
                                            <div id="preview2" class="col"></div>
                                        </td>
                                        <td>
                                            <div id="preview3" class="col"></div>
                                        </td>
                                        <td>
                                            <div id="preview4" class="col"></div>
                                        </td>

                                    </tr>
                                </table>
                                <p><img id="output" width="200" /></p>
                            </div>

                        </div>
                        <div class="form-group">
                            <p style="padding-bottom: 10px;">
                                <span class="" style="display:inline;">Tên Sản Phẩm</span> <span
                                    style="color:red; display:inline;">*</span>
                            </p>
                            <input type="text" name="nameC" id="" placeholder="VD: Khay Chữ Nhật " required>
                        </div>
                        <div class="form-group">
                            <p style="padding-bottom: 10px;">
                                <span class="" style="display:inline;">Mã Phân Loại</span> <span
                                    style="color:red; display:inline;">*</span>
                            </p>
                            <input type="text" name="codeC" placeholder="VD: K/C01" required>
                        </div>
                        <div class="form-group">
                            <span class="" style="display:inline;">Chất Liệu</span>
                            <input type="text" name="material" placeholder="VD: Keo">
                        </div>
                        <div class="form-group">
                            <span class="">Mô Tả</span>
                            <textarea name="desc" placeholder=""></textarea>
                        </div>
                        <div id="error">
                            <?php //display error message
                            if (isset($_GET['error'])) { ?>
                            <p class="error"><?php echo $_GET['error']; ?></p>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value="Tiếp" class="save">
                        </div>
                    </div>

                </form>
                <form action="manage_category.php">
                    <div class="form-group1">
                        <input type="submit" name="cancel" value="Hủy" class="cncl">
                    </div>
                </form>
                <script>
                function imagePreview0(fileInput) {
                    if (fileInput.files && fileInput.files[0]) {
                        var fileReader = new FileReader();
                        fileReader.onload = function(event) {
                            $('#preview0').html('<img src="' + event.target.result +
                                '" width="30%" height="auto"/>');
                        };
                        fileReader.readAsDataURL(fileInput.files[0]); //


                    }
                }
                $("#image0").change(function() { //
                    imagePreview0(this); //
                });

                function imagePreview1(fileInput) {
                    if (fileInput.files && fileInput.files[0]) {
                        var fileReader = new FileReader();
                        fileReader.onload = function(event) {
                            $('#preview1').html('<img src="' + event.target.result +
                                '" width="100%" height="auto"/>');
                        };
                        fileReader.readAsDataURL(fileInput.files[0]);
                    }
                }
                $("#image1").change(function() {
                    imagePreview1(this);
                });

                function imagePreview2(fileInput) {
                    if (fileInput.files && fileInput.files[0]) {
                        var fileReader = new FileReader();
                        fileReader.onload = function(event) {
                            $('#preview2').html('<img src="' + event.target.result +
                                '" width="100%" height="auto"/>');
                        };
                        fileReader.readAsDataURL(fileInput.files[0]);
                    }
                }
                $("#image2").change(function() {
                    imagePreview2(this);
                });

                function imagePreview3(fileInput) {
                    if (fileInput.files && fileInput.files[0]) {
                        var fileReader = new FileReader();
                        fileReader.onload = function(event) {
                            $('#preview3').html('<img src="' + event.target.result +
                                '" width="100%" height="auto"/>');
                        };
                        fileReader.readAsDataURL(fileInput.files[0]);
                    }
                }
                $("#image3").change(function() {
                    imagePreview3(this);
                });

                function imagePreview4(fileInput) {
                    if (fileInput.files && fileInput.files[0]) {
                        var fileReader = new FileReader();
                        fileReader.onload = function(event) {
                            $('#preview4').html('<img src="' + event.target.result +
                                '" width="100%" height="auto"/>');
                        };
                        fileReader.readAsDataURL(fileInput.files[0]);
                    }
                }
                $("#image4").change(function() {
                    imagePreview4(this);
                });
                //delete image function
                const delImage = (i) => {
                    const image = document.getElementById(`image${i}`);
                    image.value = "";
                    const preview = document.getElementById(`preview${i}`);
                    preview.innerHTML = "";
                }
                </script>

                <?php
                // if the "Tiếp" button is pressed
                if (isset($_POST['submit'])) {
                    //initialise the variable
                    $nameC = ucwords($_POST['nameC']);
                    $codeC = $_POST['codeC'];
                    $material = ucwords($_POST['material']);
                    $desc = $_POST['desc'];
                    $checkC = "SELECT * FROM categories WHERE CategoryID = '$codeC'";
                    //Perform query against the database
                    $resultC = mysqli_query($con, $checkC);
                    //count number of row that appear from the previous query
                    $num = mysqli_num_rows($resultC);
                    // 1.Upload the image if selected
                    // Check whether the select image is clicked or not and upload the image only if the image is selected
                    if (isset($_FILES['image0']['name'])) {
                        $image_name = $_FILES['image0']['name'];
                        //check if the img name is not null
                        if ($image_name != "") {
                            // A.Rename the image
                            //take the image name and image type before and after the dot
                            $exp = explode('.', $image_name);
                            //keep the img type
                            $ext = end($exp);
                            $strlow = strtolower($ext);
                            // Create new name for image
                            if ($strlow == 'jpg' || $strlow == 'png' || $strlow == 'jpeg') {
                                $image_name = "hem0-" . rand(00000, 99999) . "." . $strlow;
                                // B.Upload the image
                                // Get the source path and destination path
                                // Source path is the current location of the image
                                $src = $_FILES['image0']['tmp_name'];
                                // Destination path for the image to be uploaded
                                $dst = "../images/product_images/" . $image_name;
                                //put image in the located folder
                                $upload = move_uploaded_file($src, $dst);
                                // Check whether image is uploaded or not
                                if ($upload == false) {
                                    echo "<script> window.location.href = 'add_basic.php?error=Upload Không Thành Công';</script>";
                                    exit();
                                }
                            } else {
                                echo "<script> window.location.href = 'add_basic.php?error=Ảnh Phải Có Đuôi .jpg, .png Hoặc .jpeg';</script>";
                                exit();
                            }
                        }
                    }
                    if (isset($_FILES['image1']['name'])) {
                        $image_name1 = $_FILES['image1']['name'];
                        if ($image_name1 != "") {
                            $exp1 = explode('.', $image_name1);
                            $ext1 = end($exp1);
                            $strlow1 = strtolower($ext1);
                            if ($strlow1 == 'jpg' || $strlow1 == 'png' || $strlow1 == 'jpeg') {
                                $image_name1 = "hem1-" . rand(00000, 99999) . "." . $strlow1;
                                $src1 = $_FILES['image1']['tmp_name'];
                                $dst1 = "../images/product_images/" . $image_name1;
                                $upload1 = move_uploaded_file($src1, $dst1);
                                if ($upload1 == false) {
                                    echo "<script> window.location.href = 'add_basic.php?error=Upload Không Thành Công';</script>";
                                    exit();
                                }
                            } else {
                                echo "<script> window.location.href = 'add_basic.php?error=Ảnh Phải Có Đuôi .jpg, .png Hoặc .jpeg';</script>";
                                exit();
                            }
                        }
                    }

                    if (isset($_FILES['image2']['name'])) {
                        $image_name2 = $_FILES['image2']['name'];
                        if ($image_name2 != "") {
                            $exp2 = explode('.', $image_name2);
                            $ext2 = end($exp2);
                            $strlow2 = strtolower($ext2);
                            if ($strlow2 == 'jpg' || $strlow2 == 'png' || $strlow2 == 'jpeg') {
                                $image_name2 = "hem2-" . rand(00000, 99999) . "." . $strlow2;
                                $src2 = $_FILES['image2']['tmp_name'];
                                $dst2 = "../images/product_images/" . $image_name2;
                                $upload2 = move_uploaded_file($src2, $dst2);
                                if ($upload2 == false) {
                                    echo "<script> window.location.href = 'add_basic.php?error=Upload Không Thành Công';</script>";
                                    exit();
                                }
                            } else {
                                echo "<script> window.location.href = 'add_basic.php?error=Ảnh Phải Có Đuôi .jpg, .png Hoặc .jpeg';</script>";
                                exit();
                            }
                        }
                    }
                    if (isset($_FILES['image3']['name'])) {
                        $image_name3 = $_FILES['image3']['name'];
                        if ($image_name3 != "") {
                            $exp3 = explode('.', $image_name3);
                            $ext3 = end($exp3);
                            $strlow3 = strtolower($ext3);
                            if ($strlow3 == 'jpg' || $strlow3 == 'png' || $strlow3 == 'jpeg') {
                                $image_name3 = "hem3-" . rand(00000, 99999) . "." . $strlow3;
                                $src3 = $_FILES['image3']['tmp_name'];
                                $dst3 = "../images/product_images/" . $image_name3;
                                $upload3 = move_uploaded_file($src3, $dst3);
                                if ($upload3 == false) {
                                    echo "<script> window.location.href = 'add_basic.php?error=Upload Không Thành Công';</script>";
                                    exit();
                                }
                            } else {
                                echo "<script> window.location.href = 'add_basic.php?error=Ảnh Phải Có Đuôi .jpg, .png Hoặc .jpeg';</script>";
                                exit();
                            }
                        }
                    }
                    if (isset($_FILES['image4']['name'])) {
                        $image_name4 = $_FILES['image4']['name'];
                        if ($image_name4 != "") {
                            $exp4 = explode('.', $image_name4);
                            $ext4 = end($exp4);
                            $strlow4 = strtolower($ext4);
                            if ($strlow4 == 'jpg' || $strlow4 == 'png' || $strlow4 == 'jpeg') {
                                $image_name4 = "hem4-" . rand(00000, 99999) . "." . $strlow4;
                                $src4 = $_FILES['image4']['tmp_name'];
                                $dst4 = "../images/product_images/" . $image_name4;
                                $upload4 = move_uploaded_file($src4, $dst4);
                                if ($upload4 == false) {
                                    echo "<script> window.location.href = 'add_basic.php?error=Upload Không Thành Công';</script>";
                                    exit();
                                }
                            } else {
                                echo "<script> window.location.href = 'add_basic.php?error=Ảnh Phải Có Đuôi .jpg, .png Hoặc .jpeg';</script>";
                                exit();
                            }
                        }
                    } //check product info
                    //check if the thumbnail image is selected or not
                    if($image_name == ""){
                        echo "<script> window.location.href = 'add_basic.php?error=Chưa Thêm Ảnh Bìa';</script>";
                        exit();
                    }//check category id length
                    elseif (strlen($codeC) > 10) {
                        echo "<script> window.location.href = 'add_basic.php?error=Mã Phân Loại Không Được Vượt Quá 10 Ký Tự';</script>";
                        exit();
                    } //check product name length
                    elseif (strlen($nameC) > 200) {
                        echo "<script> window.location.href = 'add_basic.php?error=Tên Sản Phẩm Quá Dài';</script>";
                        exit();
                    } //check if the categoryID is duplicate or not
                    elseif ($num == 1) {
                        echo "<script> window.location.href = 'add_basic.php?error=Mã Phân Loại Đã Tồn Tại';</script>";
                        exit();
                    } // check material content length
                    elseif (strlen($material) > 50) {
                        echo "<script> window.location.href = 'add_basic.php?error=Chất Liệu: Nội Dung Được Nhập Quá Dài';</script>";
                        exit();
                    } //check description content length
                    elseif (strlen($desc) > 5000) {
                        echo "<script> window.location.href = 'add_basic.php?error=Mô Tả: Nội Dung Được Nhập Quá Dài';</script>";
                        exit();
                    } else {
                        //Insert into database
                        $sql1 = "INSERT INTO categories( CategoryID, CategoryName, ThumbnailImage, AddPic1, AddPic2, AddPic3, AddPic4, Material, `Description`)
                                        VALUES ('$codeC', '$nameC ', '$image_name', '$image_name1', '$image_name2', '$image_name3', '$image_name4', '$material', '$desc')";
                        $query1 = mysqli_query($con, $sql1);
                        if ($query1) {
                            $sql2 = "SELECT * FROM categories WHERE CategoryID = '$codeC'";
                            $result = mysqli_query($con, $sql2);
                            //take the result
                            $row = mysqli_fetch_assoc($result);
                            //set session variable value to use later
                            $_SESSION['cateID'] = $row["CategoryID"];
                            //redirect to the add_details window
                            echo "<script> window.location.href = 'add_details.php';</script>";
                        }
                    }
                }
                ?>
            </div>
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