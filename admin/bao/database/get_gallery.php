<?php
require_once("../../../db/db_connect.php");
// Kết nối đến CSDL
$conn = connectDB();
$conn->set_charset("utf8mb4");

// Kiểm tra kết nối
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Kết nối CSDL thất bại"]);
    exit;
}

// Lấy product_id từ tham số GET
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

if ($product_id <= 0) {
    http_response_code(400);
    echo json_encode(["error" => "ID sản phẩm không hợp lệ"]);
    exit;
}

// Truy vấn ảnh từ bảng gallery
$sql = "SELECT thumbnail FROM gallery WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();

$result = $stmt->get_result();
$thumbnails = [];

while ($row = $result->fetch_assoc()) {
    $thumbnails[] = $row;
}

echo json_encode($thumbnails);
?>
