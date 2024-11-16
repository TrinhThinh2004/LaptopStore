// Ẩn tất cả các phần
function hideAllSections() {
    document.getElementById("userManagement").style.display = 'none';
    document.getElementById("orderManagement").style.display = 'none';
    document.getElementById("cards").style.display = 'none';
    document.getElementById("productManagement").style.display = 'none';
    document.getElementById("addProduct").classList.add("hidden");
    document.getElementById("editUser").classList.add("hidden");
}

// Hiển thị một phần cụ thể
function toggleDisplay(showId) {
    hideAllSections();
    document.getElementById(showId).style.display = 'block';
}

// Các hàm hiển thị từng phần cụ thể
function showUserManagement() {
    toggleDisplay('userManagement');
}

function showOrderManagement() {
    toggleDisplay('orderManagement');
}

function showCards() {
    toggleDisplay('cards');
}

function showProductManagement() {
    toggleDisplay('productManagement');
}

function showAddProductForm(product = null) {
    hideAllSections();
    document.getElementById("addProduct").classList.remove("hidden");

    // Reset form khi thêm sản phẩm mới
    document.getElementById("addProductForm").reset();
}

function showEditForm(user) {
    hideAllSections();
    document.getElementById("editUsername").value = user.username;
    document.getElementById("editFullname").value = user.full_name;
    document.getElementById("editEmail").value = user.email;
    document.getElementById("editPhone").value = user.phone_number;
    document.getElementById("editAddress").value = user.address;
    document.getElementById("editRole").value = user.role === "Admin" ? 1 : 0;

    document.getElementById("editUser").classList.remove("hidden");
}

// Ẩn form khi ấn hủy
function hideEditForm() {
    document.getElementById("userManagement").style.display = "block";
    document.getElementById("editUser").classList.add("hidden");
}

function hideEdit() {
    document.getElementById("productManagement").style.display = "block";
    document.getElementById("addProduct").classList.add("hidden");
}

// Xóa user
function deleteUser(anchorElement) {
    if (confirm("Bạn có chắc chắn muốn xóa người dùng này không?")) {
        var userid = anchorElement.getAttribute("data-userid");

        fetch(window.location.href, {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "user_id=" + encodeURIComponent(userid) + "&action=delete"
        }).then(response => {
            if (response.ok) {
                anchorElement.closest('tr').remove();
                alert("Xóa người dùng thành công !");
            } else {
                alert("Xóa người dùng không thành công !");
            }
        });
    }
}

// Xóa sản phẩm
function deleteProduct(anchorElement) {
    if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?")) {
        var laptopid = anchorElement.getAttribute("data-laptopid");

        fetch(window.location.href, {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "laptop_id=" + encodeURIComponent(laptopid) + "&action=delete"
        }).then(response => {
            if (response.ok) {
                anchorElement.closest('tr').remove();
                alert("Xóa sản phẩm thành công !");
            } else {
                alert("Xóa sản phẩm không thành công !");
            }
        });
    }
}

// Ẩn tất cả các phần và hiển thị phần 'cards' khi load trang
document.addEventListener('DOMContentLoaded', function () {
    hideAllSections();
    document.getElementById("cards").style.display = 'block'; // Hiển thị phần 'cards'
});

function previewImages(input, previewContainer) {
    previewContainer.innerHTML = ''; // Xóa preview cũ
    const files = input.files;
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();

        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            previewContainer.appendChild(img);
        }

        reader.readAsDataURL(file);
    }
}

document.getElementById('addImage').addEventListener('change', function() {
    const previewContainer = document.getElementById('imagePreview');
    previewImages(this, previewContainer);
});

document.getElementById('addMultiImage').addEventListener('change', function() {
    const previewContainer = document.getElementById('multiImagePreview');
    previewImages(this, previewContainer);
});
