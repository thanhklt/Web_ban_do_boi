<?php
require_once("../../../db/db_connect.php");

$conn = connectDB();
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$title = $_POST['title'] ?? '';
$description = $_POST['description'] ?? '';
$price = $_POST['price'] ?? 0;
$discount = $_POST['discount'] ?? 0;
$size = $_POST['size'] ?? '';
$category_id = $_POST['category_id'] ?? 0;
$brand = $_POST['brand'] ?? '';
$created_at = $updated_at = date("Y-m-d H:i:s");

// Kiểm tra dữ liệu đầu vào
if (!$title || !$description || !$price || !$size || !$category_id) {
    die("Vui lòng điền đầy đủ thông tin!");
}

if (!is_numeric($price) || !is_numeric($discount)) {
    die("Giá và giảm giá phải là số!");
}

// Đường dẫn thư mục lưu ảnh (đảm bảo đường dẫn tương đối để dễ hiển thị)
$uploadDir = "../../../USER/Img_Product/";

// Tạo thư mục nếu chưa tồn tại
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true); // 0777 là quyền ghi đầy đủ
}

// Hàm tạo tên file duy nhất
function generateFileName($originalName) {
    $ext = pathinfo($originalName, PATHINFO_EXTENSION);
    return uniqid() . '.' . $ext; // Ví dụ: "65c3a7b41a12d.jpg"
}
// Xử lý upload ảnh 1
$thumbnail1 = $_FILES['thumbnail_1']['name'];
$newThumbnail1 = generateFileName($thumbnail1);
$targetFilePath1 = $uploadDir . $newThumbnail1;

// Di chuyển file vào thư mục đích
if (!move_uploaded_file($_FILES['thumbnail_1']['tmp_name'], $targetFilePath1)) {
    die("Lỗi khi upload ảnh 1.");
}

// Xử lý upload ảnh 2 (tương tự)
$thumbnail2 = $_FILES['thumbnail_2']['name'];
$newThumbnail2 = generateFileName($thumbnail2);
$targetFilePath2 = $uploadDir . $newThumbnail2;

if (!move_uploaded_file($_FILES['thumbnail_2']['tmp_name'], $targetFilePath2)) {
    die("Lỗi khi upload ảnh 2.");
}

// Đường dẫn tương đối để lưu vào CSDL (phù hợp với hiển thị trên web)
$dbPath1 = "../../USER/Img_Product/" . $newThumbnail1;
$dbPath2 = "../../USER/Img_Product/" . $newThumbnail2;

// Thêm vào bảng product
$sql = "INSERT INTO product (category_id, title, price, discount, thumbnail_1, thumbnail_2, size, description, brand, created_at, updated_at, deleted)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isddsssssss", $category_id, $title, $price, $discount, $dbPath1, $dbPath2, $size, $description, $brand, $created_at, $updated_at);

if ($stmt->execute()) {
    header("Location: ../sanPham.php");
    exit;
} else {
    die("Lỗi khi thêm sản phẩm: " . $stmt->error);
}
?>
