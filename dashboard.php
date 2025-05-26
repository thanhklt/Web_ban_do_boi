<?php
require_once("./db/db_connect.php");
$conn = connectDB();

$sql = 
"
SELECT o.order_id, u.username, pm.name, o.order_date, o.status
FROM `order` AS o 
JOIN `order_items` AS oi
	ON o.order_id = oi.order_id
JOIN `user` AS u 
	ON u.user_id = o.user_id
JOIN `payment_method` AS pm
	ON pm.payment_method_id = o.payment_method_id
GROUP BY o.order_id, u.username, pm.name
ORDER BY o.order_date DESC;
";


$stmt = $conn->prepare($sql);
$stmt -> execute();
$result = $stmt->get_result();

// Tạo map lấy tình trang dơn hang
$tinh_trang = [];
$tinh_trang["chua_xu_ly"] = "Chưa xử lý";
$tinh_trang["cho_van_chuyen"] = "Chờ vận chuyển";
$tinh_trang["da_giao"] = "Đã giao";
$tinh_trang["da_huy"] = "Đã hủy";

// Tạo map lấy phương thức thanh toán
$pttt = [];
$pttt["cash_on_delivery"] = "Thanh toán khi nhận hàng";
$pttt["qr_code"] = "Quét QR";
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Center</title>
    <link rel="stylesheet" href="./sidebar.css">
    <link rel="stylesheet" href="./dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />

