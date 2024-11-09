<link rel="stylesheet" href="assets/css/base.css">

<?php
include("includes/connect.php");
$user_id = 0;
if (isset($_POST['confirm'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $total_price = floatval($_POST['total_price']);
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    }

    $sql =
        "INSERT INTO orders (user_id, total_price, email, full_name, phone_number, address, payment_method)
        VALUES ($user_id, $total_price, '$email', '$full_name', '$phone_number', '$address', 1)";
    $insert_order = mysqli_query($conn, $sql);
    if ($insert_order) {
        $sql_delete = "DELETE FROM cart WHERE user_id=$user_id";
        $delete_cart = mysqli_query($conn, $sql_delete);
        $_SESSION['quantity'] = 0;
        header("Location: index.php?act=success");
    } else {
        echo "Lỗi! ";
    }
} else {
    // header("Location: index.php");
}
?>

<div class="main">
    <h2>Đặt hàng thành công, chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất</h2>
</div>