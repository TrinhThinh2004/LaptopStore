<?php
include_once("../includes/connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {

    // Xoá người dùng
    if ($_POST['action'] == 'delete' && isset($_POST['user_id'])) {
        $userid = $conn->real_escape_string($_POST['user_id']);

        // Kiểm tra vai trò người dùng trước khi xoá
        $checkRoleSql = "SELECT role FROM users WHERE user_id = '$userid'";
        $result = $conn->query($checkRoleSql);
        $row = $result->fetch_assoc();

        if ($row['role'] == 1) {
            http_response_code(403);
            echo "Không thể xóa tài khoản admin.";
        } else {
            $deleteSql = "UPDATE users SET deleted = 1 WHERE user_id = '$userid'";
            if ($conn->query($deleteSql) === TRUE) {
                http_response_code(200);
                echo "Xóa người dùng thành công.";
            } else {
                http_response_code(500);
                echo "Xóa người dùng không thành công: " . $conn->error;
            }
        }
        exit;
    }

    // Cập nhật thông tin người dùng
    if ($_POST['action'] == 'update' && isset($_POST['username'], $_POST['fullname'], $_POST['email'], $_POST['phone'], $_POST['address'], $_POST['role'])) {
        $username = $conn->real_escape_string($_POST['username']);
        $fullname = $conn->real_escape_string($_POST['fullname']);
        $email = $conn->real_escape_string($_POST['email']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $address = $conn->real_escape_string($_POST['address']);
        $role = intval($_POST['role']);

        $updateSql = "UPDATE users SET full_name = '$fullname', email = '$email', phone_number = '$phone', address = '$address', role = $role WHERE username = '$username'";

        if ($conn->query($updateSql) === TRUE) {
            http_response_code(200);
            echo "<script>
                    alert('Cập nhật thông tin thành công');
                    window.location.href = 'dashboard.php';
                  </script>";
        } else {
            http_response_code(500);
            echo "Cập nhật thông tin không thành công: " . $conn->error;
        }
        exit;
    }

    // Xóa sản phẩm
    if ($_POST['action'] == 'delete' && isset($_POST['laptop_id'])) {
        $laptopid = $conn->real_escape_string($_POST['laptop_id']);
        $deleteSql = "UPDATE laptops SET deleted = 1 WHERE laptop_id = '$laptopid'";
        if ($conn->query($deleteSql) === TRUE) {
            http_response_code(200);
            echo "Xóa sản phẩm thành công.";
        } else {
            http_response_code(500);
            echo "Xóa sản phẩm không thành công: " . $conn->error;
        }
        exit;
    }

    // Thêm sản phẩm mới
    if ($_POST['action'] == 'add' && isset($_POST['productname'], $_POST['brand'], $_POST['cpu'], $_POST['gpu'], $_POST['ram'], $_POST['ram_type'], $_POST['ram_speed'], $_POST['screen_size'], $_POST['screen_resolution'], $_POST['screen_refresh_rate'], $_POST['storage'], $_POST['storage_type'], $_POST['price'], $_POST['stock_quantity'])) {

        // Lấy dữ liệu từ form
        $productname = $conn->real_escape_string($_POST['productname']);
        $brand = $conn->real_escape_string($_POST['brand']);
        $cpu = $conn->real_escape_string($_POST['cpu']);
        $gpu = $conn->real_escape_string($_POST['gpu']);
        $ram = intval($_POST['ram']);
        $ram_type = $conn->real_escape_string($_POST['ram_type']);
        $ram_speed = $conn->real_escape_string($_POST['ram_speed']);
        $screen_size = $conn->real_escape_string($_POST['screen_size']);
        $screen_resolution = $conn->real_escape_string($_POST['screen_resolution']);
        $screen_refresh_rate = $conn->real_escape_string($_POST['screen_refresh_rate']);
        $storage = intval($_POST['storage']);
        $storage_type = $conn->real_escape_string($_POST['storage_type']);
        $price = floatval($_POST['price']);
        $stock_quantity = intval($_POST['stock_quantity']);

        // Xử lý ảnh tải lên nếu cần thiết
        $image = ''; // Thêm mã xử lý ảnh nếu cần

        // Thêm sản phẩm mới vào bảng `laptops`
        $insertSql = "INSERT INTO laptops (description, brand, cpu, gpu, ram, ram_type, ram_speed, screen_size, screen_resolution, screen_refresh_rate, storage, storage_type, price, stock_quantity)
                      VALUES ('$productname', '$brand', '$cpu', '$gpu', $ram, '$ram_type', '$ram_speed', '$screen_size', '$screen_resolution', '$screen_refresh_rate', $storage, '$storage_type', $price, $stock_quantity)";

        if ($conn->query($insertSql) === TRUE) {
            echo "<script>
                    alert('Sản phẩm mới đã được thêm thành công.');
                    window.location.href = 'product_management.php';
                  </script>";
        } else {
            echo "Lỗi khi thêm sản phẩm: " . $conn->error;
        }
    }

    $conn->close();
}
