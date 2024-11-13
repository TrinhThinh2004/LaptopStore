$(document).ready(function () {
    // Hàm tính lại tổng tiền của từng sản phẩm
    function updateSubtotal(productRow) {
        const priceText = productRow.find('.price-box').text();
        const price = parseFloat(priceText.replace(/[^0-9.-]+/g, ''));
        const quantity = parseInt(productRow.find('.quantity-input').val())
        const subtotal = price * quantity;
        // Cập nhật tổng tiền cho sản phẩm này
        productRow.find('.subtotal').text(subtotal.toLocaleString() + ' đ');
    }

    // Hàm tính tổng tiền của toàn bộ giỏ hàng
    function updateTotalPrice() {
        let totalPrice = 0;
        $('.product-row').each(function () {
            const subtotalText = $(this).find('.subtotal').text();
            const subtotal = parseFloat(subtotalText.replace(/[^0-9.-]+/g, ''));
            totalPrice += subtotal;
        });
        $('#total-price').text(totalPrice.toLocaleString() + ' đ');
    }

    // Sự kiện khi nhấn nút tăng
    $('.btn-increase').click(function () {
        const productRow = $(this).closest('.product-row');
        let quantity = parseInt(productRow.find('.quantity-input').val());
        quantity++;
        productRow.find('.quantity-input').val(quantity);
        updateSubtotal(productRow);
        updateTotalPrice();
        updateQuantity(productRow.data('product-id'), quantity); // Gửi cập nhật về server
    });

    // Sự kiện khi nhấn nút giảm
    $('.btn-decrease').click(function () {
        const productRow = $(this).closest('.product-row');
        let quantity = parseInt(productRow.find('.quantity-input').val());
        if (quantity > 1) {
            quantity--;
            productRow.find('.quantity-input').val(quantity);
            updateSubtotal(productRow);
            updateTotalPrice();
            updateQuantity(productRow.data('product-id'), quantity); // Gửi cập nhật về server
        }
    });

    // Sự kiện khi thay đổi trực tiếp giá trị ô số lượng
    $('.quantity-input').change(function () {
        const productRow = $(this).closest('.product-row');
        let quantity = parseInt($(this).val());
        if (quantity < 1) {
            quantity = 1;
            $(this).val(quantity);
        }
        updateSubtotal(productRow);
        updateTotalPrice();
        updateQuantity(productRow.data('product-id'), quantity); // Gửi cập nhật về server
    });
});

function updateQuantity(productId, quantity) {
    $.ajax({
        url: 'index.php?act=cart',
        type: 'POST',
        data: {
            laptop_id: productId,
            quantity: quantity
        },
        success: function (response) {
            console.log(response); // Xem phản hồi từ server để kiểm tra cập nhật
        }
    });
}
