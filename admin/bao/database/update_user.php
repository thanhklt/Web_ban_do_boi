<?php
require_once("../../../db/db_connect.php");

$conn = connectDB();
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Nhận dữ liệu từ form
$id = $_POST['id'] ?? null;
$fullname = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$username = $_POST['username'] ?? '';
$phone = $_POST['phonenumber'] ?? '';
$id_role = $_POST['id_roleRepair'] == 1 ? 1 : 2; // Giả sử 1 là admin, 2 là user
$updated_at = date("Y-m-d H:i:s");

if (!$id) {
    die("Thiếu ID người dùng.");
}

// Nếu có upload ảnh mới
if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === 0) {
    $thumbnail = basename($_FILES['thumbnail']['name']);
    $target_dir = "../assest/image/";
    $target_file = $target_dir . $thumbnail;

    if (!move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target_file)) {
        die("Lỗi khi upload ảnh.");
    }
} else {
    // Lấy ảnh cũ từ DB nếu không upload ảnh mới
    $stmt_thumb = $conn->prepare("SELECT thumbnail FROM user WHERE user_id = ?");
    $stmt_thumb->bind_param("i", $id);
    $stmt_thumb->execute();
    $result = $stmt_thumb->get_result();
    $thumbnail = $result->fetch_assoc()['thumbnail'] ?? '';
    $stmt_thumb->close();
}

// Chuẩn bị câu truy vấn cập nhật
$sql = "UPDATE user 
        SET fullname = ?, email = ?, phone_number = ?, username = ?, password = ?, role_id = ?, updated_at = ?, thumbnail = ?
        WHERE user_id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Lỗi prepare: " . $conn->error);
}

$stmt->bind_param("ssssssssi", $fullname, $email, $phone, $username, $password, $id_role, $updated_at, $thumbnail, $id);

if ($stmt->execute()) {
    header("Location: ../nguoiDung.php");
    exit();
} else {
    echo "Cập nhật thất bại: " . $stmt->error;
}

$stmt->close();
$conn->close();
