<?php
// quanlydon.php
require_once("../../db/db_connect.php");
require_once("../../db/dbhelper.php");

// 1. Kết nối DB
$conn = connectDB(); 

// ===================================LỌC THEO QUẬN==============================
$selectedDistrict = '';
if (!empty($_GET['district'])) {
    $selectedDistrict = $_GET['district'];
}

// 2. Lấy danh sách quận thuộc TP.HCM để render <select>
$districts = [];
$distRes = $conn->query("
  SELECT DISTINCT `district`
  FROM `Address`
  WHERE `province` = 'TPHCM'
  ORDER BY `district`
");
while ($d = $distRes->fetch_assoc()) {
    $districts[] = $d['district'];
}


// ===================================LỌC THEO TRẠNG THÁI==============================

$allowed = ['chua_xu_ly', 'cho_van_chuyen', 'da_giao', 'da_huy']; // Status cua trang thai don hang trong db
    // Xử lý POST khi đổi trạng thái đơn
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['status'])) {
        $order_id = intval($_POST['order_id']);
        $new_status = $_POST['status'];
        if (in_array($new_status, $allowed, true)) {
            $stmt = $conn->prepare("UPDATE `Order` SET `status` = ? WHERE `order_id` = ?"); # Tranh sql inject
            $stmt->bind_param('si', $new_status, $order_id);
            $stmt->execute();
            $stmt->close();
        }
        // Tránh re-submit khi reload
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    }
//Loc
$where = []; 
$params = []; 
$selected = [];
$types   = '';
if (!empty($_GET['status']) && is_array($_GET['status'])) {
    $allowed = ['chua_xu_ly','cho_van_chuyen','da_giao','da_huy'];
    foreach ($_GET['status'] as $s) {
        if (in_array($s, $allowed, true)) {
            $selected[] = $s;
        }
    }
}

if (count($selected) > 0) {
    $ph = implode(',', array_fill(0, count($selected), '?'));
    $where[] = "o.status IN ($ph)";
    foreach ($selected as $s) {
        $params[] = $s;
        $types   .= 's';
    }
}
if (!empty($_GET['date_from']) && !empty($_GET['date_to'])) {
    $where[] = "o.order_date BETWEEN ? AND ?";
    $params[] = $_GET['date_from'] . ' 00:00:00';
    $params[] = $_GET['date_to']   . ' 23:59:59';
}

if ($selectedDistrict !== '') {
    $where[]   = "a.`district` = ?";
    $params[]  = $selectedDistrict;
    $types    .= 's';
}

$whereSql = $where ? 'WHERE ' . implode(' AND ', $where) : '';
// 3. Query với JOIN lấy đầy đủ trường cần hiển thị
$sql = "
  SELECT
    o.order_id,
    u.fullname,
    o.email,
    o.phone_number,
    CONCAT(
      a.address_name, ', ',
      a.street, ', ',
      a.district, ', ',
      a.province
    ) AS full_address,
    o.order_date,
    o.status
  FROM `Order` AS o
  LEFT JOIN `User`    AS u ON o.user_id    = u.user_id
  LEFT JOIN `Address` AS a ON o.address_id = a.address_id
  $whereSql
  ORDER BY o.order_date DESC
