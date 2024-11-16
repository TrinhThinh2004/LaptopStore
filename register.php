<?php
session_start();
include('includes/connect.php');

$message = '';
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        $message = 'Mật khẩu xác nhận không khớp';
    } else {
        $check_user = "SELECT * FROM users WHERE username = '$username' OR email ='$email'";
        $result = mysqli_query($conn, $check_user);

        if (mysqli_num_rows($result) > 0) {
            $message = 'Tên đăng nhập hoặc email đã tồn tại';
        } else {
            $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['success_message'] = 'Đăng ký thành công, vui lòng đăng nhập';
                header('location: login.php');
            } else {
                $message = 'Đã có lỗi xảy ra, vui lòng thử lại';
            }
        }
    }
}
?>
<link rel="stylesheet" href="assets/css/register.css">
<script src="assets/js/validation.js"></script>

<div class="signup-container">
    <h2>Đăng Ký</h2>
    <form method="POST" id="register-form">
        <label for="username">Tên đăng nhập</label>
        <input type="text" id="username" name="username" autocomplete="username">
        <span style="color:red" id="username_error"></span>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" autocomplete="email">
        <span style="color:red" id="email_error"></span>

        <label for="password">Mật khẩu</label>
        <input type="password" id="password" name="password" autocomplete="new-password">
        <span style="color:red" id="password_error"></span>

        <label for="confirm-password">Xác nhận mật khẩu</label>
        <input type="password" id="confirm_password" name="confirm_password" autocomplete="new-password">
        <span style="color:red" id="confirm_password_error"></span>

        <button type="submit" name="submit">Đăng Ký</button>

        <?php
        if (isset($message) && $message != '') {
            echo "<div style='color: red; text-align: center; margin-top:20px'>" . $message . "</div>";
        }
        ?>
    </form>
    <div class="login-link">
        Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a>
    </div>
</div>