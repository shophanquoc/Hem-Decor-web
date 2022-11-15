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

        <a href="../anon/homepage.php"><img class="logo" src="../images/hem_logo_circle_yellow.png"
                alt="logo"></a>
        <a href="../anon/homepage.php" class="web_name" style="font-size:3vw;">Hẻm Decor</a>

        <a class="search-form">
            <input type="search" name="keyword" placeholder="Tìm Kiếm" id="search-box" required>
            <i class="fas fa-search" id="search"></i>
        </a>

        <script>
        $("#search").click(function() {
            var keyword = $("#search-box").val();
            window.location = "../anon/search.php?keyword=" + keyword;
        });
        </script>
        <input type="checkbox" name="" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>


        <nav class="navbar">
            <ul>
                <li> <a href="../anon/homepage.php">Trang Chủ</a></li>
                <li> <a href="../anon/product_page.php">Cửa Hàng</a></li>
                <li> <a href="../anon/about_us.php">Giới Thiệu</a></li>
                <li><a class="cta" href="#contact">Liên hệ</a></li>
                <li><a href="../user_account/login.php" >Đăng Nhập</a></li>
            </ul>
        </nav>
    </header>
</body>

</html>