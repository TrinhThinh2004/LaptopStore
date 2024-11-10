<?php
include("includes/connect.php");
$order_id = $_GET['order_id'];
$sql =
    "SELECT L.description, L.price, OI.quantity, MAX(LI.image_url) AS image_url
FROM Laptops L
JOIN Order_Items OI ON L.laptop_id = OI.laptop_id
JOIN Laptop_Images LI ON L.laptop_id = LI.laptop_id
WHERE OI.order_id=$order_id
GROUP BY L.laptop_id, OI.quantity, L.description, L.price";
$result = mysqli_query($conn, $sql);

$sql_total_price = mysqli_query($conn, "SELECT total_price FROM orders WHERE order_id=$order_id");
$result_total_price = mysqli_fetch_array($sql_total_price);
$total_price = $result_total_price['total_price'];
?>
<link rel="stylesheet" href="assets/css/base.css">
<link rel="stylesheet" href="assets/css/order_detail.css">
<div class="main">
    <table>
        <thead>
            <tr>
                <th>Ảnh</th>
                <th>Mô tả Laptop</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($i = mysqli_fetch_array($result)) { ?>
                <tr>
                    <td><img src="<?php echo $i['image_url'] ?>" alt=""></td>
                    <td>
                        <h3><?php echo $i['description'] ?></h3>
                    </td>
                    <td><?php echo $i['quantity'] ?></td>
                    <td><?php echo $i['price'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="cancel-box">
        <h2>Tổng tiền: <span id="total-price"><?php echo number_format($total_price, 0, ',', '.');; ?></span>đ</h2>
        <button type="submit" class="btn" name="canceled" onclick="location.href='index.php?act=cancel&order_id=<?php echo $order_id; ?>'">Hủy</button>
    </div>
</div>