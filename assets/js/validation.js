document.addEventListener("DOMContentLoaded", () => {
    const username = document.getElementById('username');
    const password = document.getElementById('password');
    const confirm_password = document.getElementById('confirm_password');
    const email = document.getElementById('email');
    const form = document.getElementById('register-form'); // Sửa ID ở đây

    const username_error = document.getElementById('username_error');
    const email_error = document.getElementById('email_error');
    const password_error = document.getElementById('password_error');
    const password_confirm_error = document.getElementById('confirm_password_error'); // Sửa ID ở đây

    form.addEventListener('submit', (e) => {
        // Xóa thông báo lỗi cũ
        username_error.innerHTML = "";
        email_error.innerHTML = "";
        password_error.innerHTML = "";
        password_confirm_error.innerHTML = "";

        var email_check = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

        let valid = true;

        // Kiểm tra tên đăng nhập
        if (username.value === '' || username.value == null) {
            e.preventDefault();
            username_error.innerHTML = "Không được để trống!";
            valid = false;
        }

        // Kiểm tra email
        if (!email.value.match(email_check)) {
            e.preventDefault();
            email_error.innerHTML = "Email không hợp lệ!";
            valid = false;
        }

        // Kiểm tra mật khẩu
        if (password.value.length < 6) {
            e.preventDefault();
            password_error.innerHTML = "Mật khẩu phải có ít nhất 6 ký tự.";
            valid = false;
        }

        // Kiểm tra xác nhận mật khẩu
        if (confirm_password.value !== password.value) {
            e.preventDefault();
            password_confirm_error.innerHTML = "Mật khẩu xác nhận không khớp.";
            valid = false;
        }

        if (valid) {
            alert('Đăng ký thành công!');
        }
    });
});
