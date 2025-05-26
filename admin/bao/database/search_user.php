
<?php
require_once("../../../db/db_connect.php");

$conn = connectDB();
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$query = $_GET['query'] ?? '';
$query = $conn->real_escape_string($query);

$sql = "SELECT u.*, r.role_id
        FROM user u
        JOIN role r ON u.role_id = r.role_id 
        WHERE fullname LIKE '%$query%' OR email LIKE '%$query%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Hiển thị từng sản phẩm
    while ($row = $result->fetch_assoc()) {
        $role = ($row['role_id'] == 1) ? "Admin" : "Khách hàng";
        echo "<tr>
<td>
    <div class='user-container'>
    
    <img src='assest/image/" . $row['thumbnail'] . "'. style='width: 100px; height: 100px;'>
    <i class='fa-solid fa-pen edit-icon'
            data-id='" . $row['user_id'] . "'
            data-name='" . htmlspecialchars($row['fullname'], ENT_QUOTES) . "'
            data-username='" . htmlspecialchars($row['username'], ENT_QUOTES) . "'
            data-role='" . htmlspecialchars($row['role_id'], ENT_QUOTES) . "'
            data-email='" . htmlspecialchars($row['email'], ENT_QUOTES) . "'
            data-password='" . htmlspecialchars($row['password'], ENT_QUOTES) . "'
            data-phoneNumber='" . $row['phone_number'] . "'>
        </i> 
        <i class='fa-solid fa-trash delete-icon' title='Xóa người dùng'></i>
    </div>

    <div>
        <p class='name_user'>" . $row['fullname'] . " - $role</p>
    </div> 
    
</td>
<td>" . "ND" . $row['user_id'] . "</td>
<td>" . $row['email'] . "</td>
<td>" . $row['password'] . "</td>
<td>" . $row['phone_number'] . "</td>
<td>
<button class='block' onClick='toggleLock(this)'>
        " . ($row['deleted'] ? "Mở khóa" : "Khóa") . "
</button>
</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>Không có người dùng nào.</td></tr>";
}
$conn->close();
?>
<script src="logic/dialog.js"></script>