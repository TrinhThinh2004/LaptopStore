<?php
if (isset($_SESSION['message'])) {
    echo "<script>alert('" . $_SESSION['message'] . "');</script>";
    unset($_SESSION['message']); // Clear the message after displaying it
}
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql_user = "SELECT * FROM users where user_id = $user_id";
    $result = mysqli_query($conn, $sql_user);
    $user = mysqli_fetch_array($result);

    if (isset($_POST['change_info'])) {
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $address = $_POST['address'];

        $sql_change = "UPDATE users SET full_name='$full_name', email='$email', phone_number='$phone_number', 
        address='$address', updated_at=NOW()
        WHERE user_id=$user_id";
        $result_change = mysqli_query($conn, $sql_change);
        if ($result_change) {
            $_SESSION['message'] = "Cập nhật thông tin thành công!";
        } else {
            $_SESSION['message'] = "Lỗi cập nhật thông tin: " . mysqli_error($conn);
        }
        header("Location: index.php?act=user");
    }
} else header("Location: index.php");


?>

<link rel="stylesheet" href="assets/css/user.css">
<link rel="stylesheet" href="assets/css/base.css">

<div class="main">
    <div class="info-container">
        <div class="content-box">
            <h2>Thông tin người nhận</h2>
            <form method="POST">
                <h3>Họ tên người nhận</h3>
                <input class="info-input" type="text" name="full_name" value="<?php echo $user['full_name'] ?>" required>
                <h3>Email</h3>
                <input class="info-input" type="email" name="email" value="<?php echo $user['email'] ?>" required>
                <h3>Số điện thoại</h3>
                <input class="info-input" type="text" name="phone_number" value="<?php echo $user['phone_number'] ?>" required>
                <h3>Địa chỉ</h3>
                <input class="info-input" type="text" name="address" value="<?php echo $user['address'] ?>" required>
                <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
                <div class="button-box">
                    <button class="btn change-info" name="change_info">Lưu thay đổi</button>
                </div>
            </form>
        </div>
        <div class="content-box last">
            <a href="index.php?act=order">Đơn hàng</a>
            <a href="index.php?act=change_pass">Đổi mật khẩu</a>
            <a class="logout" href="logout.php">Đăng xuất</a>
        </div>
    </div>
</div>