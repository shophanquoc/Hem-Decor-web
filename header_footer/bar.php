<?php
include('../database/dbcon.php');
?>
<html?>

    <head>
        <link rel="stylesheet" href="../css/user.css?v=<?php echo time(); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <div class="bar">
            <div class="name">
                <h3>Sản Phẩm</h3>
            </div>
            <top_nav class="top_nav">
                <ul>
                    <li><a  href="../anon/product_page.php">Tất Cả</a></li>
                    <li><a href="../anon/khay.php">Khay</a></li>
                    <li><a href="../anon/thot.php">Thớt</a></li>
                    <li><a href="../anon/khac.php">Khác</a></li>
                    <li class="slide"></li>
                </ul>
                <script src="http://code.jquery.com/jquery-3.3.1.js"></script>
                <script type="text/javascript">
                
                    const activePage = window.location.pathname;
                    const navLinks = document.querySelectorAll('top_nav ul a').forEach(link => {
                        if (link.href.includes(`${activePage}`)) {
                            link.classList.add('active');
                            console.log(link);
                        }
                    })
                </script>
            </top_nav>
            <!-- end / navbar/Tất Cả Khay Thớt Khác -->
            
        


            </html>