<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng nhập</title>
  <link rel= "stylesheet" type = "text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>"></head>
<body>
  <section>
    <div class="img">
        <img src="../images/background2.jpg">
    </div>
    <div class="content">
      <div class="form">
        <h2>Đăng nhập</h2>
        <form action = "validation.php" method = "post">
          <div class="input">
            <span>Email</span>
            <input type="text" name="eot" placeholder="Nhập Email hoặc Số Điện Thoại" class = "form-control" required>
          </div>
          <div class="input" style="margin-bottom: 10px;">
            <span>Mật khẩu</span>
            <input type = "password" id = "pass" name = "password" placeholder="Nhập Mật Khẩu" class = "form-control" required>
          </div>
            <p><input type="checkbox" onclick="myFunction()">Hiện Mật Khẩu</p>
            <!-- show password -->
              <script>
                function myFunction() {
                  var x = document.getElementById("pass");
                  if (x.type === "password") {
                    x.type = "text";
                  } else {
                    x.type = "password";
                  }
                }
              </script>
              <!-- get error -->
            <?php if (isset($_GET['error'])) { ?>
     		                    <p class="error"><?php echo $_GET['error']; ?></p>
     	                    <?php } ?>
            <div class="input">
              <input type="submit" value="Đăng nhập">
            </div>
          <div class="input">
            <p>Quên mật khẩu? <a href="forget-password.php">Lấy lại mật khẩu</a></p>
          </div>
          <div class="input">
            <p>Chưa có tài khoản? <a href="signup.php">Đăng ký ngay</a></p>
          </div>
        </form>
      </div>
    </div>
  </section>
</body>
</html>