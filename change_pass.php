<?php
include("includes/connect.php");

if (isset($_SESSION['message'])) {
    echo "<script>alert('" . $_SESSION['message'] . "');</script>";
    unset($_SESSION['message']); // Clear the message after displaying it
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header("Location: index.php");
}

if (isset($_POST['change_pass'])) {
    $username = $_POST['username'];
    $old_pass = $_POST['old_pass'];
    $new_pass = $_POST['new_pass'];

    $sql = "SELECT username, password FROM users WHERE user_id=$user_id";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result);

    if ($user && $user['username'] === $username) {
        // Kiểm tra mật khẩu cũ
        if (password_verify($old_pass, $user['password'])) {
            // Mã hóa mật khẩu mới
            $hashed_new_pass = password_hash($new_pass, PASSWORD_BCRYPT);

            // Cập nhật mật khẩu mới
            $sql_change = "UPDATE users SET password='$hashed_new_pass', updated_at=NOW() WHERE user_id=$user_id";
            $result_change = mysqli_query($conn, $sql_change);

            if ($result_change) {
                $_SESSION['message'] = "Đổi mật khẩu thành công!";
            } else {
                $_SESSION['message'] = "Lỗi đổi mật khẩu: " . mysqli_error($conn);
            }
        } else {
            $_SESSION['message'] = "Mật khẩu cũ không chính xác!";
        }
    } else {
        $_SESSION['message'] = "Tên đăng nhập không chính xác!";
    }
    header("Location: index.php?act=change_pass");
    exit();
}
?>

<link rel="stylesheet" href="assets/css/change_pass.css">
<link rel="stylesheet" href="assets/css/base.css">

<div class="main">
    <div class="change-pass-container">
        <h2 class="title-change">Đổi mật khẩu</h2>
        <form method="POST">
            <label for="username">Tên đăng nhập</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Nhâp mật khẩu cũ</label>
            <input type="password" id="password" name="old_pass" required>

            <label for="password">Nhập mật khẩu mới</label>
            <input type="password" id="password" name="new_pass" required>

            <div class="submit-box">
                <button type="submit" name="change_pass" class="btn">Thay đổi</button>
            </div>
        </form>
    </div>
</div>