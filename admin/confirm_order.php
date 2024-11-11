<?php
include_once("../includes/connect.php");

if (isset($_GET['order_id']) && is_numeric($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']); // Convert order_id to integer for safety

    // Debugging: Print the order_id for verification
    echo "Received order ID: " . $order_id . "<br>";

    $update = "UPDATE orders SET status = 1 WHERE order_id = $order_id";
    if ($conn->query($update) === TRUE) {
        echo "<script>
            alert('Xác nhận đơn hàng thành công.');
            window.location.href = 'dashboard.php';
        </script>";
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
