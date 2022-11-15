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
            <h3>Thảnh <span>Thơi</span></h3>
            </div>
            <div class="box">
                <div class="dream">
                    <img src="../images/collection/1/22T01310_result.jpg">
                    <img src="../images/collection/1/22T01315_result.jpg">
                    <img src="../images/collection/1/22T01320_result.jpg">
                    <img src="../images/collection/1/E04 (21).jpg">
                    <img src="../images/collection/1/E04 (30).jpg">
                    <img src="../images/collection/1/E04 (34).jpg">
                    <img src="../images/collection/1/E04.jpg">
                </div>

                <div class="dream">
                    <img src="../images/collection/1/T2106904_result.JPG">
                    <img src="../images/collection/1//T2106906_result (1).JPG">
                    <img src="../images/collection/1/T2106912_result.JPG">
                    <img src="../images/collection/1/T2106914_result.JPG">
                    <img src="../images/collection/1/T2106916_result.JPG">
                    <img src="../images/collection/1/T2106919_result.JPG">
                    <img src="../images/collection/1/T2106921_result.JPG">
                </div>

                <div class="dream">
                    <img src="../images/collection/1/T2106923_result.JPG">
                    <img src="../images/collection/1/T2106924_result.JPG">
                    <img src="../images/collection/1/T2108122_result.JPG">
                    <img src="../images/collection/1/T2108147_result.JPG">
                    <img src="../images/collection/1/T2108149_result.JPG">
                    <img src="../images/collection/1/T2108157_result.JPG">
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