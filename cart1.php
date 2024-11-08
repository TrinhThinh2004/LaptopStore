<?php
ob_start();
include("includes/connect.php");

if (!$_SESSION['username'] && !$_SESSION['user_id']) {
    header('location: login.php');
    exit;
}
$user_id = $_SESSION['user_id'];

$sql = "SELECT L.laptop_id, L.brand, L.model, L.description, L.price, C.quantity, 
    MAX(I.image_url) AS image_url, C.created_at
    FROM Cart C
    JOIN Laptops L ON C.laptop_id = L.laptop_id
    LEFT JOIN Laptop_Images I ON L.laptop_id = I.laptop_id
    WHERE C.user_id = '$user_id'
    GROUP BY L.laptop_id, L.brand, L.model, L.description, L.price, C.quantity";

$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);

if (isset($_POST['action']) && $_POST['action'] == 'update_quantity') {
    $laptop_id = $_POST['laptop_id'];
    $quantity = $_POST['quantity'];
    $update_query = "UPDATE Cart SET quantity = $quantity WHERE user_id = $user_id AND laptop_id = $laptop_id";
    if (mysqli_query($conn, $update_query)) {
        // Recalculate the total price after updating quantity
        $total_query = "SELECT SUM(L.price * C.quantity) AS total_price 
                        FROM Cart C 
                        JOIN Laptops L ON C.laptop_id = L.laptop_id 
                        WHERE C.user_id = $user_id";
        $result_total = mysqli_query($conn, $total_query);
        $row_total = mysqli_fetch_assoc($result_total);
        $total_price = $row_total['total_price'];

        // Return success response with new total price
        echo json_encode([
            'success' => true,
            'total_price' => $total_price
        ]);
    } else {
        echo json_encode(['success' => false]);
    }
    exit; // End script here for AJAX requests
}

if (isset($_GET['remove_id'])) {
    $user_id = $_SESSION['user_id'];
    $laptop_id = $_GET['remove_id'];

    $delete_query = "DELETE FROM Cart WHERE user_id = $user_id AND laptop_id = $laptop_id";
    mysqli_query($conn, $delete_query);

    $count_query = "SELECT COUNT(DISTINCT laptop_id) as unique_products FROM Cart WHERE user_id = $user_id";
    $result_count = mysqli_query($conn, $count_query);
    $row_count = mysqli_fetch_assoc($result_count);
    $_SESSION['quantity'] = $row_count['unique_products'];

    header("Location: index.php?act=cart1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/admin/cart.css">
    <link rel="stylesheet" href="assets/css/cart1.css">

</head>

<body>
    <div class="main">
        <table>
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Mô tả Laptop</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thêm vào lúc</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_price = 0;
                if ($num > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        $total_price += ($row['quantity'] * $row['price'])
                ?>
                        <tr>
                            <td><img src="<?php echo $row['image_url'] ?>" alt=""></td>
                            <td><?php echo $row['description'] ?></td>
                            <td><input class='quantity-input' type="number" value="<?php echo $row['quantity'] ?>"
                                    onchange="updateQuantity(<?php echo $row['laptop_id'] ?>, this.value)"></td>
                            <td><?php echo $row['price'] ?></td>
                            <td><?php echo date("H:i d/m/Y", strtotime($row["created_at"])) ?></td>
                            <td><a href="index.php?act=cart1&remove_id=<?php echo $row['laptop_id']; ?>" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?');">Xóa</a>
                        </tr>
                <?php }
                } else {
                    echo "<tr><td colspan='6'>Không có sản phẩm trong giỏ hàng.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <?php
        if ($num > 0) { ?>
            <div class="checkout-box">
                <h2>Tổng tiền: <span id="total-price"><?php echo $total_price; ?></span></h2>
                <button class="btn">Thanh toán</button>
            </div>
        <?php } ?>
    </div>
</body>

</html>