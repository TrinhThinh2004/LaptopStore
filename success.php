<link rel="stylesheet" href="assets/css/base.css">
<link rel="stylesheet" href="assets/css/success.css">

<?php
include("includes/connect.php");

if (isset($_POST['confirm'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $total_price = floatval($_POST['total_price']);

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        $sql_add_user = "INSERT INTO users (full_name, email, phone_number, address)
        VALUES ('$full_name', '$email', '$phone_number', '$address')";
        $add_user = mysqli_query($conn, $sql_add_user);
        if ($add_user) {
            $user_id = mysqli_insert_id($conn);
        }
        header("Location: index.php?act=success");
    }

    $sql =
        "INSERT INTO orders (user_id, total_price, email, full_name, phone_number, address, payment_method)
        VALUES ($user_id, $total_price, '$email', '$full_name', '$phone_number', '$address', 1)";
    $insert_order = mysqli_query($conn, $sql);

    $order_id = 0;
    if ($insert_order) {
        $order_id = mysqli_insert_id($conn);

        if (!isset($_SESSION['laptop_id'])) {
            $sql_cart = "SELECT laptop_id, quantity FROM Cart WHERE user_id = $user_id";
            $result_cart = mysqli_query($conn, $sql_cart);
            if ($result_cart) {
                while ($row = mysqli_fetch_assoc($result_cart)) {
                    $laptop_id = $row['laptop_id'];
                    $quantity = $row['quantity'];

                    // Câu lệnh chèn vào bảng Order_Items
                    $sql_order_item = "INSERT INTO order_items (order_id, laptop_id, quantity)
                                   VALUES ($order_id, $laptop_id, $quantity)";
                    $insert_order_item = mysqli_query($conn, $sql_order_item);

                    if (!$insert_order_item) {
                        echo "Lỗi khi thêm vào Order_Items: " . mysqli_error($conn);
                    }
                }
            }
        } else {
            $laptop_id = $_SESSION['laptop_id'];
            // Câu lệnh chèn vào bảng Order_Items
            $sql_order_item = "INSERT INTO order_items (order_id, laptop_id, quantity)
            VALUES ($order_id, $laptop_id, 1)";
            $insert_order_item = mysqli_query($conn, $sql_order_item);

            if (!$insert_order_item) {
                echo "Lỗi khi thêm vào Order_Items: " . mysqli_error($conn);
            }
            unset($_SESSION['laptop_id']);
        }

        $sql_delete = "DELETE FROM cart WHERE user_id=$user_id";
        $delete_cart = mysqli_query($conn, $sql_delete);
        $_SESSION['quantity'] = 0;
        header("Location: index.php?act=success");
    } else {
        echo "Lỗi! ";
    }
}
?>
<style>
    .success-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .success-text {
        margin-top: 50px;
        padding: 40px;
        width: 100%;
        text-align: center;
        background-color: #DDFFDD;
        border-radius: 20px;
    }

    .success-text h2 {
        padding: 0;
    }
</style>

<div class="main">
    <div class="success-container">
        <div class="success-text">
            <h2>Đặt hàng thành công, chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất</h2>
        </div>
    </div>
</div>