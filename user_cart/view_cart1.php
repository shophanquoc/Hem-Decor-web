<?php 
session_start ();
if (isset($_SESSION['id'])) { 
include('../database/dbcon.php');
include ('../header_footer/user_header.php');
$id = $_SESSION['id'];
$sql = mysqli_query($con, "SELECT * FROM Cart WHERE AccountID = '$id'");
$row = mysqli_fetch_assoc($sql);
$cartID = $row['CartID'];
?>
<html>

<head>
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/user.css?v=<?php echo time(); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <div class="main">
        <div class="bar">
            <div class="bname">
                <h2><i class="fas fa-shopping-cart"></i> Giỏ Hàng</h2>
            </div>
            <div class="border_bottom"></div>
        </div>
        <div class="my-order_box">
            <table width="100%">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="checkAll" value="" /></th>
                        <th>Sản Phẩm</th>
                        <th>Đơn Giá</th>
                        <th>Số Lượng</th>
                        <th>Thành Tiền</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <?php
                    $sql1 = mysqli_query($con, "SELECT p.CategoryID, ThumbnailImage, p.*, CartID, Quantity FROM Categories c
                    INNER JOIN Product p ON c.CategoryID = p.CategoryID 
                    INNER JOIN Product_Cart pc ON p.ProductID = pc.ProductID
                    WHERE CartID = '$cartID' ORDER BY AddedDate DESC");
                    $num = mysqli_num_rows($sql1);
                    $i = 0;                
                    while ($row1 = mysqli_fetch_assoc($sql1)){
                        $total = $row1['Price']*$row1['Quantity'];
                        //create img path
                        $img =  "../images/product_images/" . $row1['ThumbnailImage'];
                    ?>
                <tbody>
                    <tr>
                        <th class="check"><input type="checkbox" name="choose_all[]" id="check<?php echo $i?>"
                                value="<?php echo $row1['ProductID']; ?>" /></th>
                        <th class="sp">
                            <a href='../user_products/view_product.php?cid=<?php echo $row1['CategoryID']; ?>'>
                                <div class="columna">
                                    <img src="<?php echo $img ?>">
                                </div>
                                <div class="columnb">
                                    <?php echo $row1['ProductName'];
                                if($row1['Size'] != ''){
                                    ?> Size <?php echo $row1['Size'];
                                    }
                                ?>
                                </div>

                            </a>
                        </th>
                        <th><a>
                                <?php echo number_format($row1['Price']);?>
                                <input id="price<?php echo $i?>" class="price" value="<?php echo $row1['Price'];?>"
                                    style="display: none;">
                            </a></th>
                        <th class="cnumber">
                            <span class="minus" id="minus<?php echo $i?>">-</span>
                            <input type="text" id="input<?php echo $i?>" class="input" name="quantity"
                                value="<?php echo $row1["Quantity"]?>" required
                                onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 13" />
                            <span class="plus" id="plus<?php echo $i?>">+</span>
                        </th>
                        <th>
                            <a id="total<?php echo $i?>">
                                <?php echo number_format($total);?>
                            </a>
                        </th>
                        <th><a href="view_cart.php?delete=<?php echo $row1['ProductID']; ?>">
                                <i class="fa fa-trash-o"></i>
                            </a>
                        </th>
                    </tr>
                </tbody>
                <?php $i++;} ?>
            </table>
        </div>
    </div>
    <div class="cbar">
        <div class="box-container">
            <div class="box">
                <span>Tổng sản phẩm: <span id="total-p"> 0 </span> </span>
            </div>

            <div class="box">
                <span>Phí Ship(Mặc định): 30,000</span>
            </div>

            <div class="box">
                <span>Tổng Đơn: <span id="total-o"> 30,000 </span></span>
            </div>
        </div>
        <div class="cbar1">
            <a href="checkout.php"><button type="button" class="checkout">Thanh Toán</button></a>
        </div>
    </div>
    <?php
        if (isset($_GET['delete'])) {
            $delete = mysqli_query($con, "DELETE FROM Product_Cart WHERE ProductID = '$_GET[delete]' ");
            if ($delete) {
                echo "<script>window.open('view_cart.php', '_self')</script>";
            }
        }
        ?>
    <script>
    for (let index = 0; index < <?php echo $num?>; index++) {
        var plusID = "#plus" + index;
        $(plusID).click(function() {
            $(this).prev().val(+$(this).prev().val() + 1);
            var priceID = "#price" + index;
            var inputID = "#input" + index;
            var totalID = "#total" + index;
            var price = parseInt($(priceID).val());
            var input = parseInt($(inputID).val());
            var total = (price * input).toLocaleString('en-US');
            $(totalID).text(total);
        });
    }


    for (let index = 0; index < <?php echo $num?>; index++) {
        var minusID = "#minus" + index;
        $(minusID).click(function() {
            if ($(this).next().val() > 0) $(this).next().val(+$(this).next().val() - 1);
            var priceID = "#price" + index;
            var inputID = "#input" + index;
            var totalID = "#total" + index;
            var price = parseInt($(priceID).val());
            var input = parseInt($(inputID).val());
            var total = (price * input).toLocaleString('en-US');
            $(totalID).text(total);
        });
    }

    // check all the checkbox
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
    for (let index = 0; index < <?php echo $num?>; index++) {
        var checkID = "#check" + index;
        $(checkID).change(function(e) {
            var totalID = "#total" + index;
            var total_p = parseInt($(totalID).text());
            var o_total = parseInt($("#total-p").text());
            var total_p1 = total_p + o_total;
            var total_p2 = parseInt((total_p1 + "000"));
            var total_o = total_p2 + 30000;
            $("#total-p").text((total_p2).toLocaleString('en-US'));
            $("#total-o").text((total_o).toLocaleString('en-US'));
            console.log(total_p, o_total, total_p1);
            e.preventDefault();
        });
    }

    // $("input[type=checkbox]").change(function() {
    //     recalculate();
    // });


    // function recalculate() {
    //     var sum = 0;
    //     $("input[type=checkbox]:checked").each(function() {
    //         var test = $("input[type=checkbox]:checked").attr('id');
    //         console.log(test);
    //     });
    // }
    </script>
</body>

</html>
<?php 
}else{
    echo "<script>window.open('../anon/homepage.php', '_self')</script>";
     exit();
}
 ?>