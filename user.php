<?php
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql_user = "SELECT * FROM users where user_id = $user_id";
    $result = mysqli_query($conn, $sql_user);
    $user = mysqli_fetch_array($result);
} else header("Location: index.php");
?>

<link rel="stylesheet" href="assets/css/user.css">
<link rel="stylesheet" href="assets/css/base.css">

<div class="main">
    <div class="info-container">
        <div class="content-box">
            <h2>Thông tin người nhận</h2>
            <h3>Họ tên người nhận</h3>
            <input class="info-input" type="text" name="full_name" value="<?php echo $user['full_name'] ?>" required>
            <h3>Email</h3>
            <input class="info-input" type="email" name="email" value="<?php echo $user['email'] ?>" required>
            <h3>Số điện thoại</h3>
            <input class="info-input" type="text" name="phone_number" value="<?php echo $user['phone_number'] ?>" required>
            <h3>Địa chỉ</h3>
            <input class="info-input" type="text" name="address" value="<?php echo $user['address'] ?>" required>
            <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
        </div>
        <div class="content-box last">
            <a href="index.php?act=order">Đơn hàng</a>
            <a href="logout.php">Đăng xuất</a>
        </div>
    </div>
</div>