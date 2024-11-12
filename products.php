<?php
include("includes/connect.php");

if (isset($_GET['']))

    $brand = "";
$sql_brand = "";
if (isset($_GET['brand'])) {
    $brand_value = mysqli_real_escape_string($conn, $_GET['brand']);
    $sql_brand = "AND laptops.brand = '$brand_value'";
    $brand = "&brand=" . $brand_value;
}

$price = "";
$sql_price = "";
$min = 0;
if (isset($_GET['price'])) {
    if ($_GET['price'] > 15000000) $min = $_GET['price'] - 5000000;
    $price_value = mysqli_real_escape_string($conn, $_GET['price']);
    $sql_price = "AND laptops.price BETWEEN $min AND $price_value";
    $price = "&price=" . $price_value;
}

$category = "";
$sql_category = "";
if (isset($_GET['category'])) {
    $category_value = mysqli_real_escape_string($conn, $_GET['category']);
    $sql_category = "AND laptop_categories.category_id = '$category_value'";
    $category = "&category=" . $category_value;
}
$ram = "";
$sql_ram = "";
if (isset($_GET['ram'])) {
    $ram_value = mysqli_real_escape_string($conn, $_GET['ram']);
    $sql_ram = "AND laptops.ram = '$ram_value'";
    $ram = "&ram=" . $ram_value;
}
$storage = "";
$sql_storage = "";
if (isset($_GET['price'])) {
    $storage_value = mysqli_real_escape_string($conn, $_GET['storage']);
    $sql_storage = "AND laptops.storage = '$storage_value'";
    $price = "&price=" . $storage_value;
}

$pro_per_page = 15;
$result_num = mysqli_query($conn, "SELECT COUNT(laptop_id) AS total FROM laptops WHERE deleted=0 $sql_brand");
$row = mysqli_fetch_assoc($result_num);
$num_of_laptop = $row['total'];

$total_page = ceil($num_of_laptop / $pro_per_page);

if (isset($_GET['page'])) $page = $_GET['page'];
else $page = 1;
$index = ($page - 1) * $pro_per_page;
$sql =
    "SELECT laptop_categories.category_id, 
    laptops.laptop_id, laptops.price, laptops.description, laptops.ram_capacity, laptops.storage, 
    MAX(laptop_images.image_url) AS image_url
FROM laptops
LEFT JOIN laptop_images ON laptops.laptop_id = laptop_images.laptop_id
JOIN laptop_categories ON laptops.laptop_id = laptop_categories.laptop_id
WHERE laptops.deleted = 0
$sql_brand
$sql_price
$sql_category
$sql_ram
$sql_storage
GROUP BY laptops.laptop_id
ORDER BY laptops.laptop_id DESC
LIMIT $index, $pro_per_page";
$query = mysqli_query($conn, $sql);

$sql_get_cate = "SELECT * FROM categories";
$result_cate = mysqli_query($conn, $sql_get_cate);

$sql_get_ram = "SELECT DISTINCT ram_capacity FROM laptops ORDER BY ram_capacity ASC";
$result_ram = mysqli_query($conn, $sql_get_ram);

$sql_get_storage = "SELECT DISTINCT storage FROM laptops ORDER BY storage ASC";
$result_storage = mysqli_query($conn, $sql_get_storage);

if (isset($_GET['filter'])) {
}
?>

