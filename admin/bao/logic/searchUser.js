document.getElementById("search").addEventListener("keyup", function () {
    const searchValue = this.value;

    fetch("database/search_user.php?query=" + encodeURIComponent(searchValue))
        .then(response => response.text())
        .then(data => {
            document.querySelector("tbody").innerHTML = data; // Cập nhật bảng với kết quả tìm kiếm
        })
        .catch(error => console.error("Lỗi:", error));
});