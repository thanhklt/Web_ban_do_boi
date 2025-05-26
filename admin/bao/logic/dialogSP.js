document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".edit-icon").forEach(icon => {
        icon.addEventListener("click", () => {
            document.getElementById("formND").style.display = "block";

            document.getElementById("idRepair").value = icon.dataset.id;
            document.getElementById("nameRepair").value = icon.dataset.title;
            document.getElementById("inforRepair").value = icon.dataset.description;
            document.getElementById("priceRepair").value = icon.dataset.price +"đ";
            document.getElementById("discountRepair").value = icon.dataset.discount + "%";
            document.getElementById("sizeRepair").value = icon.dataset.size;
            document.getElementById("brandRepair").value = icon.dataset.brand;
            document.getElementById("categoryRepair").value = icon.dataset.category;

            const img1 = document.getElementById("previewImg1");
            img1.src = "../../USER/Img_Product/" + icon.dataset.thumbnail1;
            img1.style.display = "block";

            const img2 = document.getElementById("previewImg2");
            img2.src = "../../USER/Img_Product/" + icon.dataset.thumbnail2;
            img2.style.display = "block";
        });
    });

    document.getElementById("cancelChange").addEventListener("click", () => {
        if (confirm("Bạn chắc chắn muốn đóng form sửa?")) {
            document.getElementById("formND").style.display = "none";
        }
    });

    document.getElementById("thumbnail1").addEventListener("change", function (e) {
        const file = e.target.files[0];
        const imgPreview = document.getElementById("previewImg1");
        if (file) {
            imgPreview.src = URL.createObjectURL(file);
            imgPreview.style.display = "block";
        } else {
            imgPreview.src = "";
            imgPreview.style.display = "none";
        }
    });

    document.getElementById("thumbnail2").addEventListener("change", function (e) {
        const file = e.target.files[0];
        const imgPreview = document.getElementById("previewImg2");
        if (file) {
            imgPreview.src = URL.createObjectURL(file);
            imgPreview.style.display = "block";
        } else {
            imgPreview.src = "";
            imgPreview.style.display = "none";
        }
    });

    document.getElementById("formND").addEventListener("submit", function (e) {
        const rawId = document.getElementById("idRepair").value;
        const numericId = rawId.replace(/^SP/, '');

        let hiddenInput = document.getElementById("trueId");
        if (!hiddenInput) {
            hiddenInput = document.createElement("input");
            hiddenInput.type = "hidden";
            hiddenInput.name = "id";
            hiddenInput.id = "trueId";
            this.appendChild(hiddenInput);
        }
        hiddenInput.value = numericId;
    });
});
