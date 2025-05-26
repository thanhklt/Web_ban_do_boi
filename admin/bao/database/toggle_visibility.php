<?php
require_once("../../../db/db_connect.php");
$conn = connectDB();
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    echo json_encode(["success" => false, "error" => "Connection failed"]);
    exit();
}

$id = $_POST['id'] ?? null;
$current = $_POST['current'] ?? null;

if ($id === null || $current === null) {
    echo json_encode(["success" => false, "error" => "Missing parameters"]);
    exit();
}

// Đổi trạng thái (nếu là 0 thì thành 1, ngược lại)
$new_status = $current == 0 ? 1 : 0;

$stmt = $conn->prepare("UPDATE product SET deleted = ? WHERE product_id = ?");
$stmt->bind_param("ii", $new_status, $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "new_status" => $new_status]);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}
$conn->close();
?>
