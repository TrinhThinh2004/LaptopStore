<?php
$host = 'localhost';
$dbname = 'laptopstore';
$username = 'root';
$password = '';


$conn = mysqli_connect($host, $username, $password, $dbname);

if ($conn) {
    $setLang = mysqli_query($conn, "SET NAMES 'utf8'");
} else {
    die("Kết nối thất bại! " . mysqli_connect_error());
}