</head>
<body>
    <div class="container">
        <!-- aside section start -->
        <aside>
            <div class="top">
                <div class="logo">
                    <a href="./dashboard.php"><img src="./assets/admin/logo.png" alt="logo"></a>
                </div>
                <div class="close" id="close_btn">
                    <img src="./assets/admin/icon/x-icon.svg" alt="sharp"/>
                    
                </div>
            </div>
            <!-- end top  -->

            <div class="sidebar">
                <a href="./dashboard.php" class="active">
                    <img src="./assets/admin/icon/grid-view.svg" alt="grid-view" />
                    <h3>Trang chủ</h3>
                </a>
                <a href="./admin/bao/nguoiDung.php" >
                    <img src="./assets/admin/icon/customer-icon.svg" alt="grid-view" />
                    <h3>Khách hàng</h3>
                </a>
                <a href="./admin/analyst/thongke-khachhang.php">
                    <img src="./assets/admin/icon/trendup-icon.svg" alt="grid-view" />
                    <h3>Phân tích</h3>
                </a>
                <a href="">
                    <img src="./assets/admin/icon/mail-icon.svg" alt="grid-view" />
                    <h3>Tin nhắn</h3>
                    <p class="msg-count">10</p>
                </a>
                <a href="./admin/order/quanlydon.php">
                    <img src="./assets/admin/icon/receiptlong-icon.svg" alt="grid-view" />
                    <h3>Đơn hàng</h3>
                </a>
                <a href="">
                    <img src="./assets/admin/icon/report-icon.svg" alt="grid-view" />
                    <h3>Báo cáo</h3>
                </a>
                <a href="">
                    <img src="./assets/admin/icon//setting-icon.svg" alt="grid-view" />
                    <h3>Cài đặt</h3>
                </a>
                <a href="./admin/bao/sanPham.php">
                    <img src="./assets/admin/icon/add-icon.svg" alt="grid-view" />
                    <h3>Thêm sản phẩm</h3>
                </a>
                <a href="./admin/bao/index.php">
                    <img src="./assets/admin/icon/logout-icon.svg" alt="grid-view" />
                    <form action="logout.php" method="post" style="display:inline">
                    <button type="submit" class="btn btn-logout"><h3>Đăng xuất</h3></button>
                    </form>
                </a>
            </div>
         </aside>
         <!-- aside section end -->

         <!-- main section start-->
         <main>
        <h1 class="res">Dashboard</h1>
        <div class="data res">
            <input type="date"/>
        </div>

        <!-- INSIGHTS GIỮ NGUYÊN -->
        <div class="insights">

                <!--Start doanh thu-->
                <div class="doanh-thu">
                    <span class="material-symbols-sharp">trending_up</span>
                    <div class="middle">
                        <div class="left">
                            <?php
                            require_once("./db/db_connect.php");
                            $conn = connectDB();
                            
                            $sql = "SELECT 
                                    SUM(oi.price * oi.num) AS total_amount
                                    FROM order_items AS oi
                                    INNER JOIN `order` AS o 
                                    ON oi.order_id = o.order_id
                                    WHERE 
                                    o.order_date >= NOW() - INTERVAL 7 DAY  AND o.status <> 'da_huy';;";

                            $res = $conn->query($sql);
                            $total = 0;
                            if ($res && $row = $res->fetch_assoc()) {
                                $total = $row['total_amount'] !== null ? $row['total_amount'] : 0;
                            }
                            $res->free();
                            $formatted = number_format($total, 0, ',', '.') . ' VNĐ';
                            ?>
                            <h3>Doanh thu</h3>
                            <h1><?php echo htmlspecialchars($formatted) ?></h1>

                        </div>
                        <div class="progress">
                            <svg>
                                <circle r="30" cx="40" cy="40"></circle> <!--Tao hinh tron-->
                            </svg>
                            <div class="number">80%</div>
                        </div>
                    </div>
                    <small>24h gần đây</small>
                </div>
                <!--End doanh thu-->

                <!--Start chi phí-->
                <div class="chi-phi">
                    <span class="material-symbols-sharp">local_mall</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Chi phí</h3>
                            <h1>100.000 VNĐ</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle r="30" cx="40" cy="40"></circle> <!--Tao hinh tron-->
                            </svg>
                            <div class="number">80%</div>
                        </div>
                    </div>
                    <small>24h gần đây</small>
                </div>
                <!--End chi phi-->


                <!--Start thu nhap-->
                <div class="thu-nhap">
                    <span class="material-symbols-sharp">stacked_line_chart</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Thu nhập</h3>
                            <h1>100.000 VNĐ</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle r="30" cx="40" cy="40"></circle> <!--Tao hinh tron-->
                            </svg>
                            <div class="number"><p>80%</p></div>
                        </div>
                    </div>
                    <small>24h gần đây</small>
                </div>
                <!--End thu nhap-->
            </div>
            <!--End inside-->
        <!-- Start dat hang gan nhat -->
        <div class="recent_order">
            <h1>Recent Orders</h1>
            <table>
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Người đặt hàng</th>
                        <th>Thời gian đặt hàng</th>
                        <th>Thanh toán</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()):?>
                            <tr>
                                <td> <?php echo htmlspecialchars($row['order_id']) ?> </td>
                                <td> <?php echo htmlspecialchars($row['username']) ?> </td>
                                <td> <?php echo htmlspecialchars($row['order_date']) ?> </td>
                                <td> <?php echo htmlspecialchars($pttt[$row["name"]]) ?> </td>
                                <td> <?php echo htmlspecialchars($tinh_trang[$row['status']]) ?> </td>
                                <!-- <td class="primary">Chi tiết</td> -->
                            </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <!-- End dat hang gan nhat -->
    </main>

         <!-- main section end -->

         <!-- right section start -->
         <div class="right">
            <div class="top">

                <button id="menu_bar">
                    <span class="material-symbols-sharp">menu</span>
                </button>

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
                        <img src="./assets/admin/admin-avatar.gif" alt="" />
                    </div>
                </div>
            </div>
            <!-- End top-->

            <!-- Start recent update-->
            <div class="recent_updates">
                <h2>Recent Update</h2>

                <div class="updates">
                    <!--User1-->
                    <div class="profile-photo">
                        <img src="./assets/admin/user_1.jpg" class="profile-photo" />
                    </div>
                    <div class="messsage">
                        <p><b>Tê Linh</b> vừa đặt hàng</p>
                    </div>
                    <!--End User1-->

                    <!--User2-->
                    <div class="profile-photo">
                        <img src="./assets/admin/user_2.jpg" class="profile-photo" />
                    </div>
                    <div class="messsage">
                        <p><b>Giang ơi!</b> vừa đặt hàng</p>
                    </div>
                    <!--End user2-->

                    <!--User3-->
                    <div class="profile-photo">
                        <img src="./assets/admin/user_3.png" class="profile-photo" />
                    </div>
                    <div class="messsage">
                        <p><b>Phạm Mẫn Nhi</b> vừa đặt hàng</p>
                    </div>
                    <!--End user3-->
                </div>
            </div>
            <!--End recent update-->
            <!--Start analytics-->
            <div class="sale_analytics">
                <h2>Sales Analytics</h2>
                <div class="item-online">
                    <div class="icon">
                        <span class="material-symbols-sharp">shopping_cart</span>
                    </div>
                    <div class="right_text">
                        <div class="infor">
                            <h3>Online orders</h3>
                            <small class="text-muted">2 giờ trước</small>
                        </div>
                        <h5 class="success">+30%</h5>
                        <h3>1.593.000 VNĐ</h3>
                    </div>
                </div>

                <div class="item-online">
                    <div class="icon">
                        <span class="material-symbols-sharp">shopping_cart</span>
                    </div>
                    <div class="right_text">
                        <div class="infor">
                            <h3>Online orders</h3>
                            <small class="text-muted">2 giờ trước</small>
                        </div>
                        <h5 class="success">+30%</h5>
                        <h3>1.593.000 VNĐ</h3>
                    </div>
                </div>

                <div class="item-online">
                    <div class="icon">
                        <span class="material-symbols-sharp">shopping_cart</span>
                    </div>
                    <div class="right_text">
                        <div class="infor">
                            <h3>Online orders</h3>
                            <small class="text-muted">2 giờ trước</small>
                        </div>
                        <h5 class="danger">-30%</h5>
                        <h3>1.593.000 VNĐ</h3>
                    </div>
                </div>
            </div>
            <!--End analytics-->

            <div class="item-online add-product">
                <div>
                    <span class="material-symbols-sharp">add</span>
                </div>
            </div>
         </div>
         <!-- right section end -->

    </div>


<script src="./script.js"></script>
</body>
</html>