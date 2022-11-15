<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quên mật khẩu</title>
  <link rel= "stylesheet" type = "text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <section>
    <div class="img">
        <img src="../images/background4.jpg">
    </div>
    <div class="content">
      <div class="form">
        <h2>Quên mật khẩu</h2>
        <form action = "send-new.php" method = "post">
          <div class="input">
            <span>Nhập Email</span>
            <input type="email" name="email" placeholder="Nhập Email" class = "form-control" required>
          </div>
          <div class="input">
            <span>Nhập Số Điện Thoại</span>
            <input type="tel" name="telephone" placeholder="Nhập Số Điện Thoại" class = "form-control" required>
          </div>
          <!-- get error -->
          <?php if (isset($_GET['error'])) { ?>
     		    <p class="error"><?php echo $_GET['error']; ?></p>
     	    <?php } ?>
           <!-- get success -->
          <?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>
          <div class="input">
            <input type="submit" value="Lấy lại mật khẩu">
          </div>
        </form>
        <form action = "login.php" method = "post">
          <div class="input">
            <input type="submit" value="Đăng Nhập">
          </div>
        </form>
      </div>
    </div>
  </section>
</body>
</html>
