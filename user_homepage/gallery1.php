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
                <h3>Bitter<span>Sweet</span></h3>
            </div>
            <div class="box">
                <div class="dream">
                    <img src="../images/collection/2/22T01324_result.jpg">
                    <img src="../images/collection/2/22T01345_result.jpg">
                    <img src="../images/collection/2/22T01346_result.jpg">
                    <img src="../images/collection/2/22T01351_result.jpg">
                    <img src="../images/collection/2/22T01357_result.jpg">
                    <img src="../images/collection/2/22T01359_result (1).jpg">                                
                    <img src="../images/collection/2/22T01360_result.jpg">
                 </div>

                <div class="dream">
                    <img src="../images/collection/2/22T01364_result.jpg">
                    <img src="../images/collection/2/22T01368_result.jpg">
                    <img src="../images/collection/2/22T01373_result.jpg">
                    <img src="../images/collection/2/T2108406_result.jpg">
                    <img src="../images/collection/2/T2108408_result.jpg">                               
                    <img src="../images/collection/2/T2108410_result.jpg">
                    <img src="../images/collection/2/T2108413_result.jpg">
                    <img src="../images/collection/2/T2108415_result.jpg">
                </div>

                <div class="dream">
                    <img src="../images/collection/2/T2108418_result.jpg">                        
                    <img src="../images/collection/2/T2108420_result.jpg">
                    <img src="../images/collection/2/T2108421_result.jpg">
                    <img src="../images/collection/2/T2108422_result.jpg">
                    <img src="../images/collection/2/T2108423_result.jpg">
                    <img src="../images/collection/2/T2108426_result.jpg">
                    <img src="../images/collection/2/T2108427_result.jpg">
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