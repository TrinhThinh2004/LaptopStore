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

    if (isset($_GET['remove_id'])) {
        $user_id = $_SESSION['user_id'];
        $laptop_id = intval($_GET['remove_id']); // Lấy laptop_id từ GET và chuyển đổi thành số nguyên
    
        // Xóa sản phẩm khỏi bảng Cart
        $delete_query = "DELETE FROM Cart WHERE user_id = $user_id AND laptop_id = $laptop_id";
        mysqli_query($conn, $delete_query);
    
        // Cập nhật lại số lượng sản phẩm khác nhau trong giỏ hàng
        $count_query = "SELECT COUNT(DISTINCT laptop_id) as unique_products FROM Cart WHERE user_id = $user_id";
        $result_count = mysqli_query($conn, $count_query);
        $row_count = mysqli_fetch_assoc($result_count);
        $_SESSION['quantity'] = $row_count['unique_products'];
    
        // Điều hướng lại trang hiện tại để tránh lặp lại thao tác xóa nếu người dùng reload trang
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
                            <td><?php echo $row['quantity'] ?></td>
                            <td><?php echo $row['price'] ?></td>
                            <td><?php echo date("H:i d/m/Y", strtotime($row["created_at"])) ?></td>
                            <td><a href = "index.php?act=cart1&remove_id=<?php echo $row['laptop_id']; ?>" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?');">Xóa</a>
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
                        <h2>Tổng tiền: <?php echo $total_price ?></h2>
                        <button class="btn">Thanh toán</button>
                    </div>
            <?php } ?>
</div>
</body>
</html>