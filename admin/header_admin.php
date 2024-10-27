<?php
ob_start();
session_start();
include('../includes/connect.php');
$username = "";
if (isset($_SESSION["username"])) {
    $username = "Xin chào, Quản trị viên " . $_SESSION["username"];
}

// Kiểm tra role == 1 thì cho vô quản trị
if (isset($_SESSION["role"]) && $_SESSION["role"] == 1) {
    ?>
        <link rel="stylesheet" href="../assets/css/admin/header_admin.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

        <header>
            <div class="grid">
                <nav class="nav-container">
                    <h2 class="logo nav-item">Laptop4U</h2>
                    <ul>
                        <li class="nav-item">
                            <a href="../user.php"><?php echo $username; ?></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>


    <?php
} else {
    header("location: ../index.php");
}
?>