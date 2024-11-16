<?php
include_once("../includes/connect.php");

if (isset($_GET['order_id']) && is_numeric($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']); // Convert order_id to integer for safety

    // Debugging: Print the order_id for verification
    echo "Received order ID: " . $order_id . "<br>";

    // Lấy trạng thái hiện tại của đơn hàng
    $query = "SELECT status FROM orders WHERE order_id = $order_id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $current_status = $row['status'];

        if ($current_status == 1) { // Nếu đơn hàng chưa xác nhận
            $update = "UPDATE orders SET status = 2 WHERE order_id = $order_id";
            if ($conn->query($update) === TRUE) {
                echo "<script>
                    alert('Xác nhận đơn hàng thành công.');
                    window.location.href = 'dashboard.php';
                </script>";
                exit();
            }
        } elseif ($current_status == 2) { // Nếu đơn hàng đã xác nhận, chuyển thành đã giao
            $update = "UPDATE orders SET status = 3 WHERE order_id = $order_id";
            if ($conn->query($update) === TRUE) {
                echo "<script>
                    alert('Đơn hàng đã được giao.');
                    window.location.href = 'dashboard.php';
                </script>";
                exit();
            }
        } else {
            echo "Không thể cập nhật trạng thái.";
        }
    } else {
        echo "Không tìm thấy đơn hàng với ID này.";
    }
}

$conn->close();
?>
