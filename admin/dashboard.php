<link rel="stylesheet" href="../assets/css/admin/dashboard.css">
<link rel="stylesheet" href="../assets/css/base.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {});
</script>

<?php
include("header_admin.php");
?>

<div class="grid">
    <div class="dashboard-container">
        <div class="admin-sidebar">
            <ul>
                <li><a href="products.php">Trang chủ Admin</a></li>
                <li><a href="#" onclick="showCards()">Dashboard</a></li>
                <li><a href="products.php">Quản lý sản phẩm</a></li>
                <li><a href="products.php">Quản lý danh mục sản phẩm</a></li>
                <li><a href="#" onclick="showOrderManagement()">Quản lý đơn hàng</a></li>
                <li><a href="#" onclick="showUserManagement()">Quản lý người dùng</a></li>
                <li><a href="../logout.php">Đăng xuất</a></li>
            </ul>
        </div>
        <div class="dashboard">
            <div class="cards-container" id="cards">
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

            <div class="content" id="userManagement" style="display: none;">
                <div class="search-container">
                    <input type="text" placeholder="Tìm kiếm">
                    <button class="btn btn-add">Thêm mới</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th><input type="checkbox"></th>
                            <th>ID</th>
                            <th>Họ tên</th>
                            <th>Quyền hạn</th>
                            <th>Hiển thị</th>
                            <th>Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th><input type="checkbox"></th>
                            <td>1</td>
                            <td>Administrator</td>
                            <td>Administrator</td>
                            <td>Hiện</td>
                            <td>
                                <div class="action-buttons" style="justify-content: center; color: red; cursor:pointer">
                                    <a href="#"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a href="#" onclick="deleteUser(this)"><i class="fa-regular fa-circle-xmark"></i></a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="content" id="orderManagement" style="display: none;">
                <div class="search-container">
                    <input type="text" placeholder="Tìm kiếm">
                    <button class="btn btn-add">Thêm mới</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th><input type="checkbox"></th>
                            <th>Mã đơn hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Ngày đặt hàng</th>
                            <th>Địa chỉ</th>
                            <th>Hình thức</th>
                            <th>Trạng thái</th>
                            <th>Xem chi tiết</th>
                            <th>Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th><input type="checkbox"></th>
                            <td>DHMS5</td>
                            <td>Hoàng Minh</td>
                            <td>14-06-2017</td>
                            <td>Quận 12, TPHCM</td>
                            <td>Chuyển khoản</td>
                            <td>Đã duyệt</td>
                            <td><a href="#">Xem chi tiết</a></td>
                            <td>
                                <div class="action-buttons" style="justify-content: center; color: red;">
                                    <a href="#"><i class="fa-solid fa-check"></i></a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- <form action="" method="post">
                <div class="addUser" id="addUser" style="display: block;">
                    <table>
                        <tr>
                            <td>Loại tài khoản:</td>
                            <td>
                                <select>
                                    <option>Admin</option>
                                    <option>User</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Tên tài khoản:</td>
                            <td><input id="username" name="username" type="text"></td>
                        </tr>
                        <tr>
                            <td>Họ tên:</td>
                            <td><input id="fullname" name="fullname" type="text"></td>
                        </tr>

                        <tr>
                            <td>Mật khẩu:</td>
                            <td><input id="password" name="password" type="password"></td>
                        </tr>
                        <tr>
                            <td>Nhập lại mật khẩu:</td>
                            <td><input id="password" name="password" type="password"></td>
                        </tr>
                        <tr>
                            <td>Hiển thị:</td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center;">
                                <input type="submit" value="Lưu">
                                <input type="reset" value="Thoát">
                            </td>
                        </tr>
                    </table>
                </div>
            </form> -->
        </div>
    </div>
</div>

<script>
    function toggleDisplay(showId, hideId) {
        document.getElementById(showId).style.display = 'block';
        document.getElementById(hideId).style.display = 'none';
    }

    function showUserManagement() {
        toggleDisplay('userManagement', 'orderManagement');
        toggleDisplay('userManagement', 'cards');
    }

    function showOrderManagement() {
        toggleDisplay('orderManagement', 'userManagement');
        toggleDisplay('orderManagement', 'cards');
    }

    function showCards() {
        toggleDisplay('cards', 'userManagement');
        toggleDisplay('cards', 'orderManagement');
    }

    function deleteUser(anchorElement) {
        var row = anchorElement.closest('tr');
        row.parentNode.removeChild(row);
    }
</script>