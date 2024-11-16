$(document).ready(function () {
    $('.add-to-cart').click(function () {
        var laptopId = $(this).data('laptop-id');
        $.ajax({
            url: 'add_to_cart.php',
            type: 'POST',
            data: {
                laptop_id: laptopId,
                add_to_cart: true
            },
            success: function (response) {
                alert('Sản phẩm đã được thêm vào giỏ hàng!');
            },
            error: function (xhr, status, error) {
                alert('Có lỗi xảy ra! Vui lòng thử lại.');
            }
        });
    });
});