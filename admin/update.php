<?php
include_once("../includes/connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'delete' && isset($_POST['user_id'])) {
        $userid = $conn->real_escape_string($_POST['user_id']);

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
                echo "Xóa người dùng không thành công.";
            }
        }
        exit;
    }

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
            echo "Thông tin người dùng đã được cập nhật thành công.";
        } else {
            http_response_code(500);
            echo "Cập nhật thông tin không thành công: " . $conn->error;
        }
        exit;
    }

    if ($_POST['action'] == 'delete' && isset($_POST['laptop_id'])) {
        $laptopid = $conn->real_escape_string($_POST['laptop_id']);
        $deleteSql = "UPDATE laptops SET deleted = 1 WHERE laptop_id = '$laptopid'";
        if ($conn->query($deleteSql) === TRUE) {
            http_response_code(200);
            echo "Xóa sản phẩm thành công.";
        } else {
            http_response_code(500);
            echo "Xóa sản phẩm không thành công.";
        }
        exit;
    }

}
