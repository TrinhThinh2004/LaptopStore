<?php
ob_start();
session_start();
include('connect.php');
$username = "Đăng nhập";
$link_user = "login.php";
if (isset($_SESSION["username"])) {
    $link_user = "user.php";
    $username = "Xin chào, " . $_SESSION["username"];
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.6.0-web/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <header>
        <div class="grid">
            <nav class="nav-container">
                <label for="" class="menu-icon"><i class="fa-solid fa-bars"></i></label>
                <li><a class="logo nav-item">Laptop4U</a></li>
                <ul>
                    <li class="search-container nav-item">
                        <div class="form-control">
                            <input type="text" placeholder="Bạn tìm gì" class="search-input">
                            <i class="fas fa-search icon"></i>
                        </div>
                    </li>

                    <li class="nav-item text-icon">
                        <a href="cart.php"><i class="fa-solid fa-cart-shopping icon"></i>Giỏ hàng</a>

                    </li>
                    <li class="nav-item text-icon">
                        <a href=<?php echo $link_user; ?>>
                            <i class="fa-solid fa-user icon"></i><?php echo $username; ?>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="sub-menu">
                <ul>
                    <li class="menu-item"><input type="text" placeholder="Tìm kiếm sản phẩm"></li>
                    <li class="menu-item"><a href="index.php">TRANG CHỦ</a></li>
                    <li class="menu-item"><a href="cart.php">GIỎ HÀNG</a></li>
                    <li class="menu-item"><a href=<?php echo $link_user; ?>><?php echo $username; ?></a></li>
                </ul>
            </div>
        </div>
    </header>
    <script>
        document.querySelector('.menu-icon').addEventListener('click', function () {
            document.querySelector('.sub-menu').classList.toggle('active');
        });
    </script>
</body>

</html>