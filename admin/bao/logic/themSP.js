// Hàm hiển thị form khi nhấn vào nút
// Hiển thị form khi nhấn vào nút "Thêm sản phẩm mới"
document.getElementById("toggleForm").addEventListener("click", function () {
    document.getElementById("add-product-form").style.display = "block";
});

// Ẩn form khi nhấn vào nút "Tắt"
document.getElementById("cancel").addEventListener("click", function () {
    document.getElementById("add-product-form").style.display = "none";
});
