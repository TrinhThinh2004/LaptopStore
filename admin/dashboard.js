function toggleDisplay(showId, hideId) {
    document.getElementById(showId).style.display = 'block';
    document.getElementById(hideId).style.display = 'none';
}

function showUserManagement() {
    toggleDisplay('userManagement', 'orderManagement');
    toggleDisplay('userManagement', 'cards');
    toggleDisplay('userManagement', 'productsManagement');
}

function showOrderManagement() {
    toggleDisplay('orderManagement', 'userManagement');
    toggleDisplay('orderManagement', 'cards');
    toggleDisplay('orderManagement', 'productsManagement');
}

function showCards() {
    toggleDisplay('cards', 'userManagement');
    toggleDisplay('cards', 'orderManagement');
    toggleDisplay('cards', 'productsManagement');
}

function showProductsManagement() {
    toggleDisplay('productsManagement', 'userManagement')
    toggleDisplay('productsManagement', 'orderManagement')
    toggleDisplay('productsManagement', 'cards')
}

//Xóa user
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

function showEditForm(user) {
    document.getElementById("editUsername").value = user.username;
    document.getElementById("editFullname").value = user.full_name;
    document.getElementById("editEmail").value = user.email;
    document.getElementById("editPhone").value = user.phone_number;
    document.getElementById("editAddress").value = user.address;
    document.getElementById("editRole").value = user.role === "Admin" ? 1 : 0;

    document.getElementById("userManagement").style.display = "none";
    document.getElementById("editUser").classList.remove("hidden");
}

//Ẩn form khi ấn hủy
function hideEditForm() {
    document.getElementById("userManagement").style.display = "block";
    document.getElementById("editUser").classList.add("hidden");
}

document.getElementById("editUserForm").addEventListener("submit", function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    formData.append("action", "update");

    fetch(window.location.href, {
            method: "POST",
            body: formData
        })
        .then(response => {
            if (response.ok) {
                return response.text(); // Only parse response if successful
            } else {
                throw new Error('Network response was not ok.');
            }
        })
        .then(data => {
            alert(data);
            hideEditForm();
            location.reload();
        })
        .catch(error => {
            alert("Cập nhật không thành công: " + error); // Display more specific error
            console.error("Error during update:", error);
        });
});

// Ẩn form khi load trang
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('editUser').classList.add('hidden');
});

//Xóa product
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