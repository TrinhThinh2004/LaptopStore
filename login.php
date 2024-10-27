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
        $sql = "SELECT * FROM users where username='$username' AND password='$password'";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_num_rows($query);
        if ($row > 0) {
            $user = mysqli_fetch_assoc($query);
            $_SESSION["username"] = $username;
            $_SESSION["role"] = $user["role"];
            if ($user["role"] == "1") {
                header('location: admin/dashboard.php');
            } else {
                header('location: index.php');
            }
            exit;
        } else {
            $message = "Tài khoản không tồn tại";
        }
    }
}
?>
    <link rel="stylesheet" href="assets/css/login.css">

    <!-- <?php
    if (isset($_POST[$success_message]) && $success_message != '') {
        echo "<div style='color: green; text-align: center;'>$success_message</div>";
    }
    ?> -->
    <div class="login-container">
        Vô admin:
        username: admin, password: admin <br>
        Vô user:
        username: user1, password: user1
        username: user2, password: user2

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
