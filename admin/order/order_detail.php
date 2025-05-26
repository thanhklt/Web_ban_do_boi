<?php
require_once __DIR__ . '/../../db/db_connect.php'; // Kết nối CSDL

$conn = connectDB();
if (!isset($_GET['order_id'])) {
  http_response_code(400);
  exit(json_encode(['error'=>'Missing order_id']));
}
$order_id = (int)$_GET['order_id'];

// 1) Lấy metadata đơn hàng và tổng tiền
$sqlMeta = "
  SELECT o.order_id, o.fullname, o.order_date,
         SUM(oi.price * oi.num) AS total_amount
  FROM `Order` AS o
  JOIN Order_items AS oi ON o.order_id = oi.order_id
  WHERE o.order_id = ?
  GROUP BY o.order_id, o.fullname, o.order_date
";
$stmt = $conn->prepare($sqlMeta);
$stmt->bind_param('i', $order_id);
$stmt->execute();
$meta = $stmt->get_result()->fetch_assoc();
$stmt->close();

// 2) Lấy danh sách sản phẩm trong đơn
$sqlItems = "
  SELECT oi.product_id, p.title AS product_name, oi.num AS quantity
  FROM Order_items AS oi
  JOIN Product AS p ON oi.product_id = p.product_id
  WHERE oi.order_id = ?
";
$stmt = $conn->prepare($sqlItems);
$stmt->bind_param('i', $order_id);
$stmt->execute();
$result = $stmt->get_result();
$items = [];
while ($row = $result->fetch_assoc()) {
  $items[] = $row;
}
$stmt->close();
$conn->close();

// Trả về JSON
header('Content-Type: application/json; charset=utf-8');
echo json_encode([
  'order' => [
    'order_id'     => $meta['order_id'],
    'fullname'     => $meta['fullname'],
    'order_date'   => $meta['order_date'],
    'total_amount' => $meta['total_amount']
  ],
  'items' => $items
]);