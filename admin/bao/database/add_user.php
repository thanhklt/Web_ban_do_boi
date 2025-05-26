<?php
require_once("../../../db/db_connect.php");
$conn = connectDB();
$conn->set_charset("utf8mb4");

try {
    $conn->begin_transaction();

    // 1. Dữ liệu người dùng
    $username = trim($_POST['username'] ?? '');
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone_number'] ?? '');
    $password = $_POST['password'] ?? '';
    $role_id = (int)($_POST['role_id'] ?? 2);
    $created_at = date("Y-m-d H:i:s");
    $deleted = 0;

    // 2. Dữ liệu địa chỉ
    $address_name = trim($_POST['address_name'] ?? '');
    $district = trim($_POST['district'] ?? '');
    $province = trim($_POST['province'] ?? '');
    $street = trim($_POST['street'] ?? '');
    $thumbnail = "user_thumbnail/default.jpg";
    // 3. Thêm người dùng
    $stmtU = $conn->prepare("INSERT INTO `user` 
        (username, fullname, email, phone_number, password, role_id, created_at, deleted, thumbnail) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmtU) throw new Exception("Lỗi SQL: " . $conn->error);

    $stmtU->bind_param("sssssisis", $username, $fullname, $email, $phone, $password, $role_id, $created_at, $deleted, $thumbnail);
    $stmtU->execute();
    $user_id = $conn->insert_id;
    $stmtU->close();

    // // 4. Upload ảnh đại diện
    // if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
    //     $uploadDir = "../../assets/user_thumbnail/";
    //     if (!file_exists($uploadDir)) {
    //         mkdir($uploadDir, 0777, true);
    //     }

    //     $fileType = mime_content_type($_FILES['thumbnail']['tmp_name']);
    //     $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
    //     if (!in_array($fileType, $allowedTypes)) {
    //         throw new Exception("Chỉ chấp nhận ảnh JPEG, PNG hoặc WebP.");
    //     }

    //     $newFilename = $user_id . ".jpg";
    //     $targetPath = $uploadDir . $newFilename;

    //     // Chuyển ảnh sang JPG nếu cần
    //     if ($fileType === 'image/jpeg') {
    //         move_uploaded_file($_FILES['thumbnail']['tmp_name'], $targetPath);
    //     } else {
    //         $image = match ($fileType) {
    //             'image/png' => imagecreatefrompng($_FILES['thumbnail']['tmp_name']),
    //             'image/webp' => imagecreatefromwebp($_FILES['thumbnail']['tmp_name']),
    //             default => null
    //         };
    //         if (!$image) throw new Exception("Không thể xử lý ảnh.");
    //         imagejpeg($image, $targetPath, 90);
    //         imagedestroy($image);
    //     }

    //     // Đường dẫn lưu trong DB (dùng để hiển thị trên web)
    //     // $thumbnailPath = "user_thumbnail/" . $newFilename;
    //     $thumbnailPath = "user_thumbnail/default.jpg";
    //     $stmtThumb = $conn->prepare("UPDATE `user` SET thumbnail = ? WHERE user_id = ?");
    //     $stmtThumb->bind_param("si", $thumbnailPath, $user_id);
    //     $stmtThumb->execute();
    //     $stmtThumb->close();
    // }

    // 5. Thêm địa chỉ
    $stmtA = $conn->prepare("INSERT INTO `address` (user_id, address_name, district, street, province) 
                             VALUES (?, ?, ?, ?, ?)");
    if (!$stmtA) throw new Exception("Lỗi SQL địa chỉ: " . $conn->error);
    $stmtA->bind_param("issss", $user_id, $address_name, $district, $street, $province);
    $stmtA->execute();
    $stmtA->close();

    $conn->commit();
    header("Location: ../nguoiDung.php?success=1");
    exit;

} catch (Exception $e) {
    $conn->rollback();
    if (isset($targetPath) && file_exists($targetPath)) {
        unlink($targetPath);
    }
    die("Lỗi: " . htmlspecialchars($e->getMessage()));
}
?>
