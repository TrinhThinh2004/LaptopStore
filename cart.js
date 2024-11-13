$(document).ready(function () {
    // Hàm tính lại tổng tiền của từng sản phẩm
    function updateSubtotal(productElement) {
        const price = parseFloat(productElement.data('price'));
        const quantity = parseInt(productElement.find('.quantity').val());
        const subtotal = price * quantity;
        productElement.find('.subtotal').text(subtotal.toLocaleString());
    }

    // Hàm tính tổng tiền của toàn bộ giỏ hàng
    function updateTotalPrice() {
        let totalPrice = 0;
        $('#cart .product').each(function () {
            const subtotal = parseFloat($(this).find('.subtotal').text().replace(/,/g, ''));
            totalPrice += subtotal;
        });
        $('#total-price').text(totalPrice.toLocaleString());
    }

    // Sự kiện khi nhấn nút tăng
    $('.btn-increase').click(function () {
        const productElement = $(this).closest('.product');
        let quantity = parseInt(productElement.find('.quantity').val());
        quantity++;
        productElement.find('.quantity').val(quantity);
        updateSubtotal(productElement);
        updateTotalPrice();
    });

    // Sự kiện khi nhấn nút giảm
    $('.btn-decrease').click(function () {
        const productElement = $(this).closest('.product');
        let quantity = parseInt(productElement.find('.quantity').val());
        if (quantity > 1) {
            quantity--;
            productElement.find('.quantity').val(quantity);
            updateSubtotal(productElement);
            updateTotalPrice();
        }
    });

    // Sự kiện khi thay đổi trực tiếp giá trị ô số lượng
    $('.quantity').change(function () {
        const productElement = $(this).closest('.product');
        let quantity = parseInt($(this).val());
        if (quantity < 1) {
            quantity = 1;
            $(this).val(quantity);
        }
        updateSubtotal(productElement);
        updateTotalPrice();
    });
});
