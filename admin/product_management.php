<?php
$sql = "SELECT L.brand, L.price, L.description, L.stock_quantity ,L.deleted, L.laptop_id, MAX(LI.image_url) AS image_url
FROM laptops L 
JOIN laptop_images LI ON L.laptop_id = LI.laptop_id
WHERE L.deleted = 0
GROUP BY L.laptop_id, L.brand, L.price";
$result = $conn->query($sql);
$counter = 1;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $counter . "</td>";
        echo "<td><img src='" . "../" . htmlspecialchars($row['image_url']) . "' alt='Laptop Image' style='width: 100px; height: auto;'></td>";
        echo "<td>" . htmlspecialchars($row['description']) . "</td>";
        echo "<td>" . htmlspecialchars($row['brand']) . "</td>";
        echo "<td>" . htmlspecialchars($row['price']) . "</td>";
        echo "<td>" . htmlspecialchars($row['stock_quantity']) . "</td>";
        echo "<td>
             <div class='action-buttons' style='color: red; cursor:pointer; text-align: center;'>
                    <a href='#' onclick='deleteProduct(this)' data-laptopid='{$row['laptop_id']}'><i class='fa-regular fa-circle-xmark'></i></a>
            </div>
            </td>";
        echo "</tr>";
        $counter++;
    }
} else {
    echo "<tr><td colspan='8'>Không có dữ liệu</td></tr>";
}
?>
