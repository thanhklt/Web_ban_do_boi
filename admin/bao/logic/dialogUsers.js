document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".edit-icon").forEach(icon => {
        icon.addEventListener("click", () => {
            // Lấy dữ liệu từ các thuộc tính data-*
            const tenDangNhap = icon.dataset.username;
            const userId = icon.dataset.id;
            const userName = icon.dataset.name;
            const userEmail = icon.dataset.email;
            const userPassword = icon.dataset.password;
            const userPhoneNumber = icon.dataset.phonenumber || icon.dataset.phoneNumber;
            
            // Kiểm tra xem các phần tử có tồn tại không
            const usernameRepair = document.getElementById("usernameRepair");
            const idRepair = document.getElementById("idRepair");
            const nameRepair = document.getElementById("nameRepair");
            const emailRepair = document.getElementById("emailRepair");
            const passwordRepair = document.getElementById("passwordRepair");
            const phoneNumberRepair = document.getElementById("phoneNumberRepair");
             
            if (!idRepair || !nameRepair || !emailRepair || !passwordRepair || !usernameRepair || !phoneNumberRepair) {
                console.error("Một hoặc nhiều phần tử không tồn tại trong DOM.");
                return;
            }

            // Điền dữ liệu vào các trường trong form
            usernameRepair.value = tenDangNhap;
            idRepair.value = userId;
            nameRepair.value = userName;
            emailRepair.value = userEmail;
            passwordRepair.value = userPassword;
            phoneNumberRepair.value = userPhoneNumber;

            // Hiển thị form chỉnh sửa
            document.getElementById("formUser").style.display = "block";
        });
    });
});