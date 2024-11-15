<link rel="stylesheet" href="assets/css/base.css">
<link rel="stylesheet" href="assets/css/success.css">

<?php
include("includes/connect.php");
include("includes/stock_quantity.php");
$m = isset($_SESSION['message']) ? $_SESSION['message'] : "Không có thông báo nào";
$bgcolor = isset($_SESSION['bgcolor']) ? $_SESSION['bgcolor'] : "#DDFFDD";
$color = isset($_SESSION['color']) ? $_SESSION['color'] : "#155724";
unset($_SESSION['message'], $_SESSION['bgcolor'], $_SESSION['color']);

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
            // Bước 1: Lấy danh sách sản phẩm trong giỏ hàng
            $sql_cart = "SELECT laptop_id, quantity FROM Cart WHERE user_id = $user_id";
            $result_cart = mysqli_query($conn, $sql_cart);

            $stock_sufficient = true; // Biến kiểm tra tồn kho

            // Bước 2: Kiểm tra tồn kho cho tất cả sản phẩm
            if ($result_cart) {
                while ($row = mysqli_fetch_assoc($result_cart)) {
                    $laptop_id = $row['laptop_id'];
                    $quantity = $row['quantity'];

                    // Kiểm tra tồn kho từng sản phẩm
                    if (!check_stock($laptop_id, $quantity)) {
                        $stock_sufficient = false;
                        $_SESSION['message'] = "Không đủ hàng trong kho cho sản phẩm ID: $laptop_id";
                        $_SESSION['bgcolor'] = "#f8d7da";
                        $_SESSION['color'] = "#721c24";
                        break; // Ngưng kiểm tra nếu có sản phẩm không đủ tồn kho
                    }
                }
            }

            // Bước 3: Nếu đủ tồn kho, thực hiện tạo đơn hàng và thêm sản phẩm
            if ($stock_sufficient) {
                // Tạo đơn hàng
                $sql = "INSERT INTO orders (user_id, total_price, email, full_name, phone_number, address, payment_method)
                        VALUES ($user_id, $total_price, '$email', '$full_name', '$phone_number', '$address', 1)";
                $insert_order = mysqli_query($conn, $sql);

                if ($insert_order) {
                    $order_id = mysqli_insert_id($conn);

                    // Thêm từng sản phẩm vào order_items
                    mysqli_data_seek($result_cart, 0); // Đặt lại con trỏ kết quả
                    while ($row = mysqli_fetch_assoc($result_cart)) {
                        $laptop_id = $row['laptop_id'];
                        $quantity = $row['quantity'];

                        $sql_order_item = "INSERT INTO order_items (order_id, laptop_id, quantity)
                                           VALUES ($order_id, $laptop_id, $quantity)";
                        $insert_order_item = mysqli_query($conn, $sql_order_item);

                        if (!$insert_order_item) {
                            echo "Lỗi khi thêm vào Order_Items: " . mysqli_error($conn);
                        }
                    }

                    // Đặt hàng thành công
                    $_SESSION['message'] = "Đặt hàng thành công, chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất";
                    $_SESSION['bgcolor'] = "#DDFFDD";
                    $_SESSION['color'] = "#155724";
                }
            }
        } else {
            $laptop_id = $_SESSION['laptop_id'];
            // Câu lệnh chèn vào bảng Order_Items
            if (check_stock($laptop_id, 1)) {
                $sql_order_item = "INSERT INTO order_items (order_id, laptop_id, quantity)
                                   VALUES ($order_id, $laptop_id, 1)";
                $insert_order_item = mysqli_query($conn, $sql_order_item);
                $_SESSION['message'] = "Đặt hàng thành công, chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất";
                $_SESSION['bgcolor'] = "#DDFFDD";
                $_SESSION['color'] = "#155724";
                if (!$insert_order_item) {
                    echo "Lỗi khi thêm vào Order_Items: " . mysqli_error($conn);
                }
                unset($_SESSION['laptop_id']);
            } else {
                $sql_del_order = "DELETE FROM orders WHERE order_id=$order_id";
                mysqli_query($conn, $sql_del_order);
                $_SESSION['message'] = "Không đủ hàng trong kho cho sản phẩm ID: $laptop_id";
                $_SESSION['bgcolor'] = "#f8d7da";
                $_SESSION['color'] = "#721c24";
            }
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
        background-color: <?php echo $bgcolor; ?>;
        border-radius: 20px;
    }

    .success-text h2 {
        padding: 0;
        color: <?php echo $color; ?>;
    }
</style>

<div class="main">
    <div class="success-container">
        <div class="success-text">
            <h2><?php echo $m; ?></h2>
        </div>
    </div>
</div>