";
$stmt = $conn->prepare($sql);
// 4. Bind params động
if (!empty($params)) {
    $types = str_repeat('s', count($params));
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>





<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
    <link rel="stylesheet" href="./sidebar.css">
    <link rel="stylesheet" href="./quanlydon.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <!--Aside section start-->
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
                <a href="../analyst/thongke-khachhang.php">
                    <img src="../../assets/admin/icon/trendup-icon.svg" alt="grid-view" />
                    <h3>Phân tích</h3>
                </a>
                <a href="">
                    <img src="../../assets/admin/icon/mail-icon.svg" alt="grid-view" />
                    <h3>Tin nhắn</h3>
                    <p class="msg-count">10</p>
                </a>
                <a href="./quanlydon.html" class="active">
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
                <a href="../bao/index.php">
                    <img src="../../assets/admin/icon/logout-icon.svg" alt="grid-view" />
                    <h3>Đăng xuất</h3>
                </a>
            </div>
         </aside>
        <!--Aside section end-->

        <!--Main section start-->
        <main>
            <!--Start top-->
            <div class="top">

                <!-- Top menu start-->
                <div class="top-menu">
                    <button id="menu_bar">
                        <span class="material-symbols-sharp">menu</span>
                    </button>
                    <h1>Order Managerment</h1>
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

                <!--Start select option-->
                <div class="select-option">
                    <div class="tat-ca active">
                        <p>Tất cả</p>
                    </div>
    
                    <div class="chua-thanh-toan">
                        <p>Chưa thanh toán</p>
                    </div>
    
                    <div class="cho-dong-goi">
                        <p>Chờ đóng gói & bàn giao</p>
                    </div>
    
                    <div class="dang-van-chuyen">
                        <p>Đang vận chuyển</p>
                    </div>
    
                    <div class="da-giao-hang">
                        <p>Đã giao hàng</p>
                    </div>
    
                    <div class="huy-don-hang">
                        <p>Hủy đơn hàng</p>
                    </div>
                </div>
            </div>
            <!--END select option-->

            <!-- END TOP-->


            <!---Start insights-->
            <div class="insights">

                <!-- Start box lọc data-->
                <div class="box-loc-data">
                    <div class="ngay-dat-hang">
                        <small>Ngày đặt hàng: </small>

                        <input type="checkbox" id="ngay-hom-nay" class="checkbox-button">
                        <label for="ngay-hom-nay">Ngày hôm nay</label>

                        <input type="checkbox" id="ngay-hom-qua" class="checkbox-button">
                        <label for="ngay-hom-qua">Ngày hôm qua</label>

                        <input type="checkbox" id="trong-tuan-nay" class="checkbox-button">
                        <label for="trong-tuan-nay">Trong tuần này</label>

                        <input type="checkbox" id="trong-thang-nay" class="checkbox-button">
                        <label for="trong-thang-nay">Trong tháng này</label>

                    
                        <small> Tùy chỉnh</small>
                        <form id="dateFilterForm" method="get" style="margin-bottom:1rem;">
                            <label for="date_from">Tùy chỉnh: Từ</label>
                            <input type="date"
                                id="date_from"
                                name="date_from"
                                class="input-ngay"
                                value="<?= htmlspecialchars($date_from) ?>">

                            <label for="date_to">Đến:</label>
                            <input type="date"
                                id="date_to"
                                name="date_to"
                                class="input-ngay"
                                value="<?= htmlspecialchars($date_to) ?>">

                            <button type="submit">Lọc</button>
                        </form>
                    </div>
                    <form id="filterForm" method="get" style="margin-bottom:1rem;">
                        <div class="tinh-trang">
                            <small>Tình trạng đơn hàng: </small>

                            <input type="checkbox"
                                name="status[]"
                                id="da-giao-hang"
                                value="da_giao"
                                class="checkbox-button"
                                <?= in_array('da_giao', $selected) ? 'checked' : '' ?>>
                            <label for="da-giao-hang">Đã giao hàng</label>

                            <input type="checkbox"
                                name="status[]"
                                id="da-huy"
                                value="da_huy"
                                class="checkbox-button"
                                <?= in_array('da_huy', $selected) ? 'checked' : '' ?>>
                            <label for="da-huy">Đã hủy</label>

                            <input type="checkbox"
                                name="status[]"
                                id="cho-van-chuyen"
                                value="cho_van_chuyen"
                                class="checkbox-button"
                                <?= in_array('cho_van_chuyen', $selected) ? 'checked' : '' ?>>
                            <label for="cho-van-chuyen">Chờ vận chuyển</label>

                            <input type="checkbox"
                                name="status[]"
                                id="chua-xu-ly"
                                value="chua_xu_ly"
                                class="checkbox-button"
                                <?= in_array('chua_xu_ly', $selected) ? 'checked' : '' ?>>
                            <label for="chua-xu-ly">Chưa xử lý</label>

                            <button type="submit">Áp dụng</button>
                            <button type="button" onclick="window.location='quanlydon.php'">Reset</button>
                        </div>
                    </form>
                    <div class="dia-chi">
                        <form method="get" style="margin-bottom:1rem;">
        <label for="district">Chọn quận (TP HCM):</label>
        <select name="district" id="district">
            <option value=""  class="checkbox-button">-- Tất cả --</option>
            <?php foreach ($districts as $d): ?>
                <option value="<?= htmlspecialchars($d) ?>" <?= $d === $selectedDistrict ? 'selected' : '' ?> >
                    <?= htmlspecialchars($d) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Lọc</button>
    </form>

                        <small>Thành phố: </small>
                        <select id="dia-chi-dat-hang" class="input-dia-chi">
                            <option value="">Hồ Chí Minh</option>
                        </select>
                    </div>
                </div>
                <!-- End box loc data-->


                <!-- Start data-don-dat-hang-->
                <div class="data-don-dat-hang">
                <table>
                    <thead>
                        <tr>
                        <th>ID</th><th>Khách hàng</th><th>Email</th><th>SDT</th><th>Địa chỉ</th><th>Ngày đặt</th><th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                        <td><?= htmlspecialchars($row['order_id']) ?></td> <!-- Tranh bi XSS-->
                        <td><?= htmlspecialchars($row['fullname']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['phone_number']) ?></td>
                        <td><?= htmlspecialchars($row['full_address']) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($row['order_date'])) ?></td>
                        <td class="trang-thai <?= htmlspecialchars($row['status']) ?>">
                            <form method="post" style="margin:0;">
                            <input type="hidden" name="order_id" value="<?= $row['order_id'] ?>">
                            <select name="status" class="status-dropdown" onchange="this.form.submit()">
                                <option value="chua_xu_ly"    <?= $row['status']=='chua_xu_ly'    ? 'selected' : '' ?>>Chưa xử lý</option>
                                <option value="cho_van_chuyen"<?= $row['status']=='cho_van_chuyen'? 'selected' : '' ?>>Chờ vận chuyển</option>
                                <option value="da_giao"        <?= $row['status']=='da_giao'        ? 'selected' : '' ?>>Đã giao thành công</option>
                                <option value="da_huy"         <?= $row['status']=='da_huy'         ? 'selected' : '' ?>>Đã hủy</option>
                            </select>
                            </form>
                        </td>
                        <td>
                        <button class="bth-detail primary" data-order-id="<?= $row['order_id'] ?>">
                            Chi tiết
                        </button>
                        </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
                </div>
            </div>
            <!--End insights-->

        </main>
        <!--Main section end-->
    </div>



