<?php
include("connect.php");
$word = "";
$sql_word = "";
if (isset($_GET['word'])) {
    $word = $_GET['word'];
    $sql_word = " AND laptops.description LIKE '%$word%' ";
}


$brand = "";
$sql_brand = "";
if (isset($_GET['brand'])) {
    $brand_value = $_GET['brand'];
    $sql_brand = "AND laptops.brand = '$brand_value'";
    $brand = "&brand=" . $brand_value;
    $_SESSION['brand'] = $brand;
    $_SESSION['sql_brand'] = $sql_brand;
}

// Kiểm tra bộ lọc cho giá
$sql_price = "";
$min = 0;
if (isset($_GET['price']) && $_GET['price'] != "") {
    $price_value = (int)$_GET['price'];

    if ($price_value > 15000000 && $price_value != 1000000000) {
        $min = $price_value - 5000000;
    } elseif ($price_value == 1000000000) {
        $min = 30000000;
    }
    $sql_price = " AND laptops.price BETWEEN $min AND $price_value";
}

// Kiểm tra bộ lọc cho RAM
$sql_ram = "";
if (isset($_GET['ram']) && $_GET['ram'] != "") {
    $ram_value = (int)$_GET['ram'];
    $sql_ram = " AND laptops.ram_capacity = $ram_value";
}

// Kiểm tra bộ lọc cho storage
$sql_storage = "";
if (isset($_GET['storage']) && $_GET['storage'] != "") {
    $storage_value = mysqli_real_escape_string($conn, $_GET['storage']);
    $sql_storage = " AND laptops.storage = $storage_value";
}

$sql_category = "";
if (isset($_GET['category']) && $_GET['category'] != "") {
    $tag = true;
    $category_value = (int)$_GET['category'];
    $r_cate = mysqli_query($conn, "SELECT category_name FROM categories WHERE category_id=$category_value");
    $row_cate = mysqli_fetch_array($r_cate);
    $sql_category = " AND laptop_categories.category_id = $category_value"; // Thêm điều kiện vào mảng
}

$sql_conditions = $sql_word . $sql_brand . $sql_price . $sql_category . $sql_ram . $sql_storage;


$pro_per_page = 15;
$sql_count = "SELECT COUNT(DISTINCT laptops.laptop_id) AS total 
FROM laptops 
LEFT JOIN laptop_categories ON laptops.laptop_id = laptop_categories.laptop_id
WHERE deleted=0 $sql_conditions";
// if (isset($_GET['word'])) $sql_count .= $sql_word;
// else $sql_count .= $sql_brand . $sql_price . $sql_category . $sql_ram . $sql_storage;
// $sql_count .= $sql_word . $sql_brand . $sql_price . $sql_category . $sql_ram . $sql_storage;
$result_num = mysqli_query($conn, $sql_count);
$row = mysqli_fetch_assoc($result_num);
$num_of_laptop = $row['total'];

$total_page = ceil($num_of_laptop / $pro_per_page);

if (isset($_GET['page'])) $page = $_GET['page'];
else $page = 1;
$index = ($page - 1) * $pro_per_page;
// $sql = "SELECT laptop_categories.category_id, 
//     laptops.laptop_id, laptops.price, laptops.description, laptops.ram_capacity, laptops.storage, 
//     MAX(laptop_images.image_url) AS image_url
// FROM laptops
// LEFT JOIN laptop_images ON laptops.laptop_id = laptop_images.laptop_id
// JOIN laptop_categories ON laptops.laptop_id = laptop_categories.laptop_id
// WHERE laptops.deleted = 0 ";

// if (isset($_GET['word'])) $sql .= $sql_word;
// else $sql .= $sql_brand . $sql_price . $sql_category . $sql_ram . $sql_storage;

// $sql .= "
// GROUP BY laptops.laptop_id
// ORDER BY laptops.laptop_id DESC
// LIMIT $index, $pro_per_page";

// $query = mysqli_query($conn, $sql);

$sql = "SELECT laptop_categories.category_id, 
               laptops.laptop_id, laptops.price, laptops.description, laptops.ram_capacity, laptops.storage, 
               MAX(laptop_images.image_url) AS image_url
        FROM laptops
        LEFT JOIN laptop_images ON laptops.laptop_id = laptop_images.laptop_id
        JOIN laptop_categories ON laptops.laptop_id = laptop_categories.laptop_id
        WHERE laptops.deleted = 0 $sql_conditions
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

