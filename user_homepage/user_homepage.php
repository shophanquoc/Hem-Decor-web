<?php
session_start();
if (isset($_SESSION['id'])) { 
?>

<!DOCTYPE html>
<html lang="en">
<html>
    <head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HemDecor </title>

        <!-- font  cdn link  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <script src="https://kit.fontawesome.com/1147679ae7.js" crossrigin="" anonymous></script>
        <link rel="stylesheet" href="../css/user.css?v=<?php echo time(); ?>">
    </head>
    <body>
        <?php include '../header_footer/user_header.php'; ?>    
        <div class = "bg"><img src="../images/homepage/uhome_bg.jpg" class="background"></div>
        <div class="heading"> Giới Thiệu </div>

        <section class = "about" id = "about">
            <div class = "container">
                <div class = "row align-items-center">
                    <div class = "col=md-6 image">
                        <img src = "../images/homepage/intro.jpg" class = "intro_bg">
                    </div>
                    <div class = "col-md-6 content">
                    <p>Hiện nay để tiếp cận gần với khách hàng các nhà hàng không chỉ chú trọng về không gian 
                    nội thất mà còn đặc biệt quan tâm đồ decor. Món ăn không chỉ cần ngon mà còn phải trông 
                    thật đẹp mắt!
                    <br>Một không gian đẹp, một món ăn được decor có chất riêng, sẽ là sự thu hút đầu tiên đối
                        với nhiều đối tượng khách hàng, từ bạn trẻ cho đến nhân viên văn phòng.</p>
                    <p>Hẻm decor chuyên cung cấp và sản xuất:
                        <br>- Khay Thớt gỗ trang trí, bày đồ ăn, đựng hoa quả, khay trà.
                        <br>- Nội thất gỗ decor, kệ gỗ trang trí, hộp rượu gỗ, hộp quà 
                        tết, hộp gỗ đựng giấy,trang trí.
                    </p>
                    <a href = "about_us.php" ><div class = "more">Xem Tiếp</div></a>
                    </div>
                </div>
            </div>
        </section>
        
        <div class="heading"> Sản Phẩm </div>
        <section class = "product">
            <div class = "row">
                <div class = "column">
                    <a href = "../user_products/khay.php"><img src = "../images/homepage/khay.png" class ="cate" width = "400" height = "400"></a>
                    <div class = des>Khay</div>
                </div>
                <div class = "column">
                    <a href = "../user_products/thot.php"><img src = "../images/homepage/thớt.png" class ="cate" width = "400" height = "400"></a>
                    <div class = des>Thớt</div>
                </div>
                <div class = "column">
                    <a href = "../user_products/khac.php"><img src = "../images/homepage/khác.png" class ="cate" width = "400" height = "400"></a>
                    <div class = des>Khác</div>
                </div>
            </div>        
        </section>   
        
        <div class="heading"> Bộ Sưu Tập </div>
        <section class = "collection">
            <div class = "row">
                <div class = "column column1">
                    <img src = "../images/homepage/promo1.jpg" class ="promo" width = "400" height = auto>
                    <div class = "middle">
                        <a href = "gallery1.php"><div class = "text">Xem Ngay</div></a>
                    </div>
                    <div class = des>BitterSweet</div>
                </div>
                <div class = "column column2">
                    <img src = "../images/homepage/promo2.jpg" class ="promo" width = "400" height = auto>
                    <div class = "middle">
                        <a href = "gallery2.php"><div class = "text">Xem Ngay</div></a>
                    </div>
                    <div class = des>Thảnh Thơi</div>
                </div>
                <div class = "column column3">
                    <img src = "../images/homepage/promo3.jpg" class ="promo" width = "400" height = auto>
                    <div class = "middle">
                        <a href = "gallery3.php"><div class = "text">Xem Ngay</div></a>
                    </div>
                    <div class = des>Ngẫu Hứng</div>
                </div>
                <div class = "column column4">
                    <img src = "../images/homepage/promo4.jpg" class ="promo" width = "400" height = auto>
                    <div class = "middle">
                        <a href = "gallery4.php"><div class = "text">Xem Ngay</div></a>
                    </div>
                    <div class = des>Thanh Đạm</div>
                </div>
            </div>        
        </section>
        
        <div class="heading"> Khách Hàng </div>
        <section class = "customer">
        <div class = "slider">
            <div class = "slide-track">
                <a href = https://www.facebook.com/Charm-Coffee-102747151727440>
                <div class = "slide">
                    <img src = '../images/customer/charm.jpg'>
                    <div class = "cus-name">Charm Coffee</div>
                </div></a>
                <a href = https://www.facebook.com/CiaraTerraceCafeTk>
                <div class = "slide">
                    <img src = '../images/customer/ciara.jpg'>
                    <div class = "cus-name">Ciara Coffee</div>
                </div></a>
                <a href = https://www.facebook.com/daydreamer.coffee>
                <div class = "slide">
                    <img src = '../images/customer/daydreamer.jpg'>
                    <div class = "cus-name">Daydreamer Coffee</div>
                </div></a>
                <a href = https://www.facebook.com/wearegenzcoffee>
                <div class = "slide">
                    <img src = '../images/customer/genz.jpg'>
                    <div class = "cus-name">Gen Z Coffee</div>
                </div></a>
                <a href = https://www.facebook.com/Hanacoffee.Phuquoc>
                <div class = "slide">
                    <img src = '../images/customer/hana.jpg'>
                    <div class = "cus-name">Hana Coffee</div>
                </div></a>
                <a href = https://www.facebook.com/homiecoffee2vuthanh>
                <div class = "slide">
                    <img src = '../images/customer/homie.jpg'>
                    <div class = "cus-name">Homie Coffee</div>
                </div></a>
                <a href = https://www.facebook.com/maycaphee>
                <div class = "slide">
                    <img src = '../images/customer/may.jpg'>
                    <div class = "cus-name">Mây Coffee</div>
                </div></a>
                <a href = https://www.facebook.com/vnmemocafe>
                <div class = "slide">
                    <img src = '../images/customer/memo.jpg'>
                    <div class = "cus-name">Memo Coffee</div>
                </div></a>
                <a href = https://www.facebook.com/SavoorMaiHacDe>
                <div class = "slide">
                    <img src = '../images/customer/panini.jpg'>
                    <div class = "cus-name">SAVOOR <br>The House of Panini</div>
                </div></a>
                <a href = https://www.facebook.com/SiiiCoffee>
                <div class = "slide">
                    <img src = '../images/customer/sii.jpg'>
                    <div class = "cus-name">Sii Coffee</div>
                </div></a>
                <a href = https://www.facebook.com/tiemcafethang5.phukhe.tuson>
                <div class = "slide">
                    <img src = '../images/customer/t5.jpg'>
                    <div class = "cus-name">Tiệm Cà Phê Tháng 5</div>
                </div></a>
                <a href = https://www.facebook.com/tach.spaces>
                <div class = "slide">
                    <img src = '../images/customer/tach.jpg'>
                    <div class = "cus-name">Tách Spaces</div>
                </div></a>
                <a href = https://www.facebook.com/Tamkycafe2016>
                <div class = "slide">
                    <img src = '../images/customer/tamky.jpg'>
                    <div class = "cus-name">Tam Kỳ Cafe</div>
                </div></a>
                <a href = https://www.facebook.com/Thuong.Drinksoflove>
                <div class = "slide">
                    <img src = '../images/customer/thuong.jpg'>
                    <div class = "cus-name">Thương <br>Drinks of Love</div>
                </div></a>
                <a href = https://www.facebook.com/trillgroup>
                <div class = "slide">
                    <img src = '../images/customer/trill.jpg'>
                    <div class = "cus-name">Trill Rooftop Cafe</div>
                </div></a>
                <a href = https://www.facebook.com/UrbanHygge>
                <div class = "slide">
                    <img src = '../images/customer/urban.jpg'>
                    <div class = "cus-name">Urban Hygge Coffee</div>
                </div></a>

                <!--DOUBLE-->

                <a href = https://www.facebook.com/Charm-Coffee-102747151727440>
                <div class = "slide">
                    <img src = '../images/customer/charm.jpg'>
                    <div class = "cus-name">Charm Coffee</div>
                </div></a>
                <a href = https://www.facebook.com/CiaraTerraceCafeTk>
                <div class = "slide">
                    <img src = '../images/customer/ciara.jpg'>
                    <div class = "cus-name">Ciara Coffee</div>
                </div></a>
                <a href = https://www.facebook.com/daydreamer.coffee>
                <div class = "slide">
                    <img src = '../images/customer/daydreamer.jpg'>
                    <div class = "cus-name">Daydreamer Coffee</div>
                </div></a>
                <a href = https://www.facebook.com/wearegenzcoffee>
                <div class = "slide">
                    <img src = '../images/customer/genz.jpg'>
                    <div class = "cus-name">Gen Z Coffee</div>
                </div></a>
                <a href = https://www.facebook.com/Hanacoffee.Phuquoc>
                <div class = "slide">
                    <img src = '../images/customer/hana.jpg'>
                    <div class = "cus-name">Hana Coffee</div>
                </div></a>
                <a href = https://www.facebook.com/homiecoffee2vuthanh>
                <div class = "slide">
                    <img src = '../images/customer/homie.jpg'>
                    <div class = "cus-name">Homie Coffee</div>
                </div></a>
                <a href = https://www.facebook.com/maycaphee>
                <div class = "slide">
                    <img src = '../images/customer/may.jpg'>
                    <div class = "cus-name">Mây Coffee</div>
                </div></a>
                <a href = https://www.facebook.com/vnmemocafe>
                <div class = "slide">
                    <img src = '../images/customer/memo.jpg'>
                    <div class = "cus-name">Memo Coffee</div>
                </div></a>
                <a href = https://www.facebook.com/SavoorMaiHacDe>
                <div class = "slide">
                    <img src = '../images/customer/panini.jpg'>
                    <div class = "cus-name">SAVOOR <br>The House of Panini</div>
                </div></a>
                <a href = https://www.facebook.com/SiiiCoffee>
                <div class = "slide">
                    <img src = '../images/customer/sii.jpg'>
                    <div class = "cus-name">Sii Coffee</div>
                </div></a>
                <a href = https://www.facebook.com/tiemcafethang5.phukhe.tuson>
                <div class = "slide">
                    <img src = '../images/customer/t5.jpg'>
                    <div class = "cus-name">Tiệm Cà Phê Tháng 5</div>
                </div></a>
                <a href = https://www.facebook.com/tach.spaces>
                <div class = "slide">
                    <img src = '../images/customer/tach.jpg'>
                    <div class = "cus-name">Tách Spaces</div>
                </div></a>
                <a href = https://www.facebook.com/Tamkycafe2016>
                <div class = "slide">
                    <img src = '../images/customer/tamky.jpg'>
                    <div class = "cus-name">Tam Kỳ Cafe</div>
                </div></a>
                <a href = https://www.facebook.com/Thuong.Drinksoflove>
                <div class = "slide">
                    <img src = '../images/customer/thuong.jpg'>
                    <div class = "cus-name">Thương <br>Drinks of Love</div>
                </div></a>
                <a href = https://www.facebook.com/trillgroup>
                <div class = "slide">
                    <img src = '../images/customer/trill.jpg'>
                    <div class = "cus-name">Trill Rooftop Cafe</div>
                </div></a>
                <a href = https://www.facebook.com/UrbanHygge>
                <div class = "slide">
                    <img src = '../images/customer/urban.jpg'>
                    <div class = "cus-name">Urban Hygge Coffee</div>
                </div></a>
            </div>
        </div>
        </section>

        <div><?php include '../header_footer/user_footer.php'; ?></div>
    </body>
</html>
<?php 
}else{
    echo "<script>window.open('../anon/homepage.php', '_self')</script>";
     exit();
}
 ?>