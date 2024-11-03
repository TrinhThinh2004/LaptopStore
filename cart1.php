<?php
    ob_start();
    include("includes/connect.php"); 

    if (!$_SESSION['username'] && !$_SESSION['user_id']) {
        header('location: login.php');
        exit;   
    }

    $laptop_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Them giỏ hàng
    $add = "INSERT INTO Cart (user_id, laptop_id, quantity) VALUES ($user_id, $laptop_id, 1);";
    $result_add = mysqli_query($conn, $add);

    $sql = "SELECT L.laptop_id, L.brand, L.model, L.description, L.price, C.quantity, 
     MAX(I.image_url) AS image_url, C.created_at
    FROM Cart C
    JOIN Laptops L ON C.laptop_id = L.laptop_id
    LEFT JOIN Laptop_Images I ON L.laptop_id = I.laptop_id
    WHERE C.user_id = '$user_id'
    GROUP BY L.laptop_id, L.brand, L.model, L.description, L.price, C.quantity";

    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
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
                            <td><a href = "cc.">Xóa</a></td>
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
                        <button>Thanh toán</button>
                    </div>
            <?php } ?>
</div>
</body>
</html>