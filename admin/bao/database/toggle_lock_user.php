<?php
require_once("../../../db/db_connect.php");
header("Content-Type: application/json");

// Kết nối cơ sở dữ liệu
$conn = connectDB();
$conn->set_charset("utf8mb4");

// Lấy dữ liệu từ yêu cầu
$input = json_decode(file_get_contents('php://input'), true);
if (!isset($input['id'], $input['lock'])) {
  echo json_encode(['success'=>false,'message'=>'Invalid input']);
  exit;
}

$id   = intval($input['id']);
$lock = intval($input['lock']);  // 0 hoặc 1

// SQL
$stmt = $conn->prepare("UPDATE `user` SET `deleted` = ? WHERE `user_id` = ?");
$stmt->bind_param("ii", $lock, $id);

if ($stmt->execute()) {
  echo json_encode(['success'=>true]);
} else {
  echo json_encode(['success'=>false, 'message'=>$stmt->error]);
}
?>