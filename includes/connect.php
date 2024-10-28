<?php
$host = 'localhost';
$dbname = 'laptopstore';
$username = 'root';
$password = '';


$conn = mysqli_connect($host, $username, $password, $dbname);

if ($conn) {
    $setLang = mysqli_query($conn, "SET NAMES 'utf8'");

    // $sql = "SELECT laptop_id,brand,model FROM laptops";
    // $sql1 = "select * from laptop_images";
    // $query = mysqli_query($conn, $sql);
    // $query1 = mysqli_query($conn, $sql1);
    // $result = mysqli_num_rows($query);
    // if ($result > 0) {
    //     while ($row = mysqli_fetch_assoc($query)){
    //         // echo "assets/images/" . strtolower($row['brand']). "/" .$row['model']. "/chinh.jpg" . "<br>";
    //         for($i = 0; $i < 5; $i++) {
    //             $filename = "chinh";
    //             if ($i > 0) $filename = $i;
    //             echo "('" . $row['laptop_id']."',"."'assets/images/" . strtolower($row['brand']). "/" .$row['model']. "/.$filename.jpg')," . "<br>";
    //         }

    //     }
        
    //     $image = mysqli_fetch_assoc($query1);
    //     $src = "../" . $image['image_url'];

    //     // Hiển thị hình ảnh
    //     echo $src;


    // }else {
    //     echo "Không có model nào được tìm thấy.";
    // }

} else {
    die("Kết nối thất bại! " . mysqli_connect_error());
}

?>