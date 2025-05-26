<?php
require_once("../../../db/db_connect.php");
header('Content-Type: application/json');

$conn = connectDB();
// Kết nối database
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Lỗi kết nối database"]));
}

$productId = $_POST['id'] ?? null;
if (!$productId || !is_numeric($productId)) {
    die(json_encode(["success" => false, "message" => "ID sản phẩm không hợp lệ"]));
}

try {
    // Tắt autocommit để rollback nếu có lỗi
    $conn->autocommit(false);

    // Kiểm tra xem sản phẩm có tồn tại trong order_items (đã bán hay chưa)
    $checkSold = $conn->query("SELECT COUNT(*) AS sold FROM order_items WHERE product_id = $productId");
    $soldRow = $checkSold->fetch_assoc();
    if ($soldRow['sold'] > 0) {
        // Nếu sản phẩm đã bán, không cho phép xóa
        echo json_encode(["success" => false, "message" => "Sản phẩm đang được bán, không thể xóa"]);
        exit;
    }

    // 2. Xóa sản phẩm trong bảng product
    $deleteProduct = $conn->query("DELETE FROM product WHERE product_id = $productId");

    if ($deleteProduct) {
        $conn->commit();
        echo json_encode(["success" => true, "message" => "Xóa sản phẩm thành công"]);
    } else {
        $conn->rollback();
        echo json_encode(["success" => false, "message" => "Lỗi khi xóa sản phẩm"]);
    }
} catch (mysqli_sql_exception $e) {
    $conn->rollback();
    echo json_encode(["success" => false, "message" => "Lỗi database: " . $e->getMessage()]);
} finally {
    $conn->close();
}
?>
