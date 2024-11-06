<?php
include_once("../includes/connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'delete' && isset($_POST['username'])) {
        $username = $conn->real_escape_string($_POST['username']);

        $checkRoleSql = "SELECT role FROM users WHERE username = '$username'";
        $result = $conn->query($checkRoleSql);
        $row = $result->fetch_assoc();

        if ($row['role'] == 1) {
            http_response_code(403); 
            echo "Không thể xóa tài khoản admin.";
        } else {
            $deleteSql = "UPDATE users SET deleted = 1 WHERE username = '$username'";
            if ($conn->query($deleteSql) === TRUE) {
                http_response_code(200);
                echo "Xóa người dùng thành công.";
            } else {
                http_response_code(500);
                echo "Xóa người dùng không thành công.";
            }
        }
        exit;
    } if ($_POST['action'] == 'update' && isset($_POST['username'], $_POST['fullname'], $_POST['email'], $_POST['phone'], $_POST['address'], $_POST['role'])) {
        $username = $conn->real_escape_string($_POST['username']);
        $fullname = $conn->real_escape_string($_POST['fullname']);
        $email = $conn->real_escape_string($_POST['email']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $address = $conn->real_escape_string($_POST['address']);
        $role = intval($_POST['role']);


        $updateSql = "UPDATE users SET full_name = '$fullname', email = '$email', phone_number = '$phone', address = '$address', role = $role WHERE username = '$username'";

        if ($conn->query($updateSql) === TRUE) {
            http_response_code(200);
            echo "Thông tin người dùng đã được cập nhật thành công.";
        } else {
            http_response_code(500);
            echo "Cập nhật thông tin không thành công: " . $conn->error;
        }
        exit;
    }
}
?>

<link rel="stylesheet" href="../assets/css/admin/dashboard.css">
<link rel="stylesheet" href="../assets/css/base.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

<?php include("header_admin.php"); ?>

<div class="grid">
    <div class="dashboard-container">
        <div class="admin-sidebar">
            <ul>
                <li style="color: white;">Trang chủ Admin</li>
                <li><a href="#" onclick="showCards()">Dashboard</a></li>
                <li><a href="products.php">Quản lý sản phẩm</a></li>
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
                        $sql = "SELECT username, password, email, full_name, phone_number, address, role FROM users WHERE deleted = 0";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['password']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['full_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['phone_number']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['role'] == 0 ? "User" : "Admin") . "</td>";
                                echo "<td>
                                    <div class='action-buttons' style='color: red; cursor:pointer'>
                                        <a href='#' onclick=\"showEditForm({
                                            username: '{$row['username']}',
                                            full_name: '{$row['full_name']}',
                                            email: '{$row['email']}',
                                            phone_number: '{$row['phone_number']}',
                                            address: '{$row['address']}'
                                        })\"><i class='fa-regular fa-pen-to-square'></i></a>
                                        <a href='#' onclick='deleteUser(this)' data-username='{$row['username']}'><i class='fa-regular fa-circle-xmark'></i></a>
                                    </div>
                                </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>Không có dữ liệu</td></tr>";
                        }
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
                            <td>DHMS5</td>
                            <td>Hoàng Minh</td>
                            <td>14-06-2017</td>
                            <td>Quận 12, TPHCM</td>
                            <td>Chuyển khoản</td>
                            <td>Đã duyệt</td>
                            <td><a href="#">Xem chi tiết</a></td>
                            <td>
                                <div class="action-buttons" style="color: red;">
                                    <a href="#"><i class="fa-solid fa-check"></i></a>
                                </div>
                            </td>
                        </tr>
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

    //Xóa user
    function deleteUser(anchorElement) {
        if (confirm("Bạn có chắc chắn muốn xóa người dùng này không?")) {
            var username = anchorElement.getAttribute("data-username");

            fetch(window.location.href, {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "username=" + encodeURIComponent(username) + "&action=delete"
            }).then(response => {
                if (response.ok) {
                    anchorElement.closest('tr').remove();
                    alert("Xóa người dùng thành công !");
                } else {
                    alert("Xóa người dùng không thành công !");
                }
            });
        }
    }


    function showEditForm(user) {
        document.getElementById("editUsername").value = user.username;
        document.getElementById("editFullname").value = user.full_name;
        document.getElementById("editEmail").value = user.email;
        document.getElementById("editPhone").value = user.phone_number;
        document.getElementById("editAddress").value = user.address;
        document.getElementById("editRole").value = user.role === "Admin" ? 1 : 0;

        document.getElementById("userManagement").style.display = "none";
        document.getElementById("editUser").classList.remove("hidden");
    }

    //Ẩn form khi ấn hủy
    function hideEditForm() {
        document.getElementById("userManagement").style.display = "block";
        document.getElementById("editUser").classList.add("hidden");
    }

    document.getElementById("editUserForm").addEventListener("submit", function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        formData.append("action", "update");

        fetch(window.location.href, {
                method: "POST",
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    return response.text(); // Only parse response if successful
                } else {
                    throw new Error('Network response was not ok.');
                }
            })
            .then(data => {
                alert(data);
                hideEditForm();
                location.reload();
            })
            .catch(error => {
                alert("Cập nhật không thành công: " + error); // Display more specific error
                console.error("Error during update:", error);
            });
    });

    // Ẩn form khi load trang
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('editUser').classList.add('hidden');
    });
</script>