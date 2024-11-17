<?php
ob_start();
session_start();
include_once("includes/connect.php");

if (isset($_SESSION["success_message"])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if (isset($username) && isset($password)) {
        $sql = "SELECT * FROM users where username='$username' AND deleted=0";
        $query = mysqli_query($conn, $sql);
        if (mysqli_num_rows($query) > 0) {
            $user = mysqli_fetch_assoc($query);
            if (password_verify($password, $user["password"])) {
                // Đăng nhập thành công (mật khẩu mã hóa)
                login_success($user);
            } else if ($password === $user["password"]) {
                // Kiểm tra mật khẩu dạng văn bản thuần (tạm thời)
                // Cập nhật mật khẩu thành mã hóa
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                $update_sql = "UPDATE users SET password='$hashed_password' WHERE user_id=" . $user["user_id"];
                mysqli_query($conn, $update_sql);

                // Đăng nhập thành công
                login_success($user);
            } else {
                $message = "Mật khẩu không chính xác";
            }
        } else {
            $message = "Tài khoản không tồn tại";
        }
    }
}
function login_success($user)
{
    session_start();
    $_SESSION["username"] = $user["username"];
    $_SESSION["user_id"] = $user["user_id"];
    $_SESSION["role"] = $user["role"];

    // Chuyển hướng
    if ($user["role"] == "1") {
        header('location: admin/dashboard.php');
    } else {
        header('location: index.php');
    }
    exit;
}

?>
<link rel="stylesheet" href="assets/css/login.css">

<div class="login-container">
    <h2>Đăng Nhập</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="username">Tên đăng nhập</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Mật khẩu</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" name="submit">Đăng Nhập</button>
        <?php
        if (isset($message) && $message != '') {
            echo "<div style='color: red; text-align: center; margin-top:20px'>" . $message . "</div>";
        }
        ?>

    </form>
    <div class="signup-link">
        Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a>
    </div>
</div>