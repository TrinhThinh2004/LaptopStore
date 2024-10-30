<?php
ob_start();
include_once("includes/connect.php");


if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

  
    $sql = "
        SELECT laptops.laptop_id, laptops.price, laptops.description, MAX(laptop_images.image_url) AS image_url
        FROM laptops
        LEFT JOIN laptop_images ON laptops.laptop_id = laptop_images.laptop_id
        WHERE laptops.laptop_id = '$product_id'
        GROUP BY laptops.laptop_id";

    $query = mysqli_query($conn, $sql);

 
 
    $product = mysqli_fetch_array($query);
  
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Thanh Toán</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/payment.css">
</head>

<body>
    <div class="container">
        <form method="POST" action="">
            <div class="product-container">
                <?php if ($product): ?>
                    <div class="product">
                        <img alt="<?php echo htmlspecialchars($product['description']); ?>" height="100" src="<?php echo htmlspecialchars($product['image_url']); ?>" width="100" />
                        <div class="product-details">
                            <h2><?php echo htmlspecialchars($product['description']); ?></h2>
                        </div>
                        <div class="product-quantity">
                            <button type="button">-</button>
                            <input type="text" name="quantity" value="1" />
                            <button type="button">+</button>
                        </div>
                        <div class="product-price"><?php echo number_format($product['price'], 0, ',', '.'); ?>₫</div>
                    </div>
                <?php else: ?>
                    <p>Không tìm thấy sản phẩm.</p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label>THÔNG TIN KHÁCH HÀNG</label>
                <div class="radio-group">
                    <input id="male" name="gender" type="radio" value="male" required />
                    <label for="male">Anh</label>
                    <input id="female" name="gender" type="radio" value="female" />
                    <label for="female">Chị</label>
                </div>
            </div>
            <div class="form-group">
                <label>Họ và Tên</label>
                <input name="fullname" placeholder="Nhập họ và tên" type="text" required />
            </div>
            <div class="form-group">
                <label>Số điện thoại</label>
                <input name="phone" placeholder="Nhập số điện thoại" type="text" required />
            </div>
            <div class="form-group">
                <label>CHỌN CÁCH THỨC NHẬN HÀNG</label>
                <div class="radio-group">
                    <input id="delivery" name="delivery_method" type="radio" value="delivery" required />
                    <label for="delivery">Giao tận nơi</label>
                    <input id="store_pickup" name="delivery_method" type="radio" value="store_pickup" />
                    <label for="store_pickup">Nhận tại siêu thị</label>
                </div>
            </div>
            <div class="form-group">
                <label>Giao đến chi nhánh toàn quốc hoặc nhận hàng tại siêu thị (nếu có)</label>
                <select name="province" required>
                    <option value="">Chọn Tỉnh/Thành phố</option>
                    <option value="Hồ Chí Minh">Hồ Chí Minh</option>
                    <option value="Hà Nội">Hà Nội</option>
                </select>
            </div>
            <div class="form-group">
                <select name="district" required>
                    <option value="">Chọn Quận/Huyện</option>
                    <option value="Quận 1">Quận 1</option>
                    <option value="Quận 2">Quận 2</option>
                    <option value="Quận 3">Quận 3</option>
                    <option value="Quận 4">Quận 4</option>
                    <option value="Quận 5">Quận 5</option>
                </select>
            </div>
            <div class="form-group">
                <select name="ward" required>
                    <option value="">Chọn Phường/Xã</option>
                    <option value="Phường 1">Phường 1</option>
                    <option value="Phường 2">Phường 2</option>
                    <option value="Phường 3">Phường 3</option>
                </select>
            </div>
            <div class="form-group">
                <label>Yêu cầu khác (không bắt buộc)</label>
                <input type="text "name="additional_request" placeholder="Nhập yêu cầu khác">   
            </div>
            <div class="form-group">
                <label>Mã giảm giá/ Phiếu mua hàng</label>
                <div class="apply-coupon">
                    <input name="discount_code" placeholder="Nhập mã giảm giá/ Phiếu mua hàng" type="text" />
                    <button type="submit">Áp dụng</button>
                </div>
            </div>
            <div class="total-price">
                Tổng tiền:

                <?php echo number_format($product['price'], 0, ',', '.'); ?>₫

            </div>
            <div class="submit-button">
                <button type="submit">ĐẶT HÀNG</button>
            </div>
        </form>
    </div>
    
    
</body>

</html>