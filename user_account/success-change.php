<?php
session_start();
session_destroy();
// Display the alert box  
echo "<script>
alert('Đổi Mật Khẩu Thành Công');
window.location.href='../anon/homepage.php';  
</script>";
?>

