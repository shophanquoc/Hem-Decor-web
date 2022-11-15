<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng ký</title>
  <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>"></head>
</head>
<body>
  <section>
    <div class="img">
        <img src="../images/background3.jpg">
    </div>
    <div class="content">
      <div class="form">
        <h2>Đăng ký</h2>
        <form action = "registration.php" method = "post">
          <div class="input">
            <span>Tên Đăng Ký</span>
            <input type="text" name="user" placeholder="Nhập Tên Đăng Ký" class = "form-control" required>
          </div>
          <div class="input">
            <span>Mật Khẩu</span>
            <input type="password" id = "pass" name="password" placeholder="Nhập mật khẩu" class = "form-control" required>
          </div>
          <!-- show the password -->
          <input type="checkbox" onclick="myFunction()">Hiện Mật Khẩu
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
          <div class="input">
            <span>Email</span>
            <input type="email" name="email" placeholder="Nhập Email" class = "form-control" required>
          </div>
          <div class="input">
            <span>Số Điện Thoại</span>
            <input type="tel" name="telephone" placeholder="Nhập số điện thoại" class = "form-control" required>
          </div>
          <!-- display error or success message -->
          <?php if (isset($_GET['error'])) { ?>
     		    <p class="error"><?php echo $_GET['error']; ?></p>
     	    <?php } ?>
          <?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>
          <div class="input">
            <input type="submit" value="Đăng Ký">
          </div>
          <div class="input">
            <p><a href="login.php">Quay Lại</a></p>
          </div>
        </form>
      </div>
    </div>
  </section>
</body>
</html>