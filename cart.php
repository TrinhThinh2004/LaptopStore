<?php
ob_start();
include_once("includes/connect.php");


if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_sql = "DELETE FROM Cart WHERE cart_id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
 
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);
    $price = floatval($_POST['price']);
    $user_id = 1; 

   
    $check_sql = "SELECT * FROM Cart WHERE laptop_id = $product_id AND user_id = $user_id";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        
        $update_sql = "UPDATE Cart SET quantity = quantity + 1 WHERE laptop_id = $product_id AND user_id = $user_id";
        $conn->query($update_sql);
    } else {
      
        $insert_sql = "INSERT INTO Cart (user_id, laptop_id, quantity, price, created_at) 
                       VALUES ($user_id, $product_id, 1, $price, NOW())"; 
        $conn->query($insert_sql);
    }
}



$sql =
"SELECT c.cart_id, c.user_id, c.quantity, c.price, c.created_at, 
       l.laptop_id, l.description, l.price AS laptop_price
FROM Cart c
JOIN Laptops l ON c.laptop_id = l.laptop_id
ORDER BY c.cart_id DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/admin/cart.css">
</head>

<body>
    <div class="main">
        <table>
            <thead>
                <tr>
                    <th>ID Cart</th>
                    <th>ID Người dùng</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thêm vào lúc</th>
                    <th>Mô tả Laptop</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["cart_id"] . "</td>";
                        echo "<td>" . $row["user_id"] . "</td>";
                        echo "<td>" . $row["quantity"] . "</td>";
                        echo "<td>" . number_format($row["price"], 0, ',', '.') . " VND</td>"; 
                        echo "<td>" . date("H:i d/m/Y", strtotime($row["created_at"])) . "</td>"; 
                        echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
                        echo "<td><a href='?delete_id=" . $row["cart_id"] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa không?\");'>Xóa</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Không có sản phẩm trong giỏ hàng.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>