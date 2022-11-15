<?php
include('../database/dbcon.php');
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <script src="https://kit.fontawesome.com/1147679ae7.js" crossrigin="" anonymous></script>
        <link rel="stylesheet" href="../css/user.css?v=<?php echo time(); ?>">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    </head>

    <body>

        <header>

            <a  href = "../user_homepage/user_homepage.php"><img class="logo" src="../images/hem_logo_circle_yellow.png" alt="logo"></a> 
            <a  href = "../user_homepage/user_homepage.php" class = "web_name" style="font-size:3vw;">Hẻm Decor</a>

            <a class="search-form">
                <input type="search" name="keyword" placeholder="Tìm Kiếm" id="search-box" required>
                <i class="fas fa-search" id = "search"></i>
            </a>

            <script>
                $("#search").click(function () { 
                    var keyword = $("#search-box").val();
                    window.location = "../user_products/search.php?keyword=" + keyword;
                });
                
            </script>
            <input type="checkbox" name="" id="toggler">
            <label for="toggler" class="fas fa-bars"></label>


            <nav class="navbar">
                <ul>
                    <li> <a href="../user_homepage/user_homepage.php">Trang Chủ</a></li>
                    <li> <a href="../user_products/product_page.php">Cửa Hàng</a></li>
                    <li> <a href="../user_homepage/about_us.php">Giới Thiệu</a></li>
                    <li><a class="cta" href="#contact">Liên hệ</a></li>
                </ul>
            </nav>
            

            <div class="icons">
                <a href="../user_cart/view_cart.php" class="fas fa-shopping-cart">
                </a>
                <div class = "dropdown"><a class="fas fa-user"></a>
                    <div class="dropdown-content">
                        <a href="../user_orders/my-order.php">Đơn Của Tôi</a>
                        <a href="../user_account/change-password.php">Đổi Mật Khẩu</a>
                        <a href="../user_account/logout.php">Đăng Xuất</a>
                    </div>
                </div>
            </div>

        </header>
    </body>
</html>