<!-- Popup hiện chi tiết đơn hàng -->
<div id="orderDetailsPopup" class="popup" style="display:none;">
  <div class="popup-content">
    <span class="close-popup">&times;</span>
    <h2 class="primary">Chi tiết đơn hàng</h2>

    <div id="orderMetadata">
      <p>Mã đơn hàng: <b id="popupOrderId">–</b></p>
      <p>Người đặt: <b id="popupFullname">–</b></p>
      <p>Thời gian đặt: <b id="popupOrderDate">–</b></p>
      <p>Tổng tiền: <b id="popupTotal">–</b></p>
    </div>

    <br>
        
    <table id="orderDetailsTable">
      <thead>
        <tr>
          <th>Mã sản phẩm</th>
          <th>Tên sản phẩm</th>
          <th>Số lượng</th>
        </tr>
      </thead>
      <tbody>
        <tr><td colspan="3">Chưa có dữ liệu</td></tr>
      </tbody>
    </table>
  </div>
</div>
<!--END popup -->

<script>
  console.log('🔥 Inline test: quanlydon.php đang nạp script đây');
</script>
<script src="./popup.js"></script>
<script>
  document.querySelectorAll('.status-dropdown').forEach(select => {
    select.addEventListener('change', function() {
      const td = this.closest('td.trang-thai');
      // Xóa các class trạng thái cũ trên td
      td.className = 'trang-thai';
      td.classList.add(this.value);
      // Xóa class cũ và gán class trạng thái lên select
      this.className = 'status-dropdown';
      this.classList.add(this.value);
    });
  });
</script>
<script src="./script.js"></script>
<script>
  // (Tuỳ chọn) tự động submit khi tick/un-tick
  document.querySelectorAll('#filterForm .checkbox-button').forEach(cb =>
    cb.addEventListener('change', () =>
      document.getElementById('filterForm').submit()
    )
  );
</script>
<link rel="stylesheet" href="./quanlydon.css">
</body>
</html>