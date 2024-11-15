<?php
include("includes/connect.php");
$m = "Hủy đơn hàng thành công!";
$color = "#155724";
$bgcolor = "#DDFFDD";
$order_id = $_GET['order_id'];
$result_status = mysqli_query($conn, "SELECT status FROM orders WHERE order_id=$order_id");
$row = mysqli_fetch_assoc($result_status);
$status = $row['status'];
if ($status == 1) {
    $delete_item = mysqli_query($conn, "UPDATE orders SET status=4 WHERE order_id=$order_id");
} else {
    $m = "Không thể hủy, đơn hàng đang được giao đến bạn!";
    $color = "#721c24";
    $bgcolor = "#f8d7da";
}
?>
<link rel="stylesheet" href="assets/css/base.css">
<style>
    .cancel-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .cancel-text {
        margin-top: 50px;
        padding: 20px;
        width: 60%;
        text-align: center;
        background-color: <?php echo $bgcolor ?>;
        border-radius: 20px;
    }

    .cancel-text h2 {
        padding: 0;
        color: <?php echo $color ?>
    }
</style>

<div class="main">
    <div class="cancel-container">
        <div class="cancel-text">
            <h2><?php echo $m; ?></h2>
        </div>
    </div>
</div>