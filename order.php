<?php
include("includes/connect.php");
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM orders WHERE user_id = $user_id";
$order_result = mysqli_query($conn, $sql);
?>

<link rel="stylesheet" href="assets/css/base.css">
<div class="main">
    <table>
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Tổng tiền</th>
                <th>Ngày đặt</th>
                <th>Hình thức thanh toán</th>
                <th>Trạng thái</th>
                <th>Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($o = mysqli_fetch_array($order_result)) { ?>
                <tr>
                    <td><?php echo $o['order_id']; ?></td>
                    <td><?php echo $o['total_price']; ?></td>
                    <td><?php echo $o['order_date']; ?></td>
                    <td><?php if ($o['payment_method'] == 1) echo "Tiền mặt";
                        else echo "Ngân hàng" ?></td>
                    <td><?php
                        if ($o['status'] == 1) echo "Đang chờ xác nhận";
                        elseif ($o['status'] == 2) echo "Đang giao";
                        elseif ($o['status'] == 3) echo "Đã giao thành công";
                        else echo "Đã hủy" ?></td>
                    <td><a href="index.php?act=order_detail&order_id=<?php echo $o['order_id']; ?>">Chi tiết</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>