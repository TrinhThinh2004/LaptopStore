<?php
include("../includes/connect.php");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['form_id']) && $_POST['form_id'] === 'addProductForm') {
        // Lấy dữ liệu từ form addProductForm
        $product_name = $_POST['productname'] ?? '';
        $model = $_POST['model'] ?? '';
        $brand = $_POST['brand'] ?? '';
        $category_id = $_POST['category'] ?? '';
        $cpu = $_POST['cpu'] ?? '';
        $gpu = $_POST['gpu'] ?? '';
        $ram = $_POST['ram'] ?? '';
        $ram_type = $_POST['ram_type'] ?? '';
        $ram_speed = $_POST['ram_speed'] ?? '';
        $screen_size = $_POST['screen_size'] ?? '';
        $screen_resolution = $_POST['screen_resolution'] ?? '';
        $screen_refresh_rate = $_POST['screen_refresh_rate'] ?? '';
        $storage = $_POST['storage'] ?? '';
        $storage_type = $_POST['storage_type'] ?? '';
        $price = $_POST['price'] ?? '';
        $stock_quantity = $_POST['stock_quantity'] ?? '';

        // Thêm sản phẩm mới vào bảng `laptops`
        $insert_sql = "INSERT INTO laptops (description, model, brand, processor, gpu, ram_capacity, ram_type, ram_speed, screen_size, screen_resolution, screen_refresh_rate, storage, storage_type, price, stock_quantity)
                      VALUES ('$product_name', '$model', '$brand', '$cpu', '$gpu', $ram, '$ram_type', '$ram_speed', '$screen_size', '$screen_resolution', '$screen_refresh_rate', $storage, '$storage_type', $price, $stock_quantity)";

        if (mysqli_query($conn, $insert_sql)) {
            $laptop_id = mysqli_insert_id($conn);
            $insert_to_cate = "INSERT INTO laptop_categories (laptop_id, category_id) 
            VALUES ($laptop_id, $category_id)";
            // $ins_cate = mysqli_query($conn, $insert_to_cate);
            if (!mysqli_query($conn, $insert_to_cate)) {
                die("Query failed: " . mysqli_error($conn));
            }
            // Lấy ảnh sản phẩm
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image = $_FILES['image'];
                $upload_dir = '../assets/images/' . strtolower($brand) . "/" . handle_folder_name($model);
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                $imagePath =  $upload_dir . "/chinh.jpg";
                move_uploaded_file($image['tmp_name'], $imagePath);
                $imagePath = removeDotDotSlash($imagePath);
                $sql_ins_image = "INSERT INTO laptop_images (laptop_id, image_url) VALUES ($laptop_id, '$imagePath')";
                mysqli_query($conn, $sql_ins_image);
            }

            // Lấy nhiều ảnh chi tiết
            if (isset($_FILES['images'])) {
                $multiImages = $_FILES['images'];
                $upload_dir = '../assets/images/' . strtolower($brand) . "/" . handle_folder_name($model);

                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }

                if (is_array($multiImages['tmp_name'])) {
                    $name = 1;
                    foreach ($multiImages['tmp_name'] as $index => $tmpName) {
                        if ($multiImages['error'][$index] === UPLOAD_ERR_OK) {
                            // Đặt tên file cho mỗi ảnh
                            $imagePath = $upload_dir . "/" . $name++ . ".jpg";
                            move_uploaded_file($tmpName, $imagePath);
                            $imagePath = removeDotDotSlash($imagePath);
                            $sql_ins_image = "INSERT INTO laptop_images (laptop_id, image_url) VALUES ($laptop_id, '$imagePath')";
                            mysqli_query($conn, $sql_ins_image);
                        }
                    }
                } else {
                    // Nếu chỉ có một ảnh
                    $tmpName = $multiImages['tmp_name'];
                    $error = $multiImages['error'];

                    if ($error === UPLOAD_ERR_OK) {
                        $imagePath = $upload_dir . "/1.jpg";
                        move_uploaded_file($tmpName, $imagePath);
                        $imagePath = removeDotDotSlash($imagePath);
                        $sql_ins_image = "INSERT INTO laptop_images (laptop_id, image_url) VALUES ($laptop_id, '$imagePath')";
                        mysqli_query($conn, $sql_ins_image);
                    }
                }
            }
            echo "<script>
                    alert('Sản phẩm mới đã được thêm thành công.');
                  </script>";
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Lỗi: " . $conn->error;
        }
    }
}

function handle_folder_name($folder_name)
{
    $folder_name = strtolower($folder_name);
    $folder_name = preg_replace('/\s+/', '_', $folder_name);
    // Bước 3: Loại bỏ dấu gạch dưới thừa ở đầu và cuối chuỗi
    $output = trim($folder_name, '_');
    return $output;
}
function removeDotDotSlash($path)
{
    if (substr($path, 0, 3) === '../') {
        return substr($path, 3);
    }
    return $path;
}
?>
<div class="main"></div>