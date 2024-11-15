<?php
include("connect.php");

function check_stock($laptop_id, $quantity) // done
{
    global $conn;
    $sql = "SELECT stock_quantity FROM laptops WHERE laptop_id = $laptop_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $stock_quantity = $row['stock_quantity'];
    if ($stock_quantity >= $quantity) return True;
    else return False;
}

function decrease_stock($order_id)
{
    global $conn;
    $sql = "SELECT * FROM order_items WHERE order_id = $order_id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $laptop_id = $row['laptop_id'];
        $quantity = $row['quantity'];
        $sql1 = "SELECT stock_quantity FROM laptops WHERE laptop_id = $laptop_id";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_array($result1);
        $new_stock_quantity = $row1['stock_quantity'] - $quantity;
        $sql_dec = "UPDATE laptops SET stock_quantity = $new_stock_quantity WHERE laptop_id = $laptop_id";
        mysqli_query($conn, $sql_dec);
    }
}
function increase_stock($order_id)
{
    global $conn;
    $sql = "SELECT * FROM order_items WHERE order_id = $order_id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $laptop_id = $row['laptop_id'];
        $quantity = $row['quantity'];
        $sql1 = "SELECT stock_quantity FROM laptops WHERE laptop_id = $laptop_id";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_array($result1);
        $new_stock_quantity = $row1['stock_quantity'] + $quantity;
        $sql_dec = "UPDATE laptops SET stock_quantity = $new_stock_quantity WHERE laptop_id = $laptop_id";
        mysqli_query($conn, $sql_dec);
    }
}
?>
<div></div>