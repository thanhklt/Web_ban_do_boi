document.querySelectorAll(".toggle-visibility").forEach(icon => {
    icon.addEventListener("click", () => {
        const id = icon.dataset.id;
        const current = icon.dataset.visible;

        fetch("database/toggle_visibility.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `id=${id}&current=${current}`
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                // Cập nhật giao diện
                icon.classList.toggle("fa-eye");
                icon.classList.toggle("fa-eye-slash");
                icon.title = data.new_status == 1 ? "Hiện lại sản phẩm" : "Ẩn sản phẩm";
                icon.dataset.visible = data.new_status;
            }
        });
    });
});
