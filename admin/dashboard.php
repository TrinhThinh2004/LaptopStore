<?php
include_once("../includes/connect.php");

if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
    header("Location: dashboard.php");
} else {
    // Nếu vai trò là 0 (user), chuyển hướng đến trang user
    header("Location: index.php");
}
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
                <li><a href="#" onclick="showProductManagement()">Quản lý sản phẩm</a></li>
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
                    <a href="#" onclick="showProductManagement()">
                        <div class="card">
                            <div class="card-icon"><i class="fas fa-laptop"></i></div>
                            <p>120</p>
                            <p>Sản phẩm</p>
                        </div>
                    </a>
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

            <div class="content" id="productManagement" style="display: none;">
                <div class="search-container">
                    <input type="text" placeholder="Tìm kiếm">
                    <button onclick="showAddProductForm()">Thêm</button>
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
                        include("product_management.php");
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

            <div class="editUser hidden" id="editUser">
                <form id="editUserForm" method="post">
                    <input type="hidden" name="action" value="update">
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

            <div class="addProduct hidden" id="addProduct">
                <form id="addProductForm" method="post">
                    <table>
                        <tr>
                            <td>Ảnh sản phẩm</td>
                            <td>
                                <input id="addImage" name="image" type="file" accept="image/*">
                                <div class="preview" id="imagePreview"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Ảnh chi tiết</td>
                            <td>
                                <input id="addMultiImage" name="images" type="file" accept="image/*" multiple>
                                <div class="preview" id="multiImagePreview"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Tên sản phẩm:</td>
                            <td><input id="addProductName" name="productname" type="text"></td>
                        </tr>
                        <tr>
                            <td>Thương hiệu:</td>
                            <td><input id="addBrand" name="brand" type="text"></td>
                        </tr>
                        <tr>
                            <td>CPU</td>
                            <td><input id="addCPU" name="cpu" type="text"></td>
                        </tr>
                        <tr>
                            <td>GPU</td>
                            <td><input id="addGPU" name="gpu" type="text"></td>
                        </tr>
                        <tr>
                            <td>RAM</td>
                            <td><select name="ram" id="addRAM">
                                    <option value="4">4GB</option>
                                    <option value="8">8GB</option>
                                    <option value="16">16GB</option>
                                    <option value="32">32GB</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Loại RAM</td>
                            <td><select id="addRAMType" name="ram_type">
                                    <option value="DDR4">DDR4</option>
                                    <option value="DDR5">DDR5</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Bus RAM</td>
                            <td><select id="addRAMSpeed" name="ram_speed">
                                    <option value="2400 Mhz">2400Mhz</option>
                                    <option value="3200 Mhz">3200Mhz</option>
                                    <option value="4800 Mhz">4800Mhz</option>
                                    <option value="5600 Mhz">5600Mhz</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Kích thước màn hình</td>
                            <td><input id="addScreenSize" name="screen_size" type="text"></td>
                        </tr>
                        <tr>
                            <td>Độ phân giải</td>
                            <td><select id="addScreenResolution" name="screen_resolution">
                                    <option value="Full HD">Full HD</option>
                                    <option value="2.5K">2.5K</option>
                                    <option value="4K">4K</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Tần số quét</td>
                            <td><select id="addScreenRefreshRate" name="screen_refresh_rate">
                                    <option value="60Hz">60Hz</option>
                                    <option value="120Hz">120Hz</option>
                                    <option value="144Hz">144Hz</option>
                                    <option value="165Hz">165Hz</option>
                                    <option value="240Hz">240Hz</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Ổ cứng</td>
                            <td><select id="addStorage" name="storage">
                                    <option value="256">256 GB</option>
                                    <option value="512">512 GB</option>
                                    <option value="1024">1 TB</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Loại ổ cứng</td>
                            <td><select id="addStorageType" name="storage_type">
                                    <option value="SSD Sata">SSD Sata</option>
                                    <option value="SSD NVMe Gen 3x4">SSD NVMe Gen 3x4</option>
                                    <option value="SSD NVMe Gen 4x4">SSD NVMe Gen 4x4</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Giá</td>
                            <td><input id="addPrice" name=price" type="text"></td>
                        </tr>
                        <tr>
                            <td>Số lượng</td>
                            <td><input id="addStockQuantity" name="stock_quantity" type="text"></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center;">
                                <input type="submit" value="Lưu">
                                <input type="button" value="Hủy" onclick="hideEdit()">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="dashboard.js"></script>