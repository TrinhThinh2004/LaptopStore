<?php
ob_start();
include_once("includes/connect.php");

$id = $_GET['id'];

$sql =
    "SELECT laptops.*, laptop_images.image_url
FROM laptops
LEFT JOIN laptop_images ON laptops.laptop_id = laptop_images.laptop_id
WHERE laptops.laptop_id = $id
ORDER BY laptops.laptop_id DESC";

$query = mysqli_query($conn, $sql);
$image_urls = [];
$result = null;

while ($row = mysqli_fetch_array($query)) {
    if (!$result)
        $result = $row;

    if ($row['image_url'])
        $image_urls[] = $row['image_url'];
}
if (isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    } else {
        $user_id = $_SESSION['user_id'];
    }
    $laptop_id = intval($_POST['laptop_id']);

    $check_cart = "SELECT quantity FROM Cart WHERE user_id = $user_id AND laptop_id = $laptop_id";
    $result_check = mysqli_query($conn, $check_cart);

    if (mysqli_num_rows($result_check) > 0) {
        $update_quantity = "UPDATE Cart SET quantity = quantity + 1 WHERE user_id = $user_id AND laptop_id = $laptop_id";
        mysqli_query($conn, $update_quantity);
    } else {
        $add = "INSERT INTO Cart (user_id, laptop_id, quantity) VALUES ($user_id, $laptop_id, 1)";
        mysqli_query($conn, $add);
    }

    $count_query = "SELECT COUNT(DISTINCT laptop_id) AS unique_products FROM Cart WHERE user_id = $user_id";
    $result_count = mysqli_query($conn, $count_query);
    if ($result_count) {
        $row_count = mysqli_fetch_assoc($result_count);
        $_SESSION['quantity'] = $row_count['unique_products'];
    } else {
        die("Error fetching cart count: " . mysqli_error($conn));
    }

    header("Location: index.php?act=product_detail&id=$id");
    exit;
}
?>
<link rel="stylesheet" href="assets/css/product_detail.css">
<link rel="stylesheet" href="assets/css/base.css">
<script>
    function changeImage(src) {
        const mainImage = document.getElementById('main-image');
        mainImage.src = src;
    }
</script>

<div class="main">
    <div class="container">
        <div class="left-section">
            <img id="main-image" alt="Laptop image" height="400" src="<?php echo $image_urls[0]; ?>" width="600" />
            <div class="thumbnail-container">
                <img alt="Thumbnail 1" height="60" src="<?php echo $image_urls[0]; ?>" onclick="changeImage(this.src)" />
                <img alt="Thumbnail 2" height="60" src="<?php echo $image_urls[1]; ?>" onclick="changeImage(this.src)" />
                <img alt="Thumbnail 3" height="60" src="<?php echo $image_urls[2]; ?>" onclick="changeImage(this.src)" />
                <img alt="Thumbnail 4" height="60" src="<?php echo $image_urls[3]; ?>" onclick="changeImage(this.src)" />
                <img alt="Thumbnail 5" height="60" src="<?php echo $image_urls[4]; ?>" onclick="changeImage(this.src)" />
            </div>
        </div>
        <div class="right-section">
            <h2><?php echo $result['description']; ?></h2>

            <div class="price-section">
                <span class="price"><?php echo number_format($result['price'], 0, ',', '.'); ?>₫</span>
                <span class="old-price"><?php echo number_format($result['price'] * 1.2, 0, ',', '.'); ?>₫</span>
            </div>
            <div class="content">
                <h3>Thông số kỹ thuật</h3>
                <table>
                    <tr>
                        <td>Hãng</td>
                        <td><?php echo $result['brand']; ?></td>
                    </tr>
                    <tr>
                        <td>Bộ xử lí</td>
                        <td><?php echo $result['processor']; ?></td>
                    </tr>
                    <tr>
                        <td>Ram</td>
                        <td><?php echo $result['ram_capacity'] . "GB"; ?></td>
                    </tr>
                    <?php if ($result['brand'] != 'Apple') { ?>
                        <tr>
                            <td>Kiểu Ram</td>
                            <td><?php echo $result['ram_type']; ?></td>
                        </tr>
                        <tr>
                            <td>Tốc độ Ram</td>
                            <td><?php echo $result['ram_speed']; ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td>Bộ nhớ</td>
                        <td><?php if ($result['storage'] < 1000) echo $result['storage'] . "GB";
                            else echo $result['storage'] / 1024 . "TB"; ?></td>
                    </tr>
                    <tr>
                        <td>Loại lưu trữ</td>
                        <td><?php echo $result['storage_type']; ?></td>
                    </tr>
                    <tr>
                        <td>GPU</td>
                        <td><?php echo $result['gpu']; ?></td>
                    </tr>
                    <tr>
                        <td>Kích thước màn hình</td>
                        <td><?php echo $result['screen_size']; ?></td>
                    </tr>
                    <tr>
                        <td>Độ phân giải</td>
                        <td><?php echo $result['screen_resolution']; ?></td>
                    </tr>
                    <tr>
                        <td>Tần số quét</td>
                        <td><?php echo $result['screen_refresh_rate']; ?></td>
                    </tr>
                </table>
            </div>
            <div class="cta-buttons">
                <form action="index.php" method="GET">
                    <input type="hidden" name="act" value="checkout">
                    <input type="hidden" name="laptop_id" value="<?php echo $id; ?>">
                    <button type="submit" class="btn" name="buy">Mua ngay</button>
                </form>
                <form action="" method="POST" style="display: inline;">
                    <input type="hidden" name="laptop_id" value="<?php echo $id; ?>">
                    <button type="submit" class="btn" name="add_to_cart">Giỏ hàng</button>
                </form>
            </div>

        </div>
    </div>
</div>