$brand_value = ""; // Giá trị mặc định để tránh lỗi Undefined
if (isset($_GET['brand'])) {
    $brand_value = $_GET['brand'];
}
?>

<link rel="stylesheet" href="../assets/css/base.css">
<div class="lst-img">
    <a href="?act=products&brand=Asus"><img src="assets/images/logo/asus.png" alt="Asus"></a>
    <a href="?act=products&brand=Dell"><img src="assets/images/logo/dell.png" alt="Dell"></a>
    <a href="?act=products&brand=HP"><img src="assets/images/logo/hp.png" alt="HP"></a>
    <a href="?act=products&brand=Lenovo"><img src="assets/images/logo/lenovo.png" alt="Lenovo"></a>
    <a href="?act=products&brand=Apple"><img src="assets/images/logo/macbook.png" alt="Macbook"></a>
    <a href="?act=products&brand=Acer"><img src="assets/images/logo/acer.png" alt="Acer"></a>
    <a href="?act=products&brand=MSI"><img src="assets/images/logo/msi.png" alt="MSI"></a>
</div>
<div class="filter-section">
    <form action="index.php" method="GET" id="filter">
        <input type="hidden" name="act" value="products">
        <input type="hidden" name="brand" value="<?php echo $brand_value; ?>">
        <div>
            <h3>Giá:
                <select name="price">
                    <option value=""
                        <?php if (isset($_GET['price']) && $_GET['price'] == "0") echo 'selected'; ?>>Giá</option>
                    <option value="15000000"
                        <?php if (isset($_GET['price']) && $_GET['price'] == "15000000") echo 'selected'; ?>>Dưới 15 triệu</option>
                    <option value="20000000"
                        <?php if (isset($_GET['price']) && $_GET['price'] == "20000000") echo 'selected'; ?>>15 - 20 triệu</option>
                    <option value="25000000"
                        <?php if (isset($_GET['price']) && $_GET['price'] == "25000000") echo 'selected'; ?>>20 - 25 triệu</option>
                    <option value="30000000"
                        <?php if (isset($_GET['price']) && $_GET['price'] == "30000000") echo 'selected'; ?>>25 - 30 triệu</option>
                    <option value="1000000000"
                        <?php if (isset($_GET['price']) && $_GET['price'] == "1000000000") echo 'selected'; ?>>Trên 30 triệu</option>
                </select>
            </h3>
        </div>

        <div>
            <h3>Loại sản phẩm:
                <select name="category">
                    <option value="">Loại sản phẩm</option>
                    <?php while ($row = mysqli_fetch_array($result_cate)) { ?>
                        <option value="<?php echo $row['category_id'] ?>"
                            <?php if (isset($_GET['category']) && $_GET['category'] == $row['category_id'])
                                echo 'selected' ?>><?php echo $row['category_name'] ?></option>
                    <?php } ?>
                </select>
            </h3>
        </div>

        <div>
            <h3>RAM:
                <select name="ram">
                    <option value="">RAM</option>
                    <?php while ($row = mysqli_fetch_array($result_ram)) { ?>
                        <option value="<?php echo $row['ram_capacity'] ?>"
                            <?php if (isset($_GET['ram']) && $_GET['ram'] == $row['ram_capacity'])
                                echo 'selected' ?>><?php echo $row['ram_capacity'] ?>GB</option>
                    <?php } ?>
                </select>
            </h3>
        </div>

        <div>
            <h3>Ổ cứng:
                <select name="storage">
                    <option value="">Ổ cứng</option>
                    <?php while ($row = mysqli_fetch_array($result_storage)) { ?>
                        <option value="<?php echo $row['storage'] ?>"
                            <?php if (isset($_GET['storage']) && $_GET['storage'] == $row['storage'])
                                echo 'selected' ?>>
                            <?php
                            if ($row['storage'] > 1000) echo $row['storage'] / 1024 . "TB";
                            else echo $row['storage'] . "GB";
                            ?></option>
                    <?php } ?>
                </select>
            </h3>
        </div>
    </form>
    <button class="filterButton" onclick="location.href='index.php?act=products'">Bỏ lọc</button>
    <button class="filterButton" name="filter" form="filter"><i class="fa-solid fa-filter"></i>&nbspLọc</button>
</div>