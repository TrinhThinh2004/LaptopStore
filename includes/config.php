<?php
$host = 'localhost';
$dbname = 'laptopstore';
$username = 'root';
$password = '';


$conn = mysqli_connect($host, $username, $password, $dbname);

$list_sql = 'select * from laptops order by brand';

$result = mysqli_query($conn, $list_sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo $row['brand'] . ' ' . $row['model'] . '<br>';
}
?>