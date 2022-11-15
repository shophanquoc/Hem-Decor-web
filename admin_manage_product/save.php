<?php
session_start ();
include('../database/dbcon.php');
$cid = $_SESSION['cid'] ;
if ($_GET['action'] == 'edit') {
    $pro_details = "SELECT * FROM categories WHERE CategoryID = '$cid'";
    $sql = mysqli_query($con, $pro_details);             
    $row = mysqli_fetch_assoc($sql);

    //create img path
    $img0 =  "../images/product_images/" . $row['ThumbnailImage'];
    $img1 =  "../images/product_images/" . $row['AddPic1'];
    $img2 =  "../images/product_images/" . $row['AddPic2'];
    $img3 =  "../images/product_images/" . $row['AddPic3'];
    $img4 =  "../images/product_images/" . $row['AddPic4'];


    $cname = $_POST['cname'];
    $cateid = $_POST['cateid'];
    $material = $_POST['material'];
    $desc = $_POST['desc'];
    $desc = $_POST['desc'];
    $check = mysqli_query($con, "SELECT * FROM categories WHERE CategoryID = '$cateid'");
    $num = mysqli_num_rows($check);

    if (isset($_FILES['image0']['name'])) {
        $image_name = $_FILES['image0']['name'];
        if ($image_name != "") {
            gc_collect_cycles();
            unlink($img0);
            $exp = explode('.', $image_name);
            $ext = end($exp);
            $strlow = strtolower($ext);
            $image_name = "hem0-" . rand(00000, 99999) . "." . $strlow;
            $src = $_FILES['image0']['tmp_name'];
            $dst = "../images/product_images/" . $image_name;
            $upload = move_uploaded_file($src, $dst);
            if ($upload == false) {
                echo "<script> window.location.href = 'edit_product.php?cid=$cid&error=Upload Không Thành Công';</script>";
                exit();
            }
        }else{
        $image_name = $row['ThumbnailImage'];
    }
    } 
    if (isset($_FILES['image1']['name'])) {
        $image_name1 = $_FILES['image1']['name'];
        if ($image_name1 != "") {
            gc_collect_cycles();
            unlink($img1);
            $exp1 = explode('.', $image_name1);
            $ext1 = end($exp1);
            $strlow1 = strtolower($ext1);
            $image_name1 = "hem1-" . rand(00000, 99999) . "." . $strlow1;
            $src1 = $_FILES['image1']['tmp_name'];
            $dst1 = "../images/product_images/" . $image_name1;
            $upload1 = move_uploaded_file($src1, $dst1);
            if ($upload1 == false) {
                echo "<script> window.location.href = 'edit_product.php?cid=$cid&error=Upload Không Thành Công';</script>";
                exit();
            }
        }else{
        $image_name1 = $row['AddPic1'];
    }
    }

    if (isset($_FILES['image2']['name'])) {
        $image_name2 = $_FILES['image2']['name'];
        if ($image_name2 != "") {
            gc_collect_cycles();
            unlink($img2);
            $exp2 = explode('.', $image_name2);
            $ext2 = end($exp2);
            $strlow2 = strtolower($ext2);
            $image_name2 = "hem2-" . rand(00000, 99999) . "." . $strlow2;
            $src2 = $_FILES['image2']['tmp_name'];
            $dst2 = "../images/product_images/" . $image_name2;
            $upload2 = move_uploaded_file($src2, $dst2);
            if ($upload2 == false) {
                echo "<script> window.location.href = 'edit_product.php?cid=$cid&error=Upload Không Thành Công';</script>";
                exit();
            }
        }else{
        $image_name2 = $row['AddPic2'];
    }
    }
    if (isset($_FILES['image3']['name'])) {
        $image_name3 = $_FILES['image3']['name'];
        if ($image_name3 != "") {
            gc_collect_cycles();
            unlink($img3);
            $exp3 = explode('.', $image_name3);
            $ext3 = end($exp3);
            $strlow3 = strtolower($ext3);
            $image_name3 = "hem3-" . rand(00000, 99999) . "." . $strlow3;
            $src3 = $_FILES['image3']['tmp_name'];
            $dst3 = "../images/product_images/" . $image_name3;
            $upload3 = move_uploaded_file($src3, $dst3);
            if ($upload3 == false) {
                echo "<script> window.location.href = 'edit_product.php?cid=$cid&error=Upload Không Thành Công';</script>";
                exit();
            }
        }else{
        $image_name3 = $row['AddPic3'];
    }
    }
    if (isset($_FILES['image4']['name'])) {
        $image_name4 = $_FILES['image4']['name'];
        if ($image_name4 != "") {
            gc_collect_cycles();
            unlink($img4);

            $exp4 = explode('.', $image_name4);
            $ext4 = end($exp4);
            $strlow4 = strtolower($ext4);
            $image_name4 = "hem4-" . rand(00000, 99999) . "." . $strlow4;
            $src4 = $_FILES['image4']['tmp_name'];
            $dst4 = "../images/product_images/" . $image_name4;
            $upload4 = move_uploaded_file($src4, $dst4);
            if ($upload4 == false) {
                echo "<script> window.location.href = 'edit_product.php?cid=$cid&error=Upload Không Thành Công';</script>";
                exit();
            }
        }else{
        $image_name4 = $row['AddPic4'];
    }
    } 
    if (strlen($cateid) > 10) {
        echo "<script> window.location.href = 'edit_product.php?cid=$cid&error=Mã Phân Loại Không Được Vượt Quá 10 Ký Tự';</script>";
        exit();
    } //check product name length
    elseif (strlen($cname) > 200) {
        echo "<script> window.location.href = 'edit_product.php?cid=$cid&error=Tên Sản Phẩm Quá Dài';</script>";
        exit();
    } //check if the categoryID is duplicate or not
    elseif ($num == 1 && $cateid != $cid) {
        echo "<script> window.location.href = 'edit_product.php?cid=$cid&error=Mã Phân Loại Đã Tồn Tại';</script>";
        exit();
    } // check material content length
    elseif (strlen($material) > 50) {
        echo "<script> window.location.href = 'edit_product.php?cid=$cid&error=Chất Liệu: Nội Dung Được Nhập Quá Dài';</script>";
        exit();
    } //check description content length
    elseif (strlen($desc) > 5000) {
        echo "<script> window.location.href = 'edit_product.php?cid=$cid&error=Mô Tả: Nội Dung Được Nhập Quá Dài';</script>";
        exit();
    } elseif($num == 0 || $cateid == $cid) {
        //Insert into database
        $sql1 = mysqli_query($con, "UPDATE categories
                SET CategoryID = '$cateid', CategoryName = '$cname', ThumbnailImage = '$image_name', 
                AddPic1 = '$image_name1', AddPic2 = '$image_name2', AddPic3 = '$image_name3', AddPic4 = '$image_name4', 
                Material = '$material', `Description` = '$desc' WHERE CategoryID = '$cid'") ;
        $sql2 = mysqli_query($con, "UPDATE product SET ProductName = concat(concat('$cname',' Gỗ '), '$material') WHERE CategoryID = '$cateid'");
        if ($sql1 && $sql2) {
            $result = mysqli_query($con, "SELECT * FROM categories WHERE CategoryID = '$cateid'");
            $row = mysqli_fetch_assoc($result);
            $catid = $row['CategoryID'];
            echo "<script> alert('Chỉnh sửa thành công');
            window.location.href = 'product-detail.php?cid=$catid';</script>";
        }
    }
}elseif($_GET['action'] == 'new'){
    //initialise variable
    $proid = $_POST['proid'];
    $size = $_POST['size'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $find = mysqli_query($con, "SELECT * FROM product WHERE CategoryID = '$cid' LIMIT 1");
    $row = mysqli_fetch_array($find);
    $pname = $row['ProductName'];
    $check = mysqli_query($con, "SELECT * FROM product WHERE CategoryID = '$cid' AND ProductID = '$proid'");
    $num = mysqli_num_rows($check);
    if ($num == 0) {
        mysqli_query($con,"INSERT INTO Product (CategoryID, ProductID, ProductName, Size, Price, ProductQuantity) 
                            VALUES ('$cid', '$proid', '$pname', '$size', '$price', '$quantity')");
        echo "<script> alert('Thêm thành công');
        window.location.href = 'edit_product.php?cid=$cid';</script>';</script>";
        exit();
    } elseif ($num == 1) {
        echo "<script> alert('Mã sản phẩm đã tồn tại!!');
        window.location.href = 'edit_product.php?cid=$cid';</script>";
        exit();
    }
} elseif ($_GET['action'] == 'edit-size') {
    //initialise variable
    $pid = $_GET['pid'];
    $proid = $_POST['proid'];
    $size = $_POST['size'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $check = mysqli_query($con, "SELECT * FROM product WHERE CategoryID = '$cid' AND ProductID = '$proid'");
    $num = mysqli_num_rows($check);
    if ($num == 0 || $proid == $pid) {
        $update = mysqli_query($con, "UPDATE product SET ProductID = '$proid', Size = '$size', Price = '$price', ProductQuantity = '$quantity'
                                WHERE ProductID = '$pid';");
        echo "<script> alert('Chỉnh sửa thành công');
        window.location.href = 'edit_product.php?cid=$cid';</script>";
        exit();
    } elseif ($num == 1) {
        echo "<script> alert('Mã sản phẩm đã tồn tại!!');
        window.location.href = 'edit_product.php?cid=$cid';</script>";
        exit();
    }
} 
?>