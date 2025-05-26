document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".delete-icon").forEach(button => {
        button.addEventListener("click", async function () {
            const productId = this.dataset.id;
            if (confirm("Bạn có chắc chắn muốn xóa không?")) {
                try {
                    const response = await fetch("database/remove_product.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        body: "id=" + productId
                    });
                    
                    // Kiểm tra nếu response không phải JSON
                    const text = await response.text();
                    try {
                        const data = JSON.parse(text);
                        if (data.success) {
                            this.closest("tr").remove();
                            alert(data.message);
                        } else {
                            alert("Lỗi: Sản phẩm đang được bán không thể xóa");
                        }
                    } catch (e) {
                        console.error("Response không phải JSON:", text);
                        alert("Lỗi hệ thống. Vui lòng kiểm tra console để biết chi tiết.");
                    }
                } catch (error) {
                    console.error("Lỗi fetch:", error);
                    alert("Lỗi kết nối: " + error.message);
                }
            }
        });
    });
});