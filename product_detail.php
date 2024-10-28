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
                <img id="main-image" alt="Laptop image" height="400" src="<?php echo $image_urls[0];?>" width="600" />
                <div class="thumbnail-container">
                    <img alt="Thumbnail 1" height="60" src="<?php echo $image_urls[0];?>" onclick="changeImage(this.src)" />
                    <img alt="Thumbnail 2" height="60" src="<?php echo $image_urls[1];?>" onclick="changeImage(this.src)" />
                    <img alt="Thumbnail 3" height="60" src="<?php echo $image_urls[2];?>" onclick="changeImage(this.src)" />
                    <img alt="Thumbnail 4" height="60" src="<?php echo $image_urls[3];?>" onclick="changeImage(this.src)" />
                    <img alt="Thumbnail 5" height="60" src="<?php echo $image_urls[4];?>" onclick="changeImage(this.src)" />
                </div>
            </div>
            <div class="right-section">
                <h2><?php echo $result['description'];?></h2>

                <div class="price-section">
                    <span class="price"><?php echo number_format($result['price'], 0, ',', '.');?>₫</span>
                    <span class="old-price"><?php echo number_format($result['price']*1.2, 0, ',', '.');?>₫</span>
                </div>
                <div class="content">
                    <h3>Thông số kỹ thuật</h3>
                    <table>
                        <tr>
                            <td>Hãng</td>
                            <td><?php echo $result['brand'];?></td>
                        </tr>
                        <tr>
                            <td>Bộ xử lí</td>
                            <td><?php echo $result['processor'];?></td>
                        </tr>
                        <tr>
                            <td>Ram</td>
                            <td><?php echo $result['ram_capacity'] . "GB";?></td>
                        </tr>
                        <?php if ($result['brand'] != 'Apple') { ?>
                        <tr>
                            <td>Kiểu Ram</td>
                            <td><?php echo $result['ram_type'];?></td>
                        </tr>
                        <tr>
                            <td>Tốc độ Ram</td>
                            <td><?php echo $result['ram_speed'];?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td>Bộ nhớ</td>
                            <td><?php echo $result['storage']. "GB";?></td>
                        </tr>
                        <tr>
                            <td>Loại lưu trữ</td>
                            <td><?php echo $result['storage_type'];?></td>
                        </tr>
                        <tr>
                            <td>Gpu</td>
                            <td><?php echo $result['gpu'];?></td>
                        </tr>
                        <tr>
                            <td>Kích thước màn hình</td>
                            <td><?php echo $result['screen_size'];?></td>
                        </tr>
                        <tr>
                            <td>Độ phân giải</td>
                            <td><?php echo $result['screen_resolution'];?></td>
                        </tr>
                        <tr>
                            <td>Độ làm mới</td>
                            <td><?php echo $result['screen_refresh_rate'];?></td>
                        </tr>
                    </table>
                </div>
                <div class="cta-buttons">
                    <button class="buy">Mua ngay</button>
                    <button class="shoppingcart">Thêm vào giỏ hàng</button>

                </div>

            </div>
        </div>
    </div>