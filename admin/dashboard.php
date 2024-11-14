<?php
include_once("../includes/connect.php");
?>

<link rel="stylesheet" href="../assets/css/admin/dashboard.css">
<link rel="stylesheet" href="../assets/css/base.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

<?php include('update.php'); ?>
<?php include('confirm_order.php'); ?>
<?php include("header_admin.php"); ?>

<div class="grid">
    <div class="dashboard-container">
        <div class="admin-sidebar">
            <ul>
                <li style="color: white;">Trang chủ Admin</li>
                <li><a href="#" onclick="showCards()">Dashboard</a></li>
                <li><a href="#" onclick="showProductsManagement()">Quản lý sản phẩm</a></li>
                <li><a href="products.php">Quản lý danh mục sản phẩm</a></li>
                <li><a href="#" onclick="showOrderManagement()">Quản lý đơn hàng</a></li>
                <li><a href="#" onclick="showUserManagement()">Quản lý người dùng</a></li>
                <li><a href="../logout.php">Đăng xuất</a></li>
            </ul>
        </div>

        <div class="dashboard">
            <!-- Dashboard Cards -->
            <div class="cards-container" id="cards">
                <div class="cards">
                    <div class="card">
                        <div class="card-icon"><i class="fas fa-laptop"></i></div>
                        <p>120</p>
                        <p>Sản phẩm</p>
                    </div>
                    <a href="#" onclick="showOrderManagement()">
                        <div class="card">
                            <div class="card-icon"><i class="fas fa-shopping-cart"></i></div>
                            <p>45</p>
                            <p>Đơn hàng</p>
                        </div>
                    </a>
                    <div class="card">
                        <div class="card-icon"><i class="fas fa-dollar-sign"></i></div>
                        <p>150,000,000 VND</p>
                        <p>Doanh thu</p>
                    </div>
                    <a href="#" onclick="showUserManagement()">
                        <div class="card">
                            <div class="card-icon"><i class="fas fa-users"></i></div>
                            <p>230</p>
                            <p>Người dùng</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- User Management -->
            <div class="content" id="userManagement" style="display: none;">
                <div class="search-container">
                    <input type="text" placeholder="Tìm kiếm">
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên tài khoản</th>
                            <th>Mật khẩu</th>
                            <th>Email</th>
                            <th>Họ tên</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Quyền hạn</th>
                            <th>Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("user_management.php");
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="content" id="productsManagement" style="display: none;">
                <div class="search-container">
                    <input type="text" placeholder="Tìm kiếm">
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Hình ảnh</th>
                            <th>Tên</th>
                            <th>Thương hiệu</th>
                            <th>Giá tiền</th>
                            <th>Số lượng</th>
                            <th>Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("products_management.php");
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Order Management -->
            <div class="content" id="orderManagement" style="display: none;">
                <div class="search-container">
                    <input type="text" placeholder="Tìm kiếm">
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã đơn hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Ngày đặt hàng</th>
                            <th>Địa chỉ</th>
                            <th>Tổng tiền</th>
                            <th>Hình thức thanh toán</th>
                            <th>Số lượng</th>
                            <th>Trạng thái</th>
                            <th>Xem chi tiết</th>
                            <th>Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("order_management.php");
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="editUser" id="editUser" class="hidden">
                <form id="editUserForm" method="post">
                    <table>
                        <tr>
                            <td>Loại tài khoản:</td>
                            <td>
                                <select id="editRole" name="role">
                                    <option value="1">Admin</option>
                                    <option value="0">User</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Tên tài khoản:</td>
                            <td><input id="editUsername" name="username" type="text" readonly></td>
                        </tr>
                        <tr>
                            <td>Họ tên:</td>
                            <td><input id="editFullname" name="fullname" type="text"></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><input id="editEmail" name="email" type="text"></td>
                        </tr>
                        <tr>
                            <td>Số điện thoại:</td>
                            <td><input id="editPhone" name="phone" type="text"></td>
                        </tr>
                        <tr>
                            <td>Địa chỉ:</td>
                            <td><input id="editAddress" name="address" type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center;">
                                <input type="submit" value="Lưu">
                                <input type="button" value="Hủy" onclick="hideEditForm()">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="dashboard.js"></script>