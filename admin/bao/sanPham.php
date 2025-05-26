<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Center</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleSanPham.css">
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
                    <img src="assest/image/logo.png" alt="logo">
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
                    <button>Hiện: Sản phẩm đang được bán</button>
                    <button>Sắp xếp:
                        <select>
                            <option>Mặc định</option>
                            <option>Tăng dần theo giá</option>
                            <option>Giảm dần theo giá</option>
                        </select>
                    </button>
                    <input type="checkbox" id="toggleForm" class="toggle-form" style="display: none;">
                    <label for="toggleForm" class="add-product">Thêm sản phẩm mới</label>
                </div>

                <form id="formND" action="database/update_product.php" method="post" enctype="multipart/form-data">
                    <h2>Chỉnh sửa sản phẩm</h2>
                    <input type="hidden" name="id" id="idRepair">
                    <div class="input-group">
                        <label for="nameRepair">Tên sản phẩm: <br></label>
                        <input id="nameRepair" name="title" type="text">
                    </div>
                    <div class="input-group">
                        <label for="inforRepair">Thông tin sản phẩm: <br></label>
                        <textarea name="description" id="inforRepair" rows="4"></textarea>
                    </div>
                    <div class="input-group">
                        <label for="priceRepair">Giá: <br></label>
                        <input id="priceRepair" name="price" type="text">
                    </div>
                    <div class="input-group">
                        <label for="discountRepair">Mã giảm giá: <br></label>
                        <input id="discountRepair" name="discount" type="text">
                    </div>
                    <div class="input-group">
                        <label for="brandRepair">Nhãn hàng: <br></label>
                        <input id="brandRepair" name="brand" type="text">
                    </div>
                    <div class="input-group">
                        <label for="categoryRepair">Phân loại sản phẩm: <br></label>
                        <select id="categoryRepair" name="category_id">
                            <option value="1">Mắt kính bơi</option>
                            <option value="2">Đồ bơi</option>
                            <option value="3">Balo</option>
                            <option value="4">Nón chống nắng</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="sizeRepair">Kích thước: <br></label>
                        <select id="sizeRepair" name="size">
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <!-- Ảnh 1 -->
                        <label for="thumbnail1">Ảnh 1:<br></label>
                        <input type="file" id="thumbnail1" name="thumbnail_1" accept="image/*">
                        <img id="previewImg1" src="" style="width: 100px; display: none;" alt="Xem trước ảnh 1">

                        <!-- Ảnh 2 -->
                        <label for="thumbnail2">Ảnh 2:<br></label>
                        <input type="file" id="thumbnail2" name="thumbnail_2" accept="image/*">
                        <img id="previewImg2" src="" style="width: 100px; display: none;" alt="Xem trước ảnh 2">

                    </div>

                    <button type="submit" id="saveChange">Lưu thay đổi</button>
                    <button type="button" id="cancelChange" onclick="closeDialog()">Thoát</button>
                </form>
            </header>

            <div id="add-product-form" class="add_product">
                <h2>Thêm sản phẩm</h2>
                <form action="database/save_product.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
                    <input type="hidden" name="old_thumbnail_1" value="<?= htmlspecialchars($row['thumbnail_1']) ?>">
                    <input type="hidden" name="old_thumbnail_2" value="<?= htmlspecialchars($row['thumbnail_2']) ?>">

                    <!-- các input khác -->
                    <label for="title">Tiêu đề sản phẩm: <br></label>
                    <input type="text" name="title" placeholder="VD: Quần bơi siêu đẹp nè!" id="title">

                    <br>
                    <label for="product_name">Tên sản phẩm: <br></label>
                    <input type="text" name="product_name" placeholder="VD: Quần bơi siêu đẹp size S!" id="product_name">


                    <label for="description"><br>Mô tả sản phẩm: <br></label>
                    <textarea name="description" id="description" rows="4" placeholder="Thông tin chi tiết sản phẩm"></textarea>

                    <label for="thumbnail"><br>Ảnh 1: <br></label>
                    <input type="file" name="thumbnail_1" id="thumbnail_1" accept="image/*">
                    <div id="previewContainer1"></div>

                    <label for="thumbnail"><br>Ảnh 2: <br></label>
                    <input type="file" name="thumbnail_2" id="thumbnail_2" accept="image/*">
                    <div id="previewContainer2"></div>

                    <label for="price"><br>Giá gốc: <br></label>
                    <input type="text" name="price" id="price">

                    <label for="discount"><br>Giá giảm: <br></label>
                    <input type="text" name="discount" id="discount">

                    <label for="brand"><br>Nhãn hàng<br></label>
                    <input type="text" name="brand" id="brand" placeholder="VD: Speedo"><br>

                    <label for="size"><br>Kích thước<br></label>
                    <select name="size" id="size">
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select><br>

                    <label for="category">Phân loại sản phẩm<br></label>
                    <select name="category_id" id="category">
                        <option value="1">Mắt kính bơi</option>
                        <option value="2">Đồ bơi</option>
                        <option value="3">Balo</option>
                        <option value="4">Nón chống nắng</option>
                    </select><br>

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
                            <th>Thông tin sản phẩm</th>
                            <th>Mã sản phẩm</th>
                            <th>Kích thước</th>
                            <th>Giá gốc</th>
                            <th>Giá ưu đãi</th>
                            <th>Nhãn hàng</th>
                            <th>Phân loại</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php require_once("../../db/db_connect.php");

                        // Kết nối CSDL
                        $conn = connectDB();
                        $conn->set_charset("utf8mb4");

                        if ($conn->connect_error) {
                            die("Kết nối thất bại: " . $conn->connect_error);
                        }

                        // Truy vấn dữ liệu sản phẩm
                        $sql = "SELECT p.*, c.name
                                FROM product p
                                LEFT JOIN category c ON p.category_id = c.id
                                WHERE p.deleted IS NULL OR p.deleted = 0";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Hiển thị từng sản phẩm
                            while ($row = $result->fetch_assoc()) {
                                $price_discount = $row['price'] - ($row['price'] * $row['discount'] / 100);
                                $icon_class = $row["deleted"] == 1 ? "fa-eye-slash" : "fa-eye";
                                $tooltip = $row["deleted"] == 1 ? "Hiện lại sản phẩm" : "Ẩn sản phẩm";
                                $old1  = $row['thumbnail_1'];
                                $old2  = $row['thumbnail_2'];

                                // Cat chuoi
                                $img1  = str_replace(
                                '../Img_Product/',      // chuỗi cũ trong DB
                                '../../USER/Img_Product/', // chuỗi mới bạn cần
                                $old1
                                );
                                $img2  = str_replace('../Img_Product/', '../../USER/Img_Product/', $old2);

                                echo "<tr>
                                <td>
                                    <div class='user-container'>
                                        <img src='" . $img1 . "' alt='Ảnh 1' style='width: 80px; height: 80px; margin-right: 5px;'>
                                        <img src='" . $img2 . "' alt='Ảnh 2' style='width: 80px; height: 80px;'>


                                       <i class='fa-solid fa-pen edit-icon'
                                            data-id='" . $row["product_id"] . "'
                                            data-title='" . htmlspecialchars($row["title"], ENT_QUOTES) . "'
                                            data-description='" . htmlspecialchars($row["description"], ENT_QUOTES) . "'
                                            data-thumbnail1='" . $row["thumbnail_1"] . "'
                                            data-thumbnail2='" . $row["thumbnail_2"] . "'
                                            data-price='" . $row["price"] . "'
                                            data-discount='" . $row["discount"] . "'
                                            data-size='" . $row["size"] . "'
                                            data-brand='" . $row["brand"] . "'
                                            data-category='" . $row["category_id"] . "'>
                                        </i> 
                                        <i class='fa-solid $icon_class toggle-visibility' 
                                            title='$tooltip'
                                            style='cursor: pointer; font-size: 18px; margin-left: 10px;'
                                            data-id='" . $row["product_id"] . "' 
                                            data-visible='" . $row["deleted"] . "'></i>

                                       <i class='fa-solid fa-trash delete-icon' title='Xóa sản phẩm' data-id='" . $row["product_id"] . "'></i>
                                    </div>
                                    <div>
                                        <p class='product-title'>" . $row['title'] . "</p>
                                        <p class='product-description'>" . $row['description'] . "</p>
                                    </div>
                                </td>
                                <td>"  . $row['product_id'] . "</td>
                                <td>" . $row['size'] . "</td>
                                <td>" . $row['price'] . "đ</td>
                                <td>
                                    <div class='progress'>
                                        <span>" . $price_discount . "đ</span>
                                        <div class='progress-bar'>
                                            <div class='filled' style='width: " . ";'></div>
                                        </div>
                                    </div>
                                </td>
                                <td>" . $row['brand'] . "</td>
                                <td>" . $row['name'] . "</td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Không có sản phẩm nào.</td></tr>";
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </main>
        </div>
        <script src="./logic/themSP.js"></script>
        <script src="logic/dialogSP.js"></script>
        <script src="logic/xoaSP.js"></script>
        <script src="logic/showIMG.js"></script>
        <script src="logic/toggle_visibility.js"></script>
</body>

</html>