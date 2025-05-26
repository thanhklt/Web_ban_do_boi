
document.getElementById('thumbnail_1').addEventListener('change', function (event) {
    const files = event.target.files;
    const previewContainer = document.getElementById('previewContainer1');

    // Xóa các ảnh cũ
    previewContainer.innerHTML = "";

    // Duyệt và tạo thẻ img cho mỗi ảnh
    Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.createElement("img");
            img.src = e.target.result;
            img.style.width = "100px";
            img.style.marginRight = "5px";
            previewContainer1.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
});


document.getElementById('thumbnail_2').addEventListener('change', function (event) {
    const files = event.target.files;
    const previewContainer = document.getElementById('previewContainer2');

    // Xóa các ảnh cũ
    previewContainer.innerHTML = "";

    // Duyệt và tạo thẻ img cho mỗi ảnh
    Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.createElement("img");
            img.src = e.target.result;
            img.style.width = "100px";
            img.style.marginRight = "5px";
            previewContainer2.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
});

