<?php
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

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
