<?php
require_once '../../db/db_connect.php';
$conn = connectDB();

// 1) Lấy params
$user_id   = isset($_GET['user_id'])   ? intval($_GET['user_id']) : 0;
$date_from = $_GET['date_from'] ?? '1970-01-01';
$date_to   = $_GET['date_to']   ?? date('Y-m-d');
$from      = $date_from . ' 00:00:00';
$to        = $date_to   . ' 23:59:59';

// 2) Lấy thông tin user
$stmtU = $conn->prepare("SELECT fullname, email FROM `user` WHERE user_id = ?");
$stmtU->bind_param('i', $user_id);
$stmtU->execute();
$userInfo = $stmtU->get_result()->fetch_assoc();

// 3) Lấy orders và items như trước
$sql = "
  SELECT o.order_id, o.order_date,
         SUM(oi.price*oi.num) AS total_amount
  FROM `order` AS o
  JOIN `order_items` AS oi ON o.order_id = oi.order_id
  WHERE o.user_id = ? 
    AND o.order_date BETWEEN ? AND ?
  GROUP BY o.order_id, o.order_date
  ORDER BY o.order_date DESC
";
$stmt = $conn->prepare($sql);
$stmt->bind_param('iss', $user_id, $from, $to);
$stmt->execute();
$res = $stmt->get_result();

$orders = [];
while ($o = $res->fetch_assoc()) {
  // fetch items
  $q2 = $conn->prepare("
    SELECT oi.product_id, p.title AS product_name, oi.num, oi.price
    FROM `order_items` AS oi
    JOIN `product` AS p ON p.product_id = oi.product_id
    WHERE oi.order_id = ?
  ");
  $q2->bind_param('i', $o['order_id']);
  $q2->execute();
  $o['items'] = $q2->get_result()->fetch_all(MYSQLI_ASSOC);
  $orders[] = $o;
}

// 4) Xuất JSON gồm cả user và orders
header('Content-Type: application/json; charset=utf-8');
echo json_encode([
  'user'   => $userInfo,
  'orders' => $orders
], JSON_UNESCAPED_UNICODE);
