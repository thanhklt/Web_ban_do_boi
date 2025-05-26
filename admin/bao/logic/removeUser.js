function removeUser(id) {
    if (confirm("Bạn có chắc chắn muốn xoá người dùng này?")) {
        fetch("database/remove_user.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert("Xóa thành công!");
                location.reload();
            } else {
                alert("Lỗi xoá: " + data.message);
            }
        })
        .catch(err => {
            alert("Lỗi khi gửi yêu cầu xoá");
            console.error(err);
        });
    }
}
