// Tự động ẩn alert
setTimeout(function () {
    var alertContainer = document.getElementById("alertContainer");
    if (alertContainer) {
        alertContainer.style.display = 'none';
    }
}, 3000);


// Hàm để hiển thị nội dung của popup từ một tệp HTML
function showPopupContent(filename) {
    // Sử dụng AJAX để tải nội dung từ tệp HTML
    var xhr = new XMLHttpRequest();
    xhr.open("GET", filename, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Hiển thị nội dung từ tệp HTML trong popup
            popupContainer.innerHTML = xhr.responseText;
            popupContainer.style.display = "block";
        }
    };
    xhr.send();
}

// Lấy danh sách tất cả các phần tử có class name "openPopup"
var openPopupButtons = document.querySelectorAll(".openPopup");

// Lắng nghe sự kiện click trên tất cả các nút có class name "openPopup"
openPopupButtons.forEach(function (button) {
    button.addEventListener("click", function (event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết
        showPopupContent(button.getAttribute("data-target")); // Sử dụng thuộc tính "data-target" để xác định nội dung cần hiển thị
    });
});


// Lắng nghe sự kiện click trên vùng nền mờ (overlay) để tắt popup
document.addEventListener("click", function (event) {
    if (event.target === popupContainer) {
        popupContainer.style.display = "none";
    }
});// Instantiate the Bootstrap carousel
$('.multi-item-carousel').carousel({
    interval: false
});


