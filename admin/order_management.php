<?php
$order = "SELECT O.order_id, O.full_name, O.address, O.order_date, O.total_price, O.payment_method, O.status, OI.quantity 
FROM orders O
JOIN order_items OI ON O.order_id = OI.order_id
GROUP BY O.order_id, O.full_name, O.address, O.order_date, O.total_price, O.payment_method, O.status, OI.quantity";
$result = $conn->query($order);
$counter = 1;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $counter . "</td>";
        echo "<td>" . htmlspecialchars($row['order_id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['full_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['order_date']) . "</td>";
        echo "<td>" . htmlspecialchars($row['address']) . "</td>";
        echo "<td>" . htmlspecialchars($row['total_price']) . "</td>";
        echo "<td>" . htmlspecialchars($row['payment_method'] == 1 ? "Tiền mặt" : "Ngân hàng") . "</td>";
        echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
        echo "<td>" . htmlspecialchars($row['status'] == 0 ? "Chưa xác nhận" : "Đã xác nhận") . "</td>";
        echo "<td></td>";
        if ($row['status'] == 0) {
            echo "<td>
                <div style='text-align: center; color: red; cursor:pointer;'>
                    <a href='confirm_order.php?order_id=" . htmlspecialchars($row['order_id']) . "' onclick='return confirm(\"Xác nhận đơn hàng?\");'>
                        <i class='fa-solid fa-check'></i>
                    </a>
                </div>
            </td>";
        } else {
            echo "<td>
                <div style='text-align: center; color: green; cursor: pointer;'>
                    <a href='#' onclick='alert(\"Đơn hàng đã xác nhận\"); return false;'>
                        <i class='fa-solid fa-check'></i>
                    </a>
                </div>
            </td>";
        }
        echo "</tr>";
        $counter++;
    }
} else {
    echo "<tr><td colspan='8'>Không có dữ liệu</td></tr>";
}
?>
