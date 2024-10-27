
<link rel="stylesheet" href="../assets/css/admin/dashboard.css">
    <link rel="stylesheet" href="../assets/css/base.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        });
    </script>

    <?php
    include("header_admin.php");
    ?>

    <div class="grid">
        <div class="dashboard-container">
            <div class="dashboard-header">
                <h1>Trang chủ quản trị</h1>
            </div>
            <div class="admin-sidebar">
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="products.php">Quản lý sản phẩm</a></li>
                    <li><a href="products.php">Quản lý danh mục sản phẩm</a></li>
                    <li><a href="orders.php">Quản lý đơn hàng</a></li>
                    <li><a href="users.php">Quản lý người dùng</a></li>
                    <li><a href="../logout.php">Đăng xuất</a></li>
                </ul>
            </div>
            <div class="dashboard">


                <div class="cards">
                    <div class="card">
                        <div class="card-icon"><i class="fas fa-laptop"></i></div>
                        <p>120</p>
                        <p>Sản phẩm</p>
                    </div>
                    <div class="card">
                        <div class="card-icon"><i class="fas fa-shopping-cart"></i></div>
                        <p>45</p>
                        <p>Đơn hàng</p>
                    </div>
                    <div class="card">
                        <div class="card-icon"><i class="fas fa-dollar-sign"></i></div>
                        <p>150,000,000 VND</p>
                        <p>Doanh thu</p>
                    </div>
                    <div class="card">
                        <div class="card-icon"><i class="fas fa-users"></i></div>
                        <p>230</p>
                        <p>Người dùng</p>
                    </div>
                </div>
            </div>
        </div>
    </div>