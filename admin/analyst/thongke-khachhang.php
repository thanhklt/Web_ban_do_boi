<?php
require_once "../../db/db_connect.php";
$conn = connectDB();

$sqlOrders = "
  SELECT 
    u.fullname,
    COUNT(DISTINCT o.order_id) AS total_orders
  FROM `order` AS o
  JOIN `user` AS u ON o.user_id = u.user_id
  GROUP BY o.user_id
  ORDER BY total_orders DESC
  LIMIT 5
";
$resOrders = $conn->query($sqlOrders);
$topOrders = [];
if ($resOrders) {
    while ($r = $resOrders->fetch_assoc()) {
        $topOrders[] = $r;
    }
}


$all      = isset($_GET['all']);
$rawDateFrom = isset($_GET['date_from']) ? $_GET['date_from'] : '';
$rawDateTo   = isset($_GET['date_to'])   ? $_GET['date_to']   : '';

// --- 2. Chuyển sang datetime cho WHERE clause ---
$dateFrom = $rawDateFrom ? $rawDateFrom . ' 00:00:00' : null;
$dateTo   = $rawDateTo   ? $rawDateTo   . ' 23:59:59' : null;

$stmt = null;
// TH nút all được chọn
// --- 3. Truy vấn Top 5 theo tổng tiền mua trong khoảng ---
$where  = [];
$params = [];
$types  = '';

if ($dateFrom) {
    $where[]  = 'o.order_date >= ?';
    $params[] = $dateFrom;
    $types   .= 's';
}
if ($dateTo) {
    $where[]  = 'o.order_date <= ?';
    $params[] = $dateTo;
    $types   .= 's';
}

$sql = "
  SELECT
    u.fullname,
    u.user_id,
    COUNT(DISTINCT o.order_id)    AS total_orders,
    SUM(oi.price * oi.num)        AS total_amount
  FROM `order` AS o
  JOIN `Order_items` AS oi ON o.order_id = oi.order_id
  JOIN `user`       AS u  ON o.user_id  = u.user_id
";
if (count($where) > 0) {
    $sql .= ' WHERE ' . implode(' AND ', $where);
}
$sql .= "
  GROUP BY o.user_id
  ORDER BY total_amount DESC
  LIMIT 5
";

$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$res = $stmt->get_result();

$topSpenders = [];
while ($row = $res->fetch_assoc()) {
    $topSpenders[] = $row;
}

$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê</title>
    <link rel="stylesheet" href="./sidebar.css" />
    <link rel="stylesheet" href="./thongke-khachhang.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />

