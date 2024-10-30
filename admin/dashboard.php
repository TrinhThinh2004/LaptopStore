<?php
include_once("../includes/connect.php");
?>


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
                        $sql = "SELECT username, password, email, full_name, phone_number, address, role FROM users";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Hiển thị dữ liệu trong bảng HTML
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<th><input type='checkbox'></th>";
                                echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['password']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['full_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['phone_number']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                                $role = $row['role'] == 0 ? "User" : "Admin";
                                echo "<td>" . htmlspecialchars($role) . "</td>";
                                echo "<td>
                                <div class='action-buttons' style='justify-content: center; color: red; cursor:pointer'>
                                    <a href='#'><i class='fa-regular fa-pen-to-square'></i></a>
                                    <a href='#' onclick='deleteUser(this)'><i class='fa-regular fa-circle-xmark'></i></a>
                                </div>
                            </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr>
                            <td colspan='6'>Không có dữ liệu</td>
                        </tr>";
                        }
                        ?>
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
    if (confirm("Bạn có chắc chắn muốn xóa người dùng này không?")) {
        var row = anchorElement.closest('tr');
        row.parentNode.removeChild(row);
    }
}
</script>