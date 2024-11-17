<?php
$sql = "SELECT user_id ,username, password, email, full_name, phone_number, address, role FROM users WHERE deleted = 0";
$result = $conn->query($sql);
$counter = 1;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $counter . "</td>";
        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
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
                    <a href='#' onclick='deleteUser(this)' data-userid='{$row['user_id']}'><i class='fa-regular fa-circle-xmark'></i></a>
            </div>
            </td>";
        echo "</tr>";
        $counter++;
    }
} else {
    echo "<tr><td colspan='8'>Không có dữ liệu</td></tr>";
}
