<?php
session_start();
if (isset($_SESSION['id'])) {
include('../database/dbcon.php');
include '../header_footer/admin_header.php';

//get the session variable value
$cID = $_SESSION['cateID'];
//find the info of the category that has been previously saved
$cate = "SELECT * FROM categories WHERE CategoryID = '$cID'";
//Perform query against the database
$result = mysqli_query($con, $cate);
//count number of row that appear from the previous query
$num = mysqli_num_rows($result);
//take the result
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Thêm Sản Phẩm</title>
        <meta charset = "utf-8">
        <meta http-equiv = "X-UA-Compatible" content = "IE=edge,chrome=1">
        <meta name = "viewport" content = "width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel = "stylesheet" href = "../css/admin.css?v=<?php echo time(); ?>">
        <script src = "https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        <script src = "https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity = "sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <div class = "main"><?php include '../header_footer/admin_toggle.php'; ?>
            <div class="info-box">
                <div class="content">
                    <!-- allow to upload file -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <h2>Thông Tin Chi Tiết</h2>
                        <div class="panel-body">
                            <?php //display error message
                                if (isset($_GET['error'])) { ?>
                                    <p class="error"><?php echo $_GET['error']; ?></p>
                            <?php } ?>                            
                            <div class="form-group">
                            <p style="padding-bottom: 10px;">
                                <span class="" style="display:inline;">Mã Sản Phẩm</span> <span style="color:red; display:inline;">*</span>
                            </p>
                                <input type="text" name="codeP" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <span class=""> Size</span>
                                <input type="text" name="size" placeholder="" >
                            </div>
                            <div class="form-group">
                            <p style="padding-bottom: 10px;">
                                <span class="" style="display:inline;">Số Lượng</span> <span style="color:red; display:inline;">*</span>
                            </p>
                                <input type="number" name="quantity" placeholder="" required>
                            </div>
                            <div class="form-group">
                            <p style="padding-bottom: 10px;">
                                <span class="" style="display:inline;">Giá</span> <span style="color:red; display:inline;">*</span>
                            </p>
                                <input type="number" name="price" placeholder="" required></input>
                            </div>
                            <!-- add more size -->
                            <div class = "form-group">
                                <input type="submit" name="new_size" value="Thêm Size" class="btn-secondary">
                            </div>
                            <!-- save -->
                            <div class="form-group">
                                <input type="submit" name="submit" value="Lưu" class="btn-secondary">
                            </div>
                        </div>
                    </form>
                    <form action="" method = "post">                        
                        <div class = "form-group1">
                            <input type="submit" name="cancel" value="Hủy" class="cncl">
                        </div>
                    </form>
                    <?php
                    //if the "Lưu" button is pressed
                    if(isset($_POST['submit'])){

                        //initialise the variable       
                        $codeP = $_POST['codeP'];
                        $size = $_POST['size'];
                        $quantity = $_POST['quantity'];
                        $price = $_POST['price'];

                        //find the info of the category that has been previously saved
                        $pro = "SELECT * FROM product WHERE ProductID = '$codeP'";
                        //Perform query against the database
                        $result1 = mysqli_query($con, $pro);
                        //count number of row that appear from the previous query
                        $num1 = mysqli_num_rows($result1);

                        //set the variable's value to the value in the database      
                        $nameC = $row["CategoryName"];
                        $codeC = $row["CategoryID"];
                        $material = $row["Material"]; 
                        
                        //check product info
                        //check category id length
                        if(strlen($codeP) > 10){
                            echo "<script> window.location.href = 'add_details.php?error=Mã Sản Phẩm Không Được Vượt Quá 10 Ký Tự';</script>";
                            exit();
                        } //check if the categoryID is duplicate or not
                        elseif($num1 == 1){
                            echo "<script> window.location.href = 'add_details.php?error=Mã Sản Phẩm Đã Tồn Tại';</script>";
                            exit();
                        } //check size content length
                        elseif(strlen($size) > 10){
                            echo "<script> window.location.href = 'add_details.php?error=Size: Nội Dung Không Hợp Lệ';</script>";
                            exit();
                        }//check if the quantity is valid or not 
                        elseif (!preg_match('/^[0-9]+$/', $quantity) || $quantity > 4294967295) {
                            echo "<script> window.location.href = 'add_details.php?error=Số Lượng: Nội Dung Không Hợp Lệ';</script>";
                            exit();
                        } //check if the price is valid or not
                        elseif (strlen($price) > 10 || !preg_match('/^[0-9]+$/', $price) || $price > 4294967295) {
                            echo "<script> window.location.href = 'add_details.php?error=Giá: Nội Dung Không Hợp Lệ';</script>";
                            exit();
                        } //insert into database
                        else{
                            $sql2 = "INSERT INTO product (CategoryID, ProductID, ProductName, Size, Price, ProductQuantity)
                            VALUES ('$codeC', '$codeP', concat(concat('$nameC','Gỗ '), '$material'), '$size', '$price', '$quantity')";
                            $query2 = mysqli_query($con, $sql2);
                            echo "<script> alert('Sản Phẩm Đã Được Thêm');
                            window.location.href = 'manage_category.php';</script>";
                        }
                        
                    }//if the "Thêm Size" button is pressed
                    elseif(isset($_POST['new_size'])){
                        //initialise the variable       
                        $codeP = $_POST['codeP'];
                        $size = $_POST['size'];
                        $quantity = $_POST['quantity'];
                        $price = $_POST['price'];

                        //find the info of the category that has been previously saved
                        $pro = "SELECT * FROM product WHERE ProductID = '$codeP'";
                        //Perform query against the database
                        $result1 = mysqli_query($con, $pro);
                        //count number of row that appear from the previous query
                        $num1 = mysqli_num_rows($result1);

                        //set the variable's value to the value in the database      
                        $nameC = $row["CategoryName"];
                        $codeC = $row["CategoryID"];
                        $material = $row["Material"]; 
                        
                        //check product info
                        //check category id length
                        if(strlen($codeP) > 10){
                            echo "<script> window.location.href = 'add_details.php?error=Mã Sản Phẩm Không Được Vượt Quá 10 Ký Tự';</script>";
                            exit();
                        } //check if the categoryID is duplicate or not
                        elseif($num1 == 1){
                            echo "<script> window.location.href = 'add_details.php?error=Mã Sản Phẩm Đã Tồn Tại';</script>";
                            exit();
                        } //check size content length
                        elseif(strlen($size) > 10){
                            echo "<script> window.location.href = 'add_details.php?error=Size: Nội Dung Không Hợp Lệ';</script>";
                            exit();
                        }//check if the quantity is valid or not 
                        elseif (!preg_match('/^[0-9]+$/', $quantity) || $quantity > 4294967295) {
                            echo "<script> window.location.href = 'add_details.php?error=Số Lượng: Nội Dung Không Hợp Lệ';</script>";
                            exit();
                        } //check if the price is valid or not
                        elseif (strlen($price) > 10 || !preg_match('/^[0-9]+$/', $price) || $price > 4294967295) {
                            echo "<script> window.location.href = 'add_details.php?error=Giá: Nội Dung Không Hợp Lệ';</script>";
                            exit();
                        } //insert into database
                        else{
                            $sql3 = "INSERT INTO product (CategoryID, ProductID, ProductName, Size, Price, ProductQuantity)
                            VALUES ('$codeC', '$codeP', concat(concat('$nameC','Gỗ '), '$material'), '$size', '$price', '$quantity')";
                            $query3 = mysqli_query($con, $sql3);
                            echo "<script> window.location.href = 'add_details.php';</script>";
                        }
                    }//stop adding product
                    elseif(isset($_POST['cancel'])){

                        //delete image from folder
                        $img = $row['ThumbnailImage'];
                        //create delete path
                        $crd = "../images/product_images/".$img;
                        //delete img
                        unlink($crd);

                        $img1 = $row['AddPic1'];
                        $crd1 = "../images/product_images/".$img1;
                        unlink($crd1);

                        $img2 = $row['AddPic2'];
                        $crd2 = "../images/product_images/".$img2;
                        unlink($crd2);

                        $img3 = $row['AddPic3'];
                        $crd3 = "../images/product_images/".$img3;
                        unlink($crd3);

                        $img4 = $row['AddPic4'];
                        $crd4 = "../images/product_images/".$img4;
                        unlink($crd4);
                        
                        //delete category from database
                        $dlt = "DELETE FROM categories WHERE CategoryID = '$cID'";
                        $dlt_cate = mysqli_query($con, $dlt);
                        echo "<script> window.location.href = 'manage_category.php';</script>";
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