<?php
require_once("../../db/db_connect.php");

session_start(); // Nếu cần lưu session đăng nhập
$conn = connectDB();
// Kiểm tra kết nối
if ($conn->connect_error) {
  die("Kết nối thất bại: " . $conn->connect_error);
}

//Xử lý khi form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["username"];
  $password = $_POST["password"];

  // Kiểm tra email + password + phải role admin
  $sql = "select u.* from user u
            join role r on r.role_id = u.role_id
            where u.username = '$name' and u.password = '$password'
            and r.name = 'Admin' and u.deleted = 0";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $_SESSION['user'] = $user;
    header("Location: ../../dashboard.php");
    exit();
  } else {
    echo "<script>alert('Sai tài khoản, mật khẩu hoặc không phải Admin');</script>";
  }
}

?>
<!-- HTML bắt đầu từ đây -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login form</title>
  <link rel="stylesheet" href="./styleLogin.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <div class="wrapper">
    <!-- Form Đăng Nhập -->
    <form id="login-form" method="post">
      <div class="title-container">
        <img src="./assets/image/logo3-1_c3b09821363e4795a6b69889ec9c244f.webp" alt="Logo" class="logo">
        <h1 class="login-title">Đăng nhập</h1>
      </div>

      <div class="input-box">
        <input type="text" name="username" id="login-username" placeholder="Tài khoản" required>
        <i class='bx bx-user'></i>
      </div>

      <div class="input-box">
        <input type="password" name="password" id="login-password" placeholder="Mật khẩu" required>
        <i class='bx bxs-lock-alt'></i>
      </div>

      <div class="remember-forgot">
        <label><input type="checkbox"> Ghi nhớ đăng nhập</label>
        <a href="#">Quên mật khẩu?</a>
      </div>

      <button type="submit" class="btn">Đăng nhập</button>

    </form>
  </div>
</body>
</html>