<link rel="stylesheet" href="assets/css/base.css">
<link rel="stylesheet" href="assets/css/products.css">
<div class="main">
    <div class="lst-img">
        <a href="?act=products&brand=Asus"><img src="assets/images/logo/asus.png" alt="Asus"></a>
        <a href="?act=products&brand=Dell"><img src="assets/images/logo/dell.png" alt="Dell"></a>
        <a href="?act=products&brand=HP"><img src="assets/images/logo/hp.png" alt="HP"></a>
        <a href="?act=products&brand=Lenovo"><img src="assets/images/logo/lenovo.png" alt="Lenovo"></a>
        <a href="?act=products&brand=Apple"><img src="assets/images/logo/macbook.png" alt="Macbook"></a>
        <a href="?act=products&brand=Acer"><img src="assets/images/logo/acer.png" alt="Acer"></a>
        <a href="?act=products&brand=MSI"><img src="assets/images/logo/msi.png" alt="MSI"></a>
    </div>
    <form action="" method="GET">

        <div class="filter-section">
            <div>
                <h3>Giá:
                    <select name="price">
                        <option>Giá</option>
                        <option value="15000000">Dưới 15 triệu</option>
                        <option value="20000000">15 - 20 triệu</option>
                        <option value="25000000">20 - 25 triệu</option>
                        <option value="30000000">25 - 30 triệu</option>
                        <option value="1000000000">Trên 30 triệu</option>
                    </select>
                </h3>
            </div>

            <div>
                <h3>Loại sản phẩm:
                    <select name="category">
                        <option>Loại sản phẩm</option>
                        <?php while ($row = mysqli_fetch_array($result_cate)) { ?>
                            <option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></option>
                        <?php } ?>
                    </select>
                </h3>
            </div>

            <div>
                <h3>RAM:
                    <select name="ram">
                        <option>RAM</option>
                        <?php while ($row = mysqli_fetch_array($result_ram)) { ?>
                            <option value="<?php echo $row['ram_capacity'] ?>"><?php echo $row['ram_capacity'] ?>GB</option>
                        <?php } ?>
                    </select>
                </h3>
            </div>

            <div>
                <h3>Ổ cứng:
                    <select name="storage">
                        <option>Ổ cứng</option>
                        <?php while ($row = mysqli_fetch_array($result_storage)) { ?>
                            <option value="<?php echo $row['storage'] ?>">
                                <?php
                                if ($row['storage'] > 1000) echo $row['storage'] / 1024 . "TB";
                                else echo $row['storage'] . "GB";
                                ?></option>
                        <?php } ?>
                    </select>
                </h3>
            </div>
            <button id="filterButton"><i class="fa-solid fa-filter" name="filter"></i>&nbspLọc</button>
        </div>
    </form>
    <div class="product-container">
        <?php
        if ($num_of_laptop == 0) {
            echo "<h2>Xin lỗi quý khách, hiện tại chúng tôi không có sản phẩm nào phù hợp với nhu cầu của bạn!</h2>";
        }
        while ($product = mysqli_fetch_array($query)) { ?>
            <a href="index.php?act=product_detail&id=<?php echo $product['laptop_id'] ?>" class="product-link">
                <div class="product">
                    <img
                        src="<?php echo htmlspecialchars($product['image_url']); ?>"
                        alt="<?php echo htmlspecialchars($product['description']); ?>">
                    <h3><?php echo htmlspecialchars($product['description']); ?></h3>
                    <p class="price"><?php echo number_format($product['price'], 0, ',', '.'); ?>₫</p>
                    <p class="discount"><?php echo number_format($product['price'] * 1.2, 0, ',', '.'); ?>₫</p>
                    <div class="button-container">
                        <form action="index.php" method="GET" style="display: inline;">
                            <input type="hidden" name="act" value="checkout">
                            <input type="hidden" name="laptop_id" value="<?php echo $product['laptop_id']; ?>">
                            <button type="submit" class="btnp" name="buy">Mua ngay</button>
                        </form>

                        <form action="" method="POST" style="display: inline;">
                            <input type="hidden" name="laptop_id" value="<?php echo $product['laptop_id']; ?>">
                            <button type="submit" class="btnp" name="add_to_cart">Giỏ hàng</button>
                        </form>

                    </div>
                </div>
            </a>
        <?php
        }
        ?>
    </div>
    <?php if ($total_page > 1) { ?>
        <div class="page-option">
            <p>Trang
                <?php
                for ($i = 1; $i <= $total_page; $i++) {
                    if ($page == $i)
                        echo "<span class='now'>$i</span>";
                    else { ?>
                        <a href="?act=products<?php echo $brand; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php
                    }
                }
                ?>
            </p>
        </div>
    <?php
    }
    ?>
</div>