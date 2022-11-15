<?php
session_start();
if (isset($_SESSION['id'])) { 
?>
<html>
    <head>
        <title>Bộ Sưu Tập</title>
        <link rel="stylesheet" type="text/css" href="../css/user.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php include '../header_footer/user_header.php'; ?>
        <div class="gallery">
            <div class="name">
                <h3>Ngẫu<span> Hứng</span></h3>
            </div>
            <div class="box">
                <div class="dream">
                    <img src="../images/collection/3/22T01327_result.jpg">
                    <img src="../images/collection/3/22T01339_result.jpg">
                    <img src="../images/collection/3/T2108404_result.jpg">
                    <img src="../images/collection/3/T2108428_result.jpg">
                    <img src="../images/collection/3/T2108429_result.jpg">
                    <img src="../images/collection/3/T2108433_result.jpg">
                </div>

                <div class="dream">
                    <img src="../images/collection/3/T2108460_result.jpg">
                    <img src="../images/collection/3/T2108461_result.jpg">
                    <img src="../images/collection/3/T2108462_result.jpg">
                    <img src="../images/collection/3/T2108619_result.jpg">
                    <img src="../images/collection/3/T2108621_result.jpg">
                    <img src="../images/collection/3/T2108622_result .jpg">
                    <img src="../images/collection/3/T2108625_result.jpg">
                    <img src="../images/collection/3/T2108628_result.jpg">
            </div>

                <div class="dream">
                    <img src="../images/collection/3/T2108631_result.jpg">
                    <img src="../images/collection/3/T2108636_result.jpg">
                    <img src="../images/collection/3/T2108637_result.jpg">
                    <img src="../images/collection/3/T2108640_result.jpg">
                    <img src="../images/collection/3/T2108642_result.jpg">
                    <img src="../images/collection/3/T2108643_result.jpg">
                    <img src="../images/collection/3/T2108645_result.jpg">
                    <img src="../images/collection/3/T2108662_result.jpg">
                </div>
            </div>
        </div>
        <div><?php include '../header_footer/user_footer.php'; ?></div>
    </body>
</html>
<?php 
}else{
    echo "<script>window.open('../anon/homepage.php', '_self')</script>";
     exit();
}
 ?>