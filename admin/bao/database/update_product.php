<?php
require_once("../../../db/db_connect.php");
$conn = connectDB();
$conn->set_charset("utf8mb4");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy dữ liệu từ form
$id = preg_replace('/[^0-9]/', '', $_POST['id']);
$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$discount = isset($_POST["discount"]) && is_numeric($_POST["discount"]) ? $_POST["discount"] : 0;
$size = $_POST['size'];
$brand = $_POST['brand'];
$category_id = $_POST['category_id'];
$updated_at = date("Y-m-d H:i:s");

// Đường dẫn thực tế lưu ảnh
$uploadDir = realpath(__DIR__ . "/../../../USER/Img_Product/") . "/";

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Lấy thông tin ảnh cũ từ DB
$thumbnail_1 = $thumbnail_2 = "";
$stmt_img = $conn->prepare("SELECT thumbnail_1, thumbnail_2 FROM product WHERE product_id = ?");
$stmt_img->bind_param("i", $id);
$stmt_img->execute();
$result_img = $stmt_img->get_result();
if ($result_img->num_rows > 0) {
    $row = $result_img->fetch_assoc();
    $thumbnail_1 = $row['thumbnail_1'];
    $thumbnail_2 = $row['thumbnail_2'];
}
$stmt_img->close();

// Upload thumbnail_1 nếu có file mới
if (isset($_FILES['thumbnail_1']) && $_FILES['thumbnail_1']['error'] === 0) {
    $new_name_1 = basename($_FILES['thumbnail_1']['name']);
    move_uploaded_file($_FILES['thumbnail_1']['tmp_name'], $uploadDir . $new_name_1);
    $thumbnail_1 = '../Img_Product/' . $new_name_1; // đường dẫn lưu trong DB
}

// Upload thumbnail_2 nếu có file mới
if (isset($_FILES['thumbnail_2']) && $_FILES['thumbnail_2']['error'] === 0) {
    $new_name_2 = basename($_FILES['thumbnail_2']['name']);
    move_uploaded_file($_FILES['thumbnail_2']['tmp_name'], $uploadDir . $new_name_2);
    $thumbnail_2 = '../Img_Product/' . $new_name_2;
}

// Cập nhật sản phẩm
$sql = "UPDATE product SET category_id = ?, title = ?, price = ?, discount = ?, thumbnail_1 = ?, thumbnail_2 = ?, size = ?, description = ?, brand = ?, updated_at = ? WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isddssssssi", $category_id, $title, $price, $discount, $thumbnail_1, $thumbnail_2, $size, $description, $brand, $updated_at, $id);

if ($stmt->execute()) {
    header("Location: ../sanPham.php");
    exit();
} else {
    die("Lỗi khi cập nhật dữ liệu: " . $stmt->error);
}
?>