</head>
<body>
    <div class="container">
        <!--Start aside-->
        <aside>
            <div class="top">
                <div class="logo">
                    <a href="../../dashboard.php"><img src="../../assets/admin/logo.png" alt="logo"></a>
                </div>
                <div class="close" id="close_btn">
                    <img src="../../assets/admin/icon/x-icon.svg" alt="sharp"/>
                    
                </div>
            </div>
            <!-- end top  -->

            <div class="sidebar">
                <a href="../../dashboard.php">
                    <img src="../../assets/admin/icon/grid-view.svg" alt="grid-view" />
                    <h3>Trang chủ</h3>
                </a>
                <a href="../bao/nguoiDung.php" >
                    <img src="../../assets/admin/icon/customer-icon.svg" alt="grid-view" />
                    <h3>Khách hàng</h3>
                </a>
                <a href="./thongke-donhang.html" class="active">
                    <img src="../../assets/admin/icon/trendup-icon.svg" alt="grid-view" />
                    <h3>Phân tích</h3>
                </a>
                <a href="">
                    <img src="../../assets/admin/icon/mail-icon.svg" alt="grid-view" />
                    <h3>Tin nhắn</h3>
                    <p class="msg-count">10</p>
                </a>
                <a href="../order/quanlydon.php">
                    <img src="../../assets/admin/icon/receiptlong-icon.svg" alt="grid-view" />
                    <h3>Đơn hàng</h3>
                </a>
                <a href="">
                    <img src="../../assets/admin/icon/report-icon.svg" alt="grid-view" />
                    <h3>Báo cáo</h3>
                </a>
                <a href="">
                    <img src="../../assets/admin/icon//setting-icon.svg" alt="grid-view" />
                    <h3>Cài đặt</h3>
                </a>
                <a href="../bao/sanPham.php">
                    <img src="../../assets/admin/icon/add-icon.svg" alt="grid-view" />
                    <h3>Thêm sản phẩm</h3>
                </a>
                <a href="../../Bảo/index.html">
                    <img src="../../assets/admin/icon/logout-icon.svg" alt="grid-view" />
                    <h3>Đăng xuất</h3>
                </a>
            </div>
         </aside>
        <!--End aside-->

        <!--Start main-->
        <main>
            <div class="top">
                <!-- Top menu start-->
                <div class="top-menu">
                    <button id="menu_bar">
                        <span class="material-symbols-sharp">menu</span>
                    </button>
                    <h1>Business Statistics</h1>
                    <div class="thong-ke-top">
                        <div class="infor">
                            <h3>Tỷ lệ đơn hàng chưa sẵn sàng</h3>
                            <small class="text-muted">Trong tuần qua</small>
                        </div>
                        <h5 class="danger">+3%</h5>
                    </div>
                    <div class="thong-tin-co-ban">
                        <div class="theme-toggler">
                            <span class="material-symbols-sharp active">light_mode</span>
                            <span class="material-symbols-sharp">dark_mode</span>
                        </div>
                        <div class="profile">
                            <div class="infor">
                                <h3>Xin chào,</h3>
                                <small class="text-muted"></small>
                            </div>
                            <div class="profile-photo">
                                <img src="../../assets/admin/admin-avatar.gif" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
                <!--Top menu end-->
            </div>
            
            <div class="middle">
                <!--Start bieu do-->
                <div class="bieu-do">
                    <iframe title="Thống kê doanh thu" aria-label="Multiple Lines" id="datawrapper-chart-yeGst" src="https://datawrapper.dwcdn.net/yeGst/4/" scrolling="no" frameborder="0" style="width: 0; min-width: 100% !important; border: none;" height="260" data-external="1"></iframe><script type="text/javascript">!function(){"use strict";window.addEventListener("message",(function(a){if(void 0!==a.data["datawrapper-height"]){var e=document.querySelectorAll("iframe");for(var t in a.data["datawrapper-height"])for(var r=0;r<e.length;r++)if(e[r].contentWindow===a.source){var i=a.data["datawrapper-height"][t]+"px";e[r].style.height=i}}}))}();
                    </script>
                </div>
                <!--End bieu do-->
            </div>
            <!--End middle-->


            <!--Start data-->
            <div class="data">
                <div class="thong-tin-tong-quat">
                    <!--Start tong doanh thu-->
                    <div class="tong-doanh-thu">
                            <div class="middle">
                                <!-- <span class="material-symbols-sharp">trending_up</span> -->
                                <div class="left">
                                    <h3>Tổng doanh thu</h3>
                                    <span class="material-symbols-sharp">payments</span>
                                    <?php require_once("../../db/db_connect.php"); $conn = connectDB();
                                    // 1. Viết và chạy query
                                        $sql    = "SELECT SUM(oi.price * oi.num) AS total 
                                                    FROM order_items AS oi
                                                    JOIN `order` AS o ON o.order_id = oi.order_id
                                                    WHERE o.status <> 'da_huy'; ";
                                        $result = $conn->query($sql);

                                        $total = 0;
                                        if ($result && $row = $result->fetch_assoc()) {
                                            // nếu không có đơn hàng nào thì SUM trả về NULL
                                            $total = $row['total'] !== null ? $row['total'] : 0;
                                        }
                                        $result->free();

                                        // 2. Định dạng số với dấu phẩy, chấm
                                        $formatted = number_format($total, 0, ',', '.') . ' VNĐ'; // Số/làm tròn sau phẩy/ki tu phan tach phan thap phan/ ki tu phan tach hang tram
                                    ?>
                                    <h1><?= htmlspecialchars($formatted) ?></h1> <!-- Đảm bảo chỉ truyền kí tự (ko phải tag)-->
                                </div>
                            </div>
                    </div>
                    <!--End tong doanh thu-->
                    

                    <!--Start nam nguoi mua nhieu-->
                    <div class="nam-nguoi-mua-nhieu">
                    <div class="updates">
                        <h2>Bảng xếp hạng</h2>

                        <?php if (!empty($topOrders)): ?>
                        <?php foreach ($topOrders as $cust): ?>
                            <div class="update">
                            <div class="messsage">
                                <p>
                                <b>
                                    <?= htmlspecialchars($cust['fullname']) ?> 
                                    (<?= intval($cust['total_orders']) ?> đơn)
                                </b>
                                </p>
                            </div>
                            </div>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <p>Chưa có dữ liệu</p>
                        <?php endif; ?>

                    </div>
                    </div>
                    <!--End 5 nguoi mua nhieu-->
                </div>
                <!--End thong tin tong quat-->


                <div class="box-loc-data">
                    <div class="phan-box">
                        <form id="dateFilterForm" method="get" style="margin-bottom:1rem;">
                            <small>Tùy chỉnh: </small>
                            <input type="checkbox" id="box-tat-ca" class="checkbox-button">
                            <label for="box-tat-ca">Tất cả</label>
                                <input 
                                type="checkbox" 
                                id="box-tat-ca" 
                                name="all"
                                class = "checkbox-button" 
                                <?= isset($_GET['all']) ? 'checked' : '' ?> >
                            <input type="checkbox" id="box-top-5" class="checkbox-button">
                            <label for="box-top-5">Top 5</label>
                        </form>
                    </div>

                    <div class="thong-ke-don-hang phan-data">
                        <h2>Thống kê đơn hàng</h2>

                        <!-- Form lọc theo ngày -->
                        <form method="get" class="filter-form" id="filter-form">
                            <label>Từ:
                            <input
                                type="date"
                                name="date_from"
                                id = "date_from"
                                value="<?= htmlspecialchars($rawDateFrom) ?>">
                            </label>
                            <label>Đến:
                            <input
                                type="date"
                                name="date_to"
                                id = "date_to"
                                value="<?= htmlspecialchars($rawDateTo) ?>">
                            </label>
                            <button class="filter-btn"  type="submit">Lọc</button>
                            <button type="button" onclick="window.location.href='<?= basename($_SERVER['PHP_SELF']) ?>'">
                                Reset
                            </button>
                        </form>

                        <!-- Bảng kết quả động -->
                        <table id="bang-du-lieu-kh" style="display:none">
                            <?php if (empty($_GET['date_from']) && empty($_GET['date_to'])); ?>>
                            <thead>
                            <tr>
                                <th>Tên khách hàng</th>
                                <th>Số lượng đơn</th>
                                <th>Tổng tiền hàng</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($topSpenders)): ?>
                                <?php foreach ($topSpenders as $s): ?>
                                <tr>
                                    <td><?= htmlspecialchars($s['fullname']) ?></td>
                                    <td><?= intval($s['total_orders']) ?></td>
                                    <td><?= number_format($s['total_amount'], 0, ',', '.') ?> VNĐ</td>
                                    <td>
                                        <button class="bth-detail primary"
                                                data-user-id="<?= htmlspecialchars($s['user_id']) ?>">
                                        Chi tiết
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4">Không có dữ liệu trong khoảng đã chọn.</td></tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                        </div>
            <!--End data-->
        </main>
        <!--End main-->
    </div>

    <!---------------------------PHẦN POPUP cho chitiet------->
    <div id="orderDetailsPopup" class="popup">
    <div class="popup-content">
        <span class="close-popup">&times;</span>
        <div id="ordersContainer"></div>
    </div>
    </div>
    <!--END popup -->

    <script src="./popup.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
    const table = document.getElementById('bang-du-lieu-kh');
    const params = new URLSearchParams(window.location.search);

    if (params.has('date_from') || params.has('date_to')) {
        table.style.display = 'table';
    }
    });
    </script>

<!--JS để tự động xử lý box-tat-ca-->
    <script>
        document.getElementById('box-tat-ca')
            .addEventListener('change', function() {
            const from = document.getElementById('date_from');
            const to   = document.getElementById('date_to');
            if (this.checked) {
                // Xóa giá trị ngày
                from.value = '1-1-1000';
                to.value   = '1-1-3000';

            } else {
                from.disabled = to.disabled = false;
            }
            // Gửi form
            document.getElementById('filter-form').submit();
            });
    </script>
</body>
</html>