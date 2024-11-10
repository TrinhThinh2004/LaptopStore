<?php
ob_start();
include("includes/connect.php");

$total_price = 0;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql_user = "SELECT * FROM users where user_id = $user_id";
    $result = mysqli_query($conn, $sql_user);
    $user = mysqli_fetch_array($result);
} else {
    $user = [
        'full_name' => '',
        'email' => '',
        'phone_number' => '',
        'address' => ''
    ];
}

$laptops = [];

if (isset($_GET['buy'])) {
    $laptop_id = $_GET['laptop_id'];
    $_SESSION['laptop_id'] = $laptop_id;

    $sql_laptop =
        "SELECT laptops.laptop_id, laptops.price, laptops.description, 
        MAX(laptop_images.image_url) AS image_url
        FROM laptops
        LEFT JOIN laptop_images ON laptops.laptop_id = laptop_images.laptop_id
        WHERE laptops.laptop_id = $laptop_id";

    $result_laptop = mysqli_query($conn, $sql_laptop);
    $row = mysqli_fetch_assoc($result_laptop);
    $total_price += $row['price'];
    $laptops[] = [
        'id' => $row['laptop_id'],
        'price' => $row['price'],
        'description' => $row['description'],
        'image_url' => $row['image_url'],
        'quantity' => '1'
    ];
} else {
    $sql_laptop =
        "SELECT L.laptop_id, L.description, L.price, C.quantity, 
        MAX(I.image_url) AS image_url
        FROM Cart C
        JOIN Laptops L ON C.laptop_id = L.laptop_id
        LEFT JOIN Laptop_Images I ON L.laptop_id = I.laptop_id
        WHERE C.user_id = $user_id
        GROUP BY L.laptop_id,L.description, L.price, C.quantity";

    $result_laptop = mysqli_query($conn, $sql_laptop);
    while ($row = mysqli_fetch_assoc($result_laptop)) {
        $total_price += $row['price'] * $row['quantity'];
        $laptops[] = [
            'id' => $row['laptop_id'],
            'price' => $row['price'],
            'description' => $row['description'],
            'image_url' => $row['image_url'],
            'quantity' => $row['quantity']
        ];
    }
}
?>

<link rel="stylesheet" href="assets/css/base.css">
<link rel="stylesheet" href="assets/css/checkout.css">

<div class="main">
    <div class="chekout-container">
        <div class="content-box">
            <form action="index.php?act=success" method="POST" name="info" id="info">
                <h2>Thông tin người nhận</h2>
                <h3>Họ tên người nhận</h3>
                <input class="checkout-input" type="text" name="full_name" value="<?php echo $user['full_name'] ?>" required>
                <h3>Email</h3>
                <input class="checkout-input" type="email" name="email" value="<?php echo $user['email'] ?>" required>
                <h3>Số điện thoại</h3>
                <input class="checkout-input" type="text" name="phone_number" value="<?php echo $user['phone_number'] ?>" required>
                <h3>Địa chỉ</h3>
                <input class="checkout-input" type="text" name="address" value="<?php echo $user['address'] ?>" required>
                <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
            </form>
            <!-- <div class="payment-type">
                <h3>Phương thức thanh toán: </h3>
                <input type="radio" id="payment1" name="payment" value="Tiền mặt">
                <label for="payment1">Tiền măt</label>
                <input type="radio" id="payment2" name="payment">
                <label for="payment2">QR</label>
            </div> -->
        </div>
        <div class="content-box">
            <h2>Sản phảm đặt hàng</h2>
            <table>
                <thead>
                    <th>Sản phẩm</th>
                    <th>Số lương</th>
                    <th>Giá</th>
                </thead>
                <tbody>
                    <?php foreach ($laptops as $product) { ?>
                        <tr>
                            <td class="product-content">
                                <img src="<?php echo $product['image_url'] ?>" alt="<?php echo $product['description'] ?>">
                                <h3 class="text-clamp"><?php echo $product['description'] ?></h3>
                            </td>
                            <td><?php echo $product['quantity'] ?></td>
                            <td><?php echo number_format($product['price'], 0, ',', '.'); ?>đ</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="confirm">
                <h2 class="total-price">Tổng tiền: <?php echo number_format($total_price, 0, ',', '.'); ?>đ</h2>
                <button class="btn" form="info" name="confirm" type="submit">Đặt hàng</button>
            </div>
        </div>
    </div>
</div>