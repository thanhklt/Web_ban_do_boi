<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Center</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./stylenguoiDung.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>
    <!--Nav PC-->
    <div class="nav-pc">
        <div class="container">
            <!-- aside section start -->
            <aside>
                <div class="top">
                    <div class="logo">
                        <a href="../../dashboard.php"><img src="../../assets/image/logo.png" alt="logo" style="width: 150px; height: 50px;"></a>
                    </div>
                </div>
                <!-- end top  -->

                <div class="sidebar">
                    <a href="../../dashboard.php">
                        <img src="../../assets/icon/grid-view.svg" alt="grid-view" />
                        <h3>Trang chủ</h3>
                    </a>
                    <a href="./nguoiDung.php">
                        <img src="../../assets/icon/customer-icon.svg" alt="grid-view" />
                        <h3>Khách hàng</h3>
                    </a>
                    <a href="../analyst/thongke-khachhang.php">
                        <img src="../../assets/icon/trendup-icon.svg" alt="grid-view" />
                        <h3>Phân tích</h3>
                    </a>
                    <a href="">
                        <img src="../../assets/icon/mail-icon.svg" alt="grid-view" />
                        <h3>Tin nhắn</h3>
                        <p class="msg-count">10</p>
                    </a>
                    <a href="../order/quanlydon.php">
                        <img src="../../assets/icon/receiptlong-icon.svg" alt="grid-view" />
                        <h3>Đơn hàng</h3>
                    </a>
                    <a href="">
                        <img src="../../assets/icon/report-icon.svg" alt="grid-view" />
                        <h3>Báo cáo</h3>
                    </a>
                    <a href="">
                        <img src="../../assets/icon/setting-icon.svg" alt="grid-view" />
                        <h3>Cài đặt</h3>
                    </a>
                    <a href="./sanPham.php">
                        <img src="../../assets/icon/add-icon.svg" alt="grid-view" />
                        <h3>Sản phẩm</h3>
                    </a>
                    <a href="./index.php">
                        <img src="../../assets/icon/logout-icon.svg" alt="grid-view" />
                        <h3>Đăng xuất</h3>
                    </a>
                </div>
        </div>
    </div>

    <!--Nav Mobile-->
    <div id="nav__bars">
        <label for="nav_mobile_input" class="nav__bars-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path
                    d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z" />
            </svg>
        </label>
    </div>

    <input type="checkbox" class="nav__input" id="nav_mobile_input">

    <label for="nav_mobile_input" hidden class="nav__overlay"></label>
    <div class="container-mobile">
        <!-- aside section start -->
        <aside>
            <div class="top_mobile">
                <div class="logo_mobile">
                    <img src="../../assets/image/logo.png" alt="logo">
                </div>
                <label for="nav_mobile_input" class="close_mobile">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z" />
                    </svg>
                </label>
            </div>
            <!-- end top  -->

            <div class="sidebar_mobile">
                     <a href="../../dashboard.php">
                        <img src="../../assets/icon/grid-view.svg" alt="grid-view" />
                        <h3>Trang chủ</h3>
                    </a>
                    <a href="./nguoiDung.php">
                        <img src="../../assets/icon/customer-icon.svg" alt="grid-view" />
                        <h3>Khách hàng</h3>
                    </a>
                    <a href="../analyst/thongke-khachhang.php">
                        <img src="../../assets/icon/trendup-icon.svg" alt="grid-view" />
                        <h3>Phân tích</h3>
                    </a>
                    <a href="">
                        <img src="../../assets/icon/mail-icon.svg" alt="grid-view" />
                        <h3>Tin nhắn</h3>
                        <p class="msg-count">10</p>
                    </a>
                    <a href="../order/quanlydon.php">
                        <img src="../../assets/icon/receiptlong-icon.svg" alt="grid-view" />
                        <h3>Đơn hàng</h3>
                    </a>
                    <a href="">
                        <img src="../../assets/icon/report-icon.svg" alt="grid-view" />
                        <h3>Báo cáo</h3>
                    </a>
                    <a href="">
                        <img src="../../assets/icon/setting-icon.svg" alt="grid-view" />
                        <h3>Cài đặt</h3>
                    </a>
                    <a href="./sanPham.php">
                        <img src="../../assets/icon/add-icon.svg" alt="grid-view" />
                        <h3>Sản phẩm</h3>
                    </a>
                    <a href="./index.php">
                        <img src="../../assets/icon/logout-icon.svg" alt="grid-view" />
                        <h3>Đăng xuất</h3>
                    </a>
            </div>
    </div>

    <div id="container-content">
        <div id="container-product">
            <header>
                <div class="toolbar">
                    <input type="text" placeholder="Search..." id="search">
                    <button>Hiện: Tất cả người dùng</button>
                    <button>Sắp xếp:
                        <select>
                            <option>Mặc định</option>
                            <option>Tăng dần theo chữ cái</option>
                            <option>Giảm dần theo chữ cái</option>
                        </select>
                    </button>
                    <input type="checkbox" id="toggleForm" class="toggle-form" style="display: none;">
                    <label for="toggleForm" class="add-product">Thêm khách hàng</label>
                </div>

                <form id="formUser" action="database/update_user.php" method="post" enctype="multipart/form-data">
                    <h2>Chỉnh sửa thông tin người dùng</h2>
                    <input type="hidden" name="id" id="idRepair">
                    <div class="input-group">
                        <label for="nameRepair">Họ và tên<br></label>
                        <input id="nameRepair" type="text" name="name">
                    </div>
                    <div class="input-group">
                        <label for="usernameRepair">Tên đăng nhập<br></label>
                        <input id="usernameRepair" type="text" name="username">
                    <div class="input-group">
                        <label for="emailRepair">Email<br></label>
                        <input id="emailRepair" type="text" name="email">
                    </div>
                    <div class="input-group">
                        <label for="passwordRepair">Password<br></label>
                        <input id="passwordRepair" type="text" name="password">
                    </div>
                    <div class="input-group">
                        <label for="phoneNumberRepair">Số điện thoại<br></label>
                        <input id="phoneNumberRepair" type="text" name="phonenumber">
                    </div>

                    <div class="input-group">
                        <label for="id_roleRepair"><br>Vai trò:</label>
                        <select id="id_roleRepair" name="id_roleRepair">
                            <option value="1">Admin</option>
                            <option value="2">Khách hàng</option>
                        </select>
                    </div>
                    <button type="submit" id="saveChange">Lưu</button>
                    <button type="submit" id="cancelChange" onclick="closeDialog()">Thoát</button>
                </form>
            </header>

            <div id="add-product-form" class="add_product" style="display: none;">
                <h2>Thêm người dùng</h2>
                <form action="database/add_user.php" method="post" enctype="multipart/form-data">
                    <label for="name">Tên: <br></label>
                    <input type="text" placeholder="Tên khách hàng" id="name" required name="fullname">
                    
                    <label for="username">Username: <br></label>
                    <input type="text" placeholder="Tên đăng nhập" id="name" required name="username">
                    
                    <label for="email"><br>Email: <br></label>
                    <input type="email" placeholder="VD: nguyenvana@gmail.com" id="email" required name="email">

                    <label for="password"><br>Mật khẩu: <br></label>
                    <input type="text" placeholder="Nhập mật khẩu" id="password" required name="password">

                    <label for="address"><br>Địa chỉ:</label>
                    <input type="text" placeholder="Nhập địa chỉ" id="address" required name="address_name">

                    <label for="street"><br>Tên đường:</label>
                    <input type="text" placeholder="Nhập tên đường" id="street" required name="street">

                    <label for="district"><br>Quận:</label>
                    <input type="text" placeholder="Nhập quận" id="district" required name="district">

                    <label for="province"><br>Tỉnh: </label>
                    <select id="province" required name="province" style="margin: 3px">
                        <option value="TPHCM">TPHCM</option>
                    </select>

                    <label for="id_role"><br>Vai trò:</label>
                    <select id="id_role" required name="role_id">
                        <option value="1">Admin</option>
                        <option value="2">Khách hàng</option>
                    </select>

                    <label for="phonenumber"><br>Số điện thoại: <br></label>
                    <input type="text" placeholder="Số điện thoại" id="phoneNumber" required name="phone_number">

                    <!-- <label for="thumbnail"><br>Ảnh đại diện: <br></label>
                    <input type="file" id="thumbnail" required name="thumbnail" accept="image/*"><br> -->

                    <div class="btn-form">
                        <button type="submit" id="add">Thêm</button>
                        <button type="button" onclick="cancelForm()" id="cancel">Hủy</button>
                    </div>
                </form>
            </div>

            <main>
                <table>
                    <thead>
                        <tr>
                            <th>Thông tin</th>
                            <th>Mã</th>
                            <th>Tên đăng nhập</th>
                            <th>Email</th>
                            <th>Mật khẩu</th>
                            <th>Số điện thoại</th>
                            <th>Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once ('../../db/db_connect.php');
                        // Kết nối CSDL
                        $conn = connectDB();

                        // Truy vấn dữ liệu sản phẩm
                        $sql = "SELECT u.*, r.role_id
                        FROM user u
                        JOIN role r ON u.role_id = r.role_id
                        WHERE u.deleted IS NULL OR u.deleted = 0";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Hiển thị từng sản phẩm
                            while ($row = $result->fetch_assoc()) {

                                $role = ($row['role_id'] == 1) ? "Admin" : "Khách hàng";
                                echo "<tr>
                        <td>
                            <div class='user-container'>
                            
                            <img src='../../assets/" . $row['thumbnail'] . "'. style='width: 100px; height: 100px;'>
                            
                            <i class='fa-solid fa-pen edit-icon'
                                data-id='" . $row['user_id'] . "'
                                data-username='" . htmlspecialchars($row['username'], ENT_QUOTES) . "'
                                data-name='" . htmlspecialchars($row['fullname'], ENT_QUOTES) . "'
                                data-email='" . htmlspecialchars($row['email'], ENT_QUOTES) . "'
                                data-password='" . htmlspecialchars($row['password'], ENT_QUOTES) . "'
                                data-phonenumber='" . $row['phone_number'] . "'
                                data-thumbnail='" . $row['thumbnail'] . "'>
                            </i>
                            </div>

                            <div>
                                <p class='name_user'>" . $row['fullname'] . " - $role</p>
                            </div> 
                            
                        </td>
                        <td>" .  $row['user_id'] . "</td>
                        <td>" .  $row['username'] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td>" . $row['password'] . "</td>
                        <td>" . $row['phone_number'] . "</td>
                        <td>
                            <button class='lock-btn " . ($row['deleted'] ? "btn-red" : "btn-green") . "'
                                    data-id='" . $row['user_id'] . "'
                                    data-locked='" . $row['deleted'] . "'>
                                " . ($row['deleted'] ? "Bị khóa" : "Hoạt động") . "
                            </button>


                        </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Không có người dùng nào.</td></tr>";
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </main>
        </div>
        <script src="./logic/themSP.js"></script>
        <script src="./logic/dialogUsers.js"></script>
        <script src="./logic/status.js"></script>
        <script src="./logic/searchUser.js"></script>
        <script src="./logic/removeUser.js"></script>
</body>

</html>