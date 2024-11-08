
function updateQuantity(laptop_id, quantity) {
    $.ajax({
        url: 'index.php?act=cart',
        type: 'POST',
        data: {
            action: 'update_quantity',
            laptop_id: laptop_id,
            quantity: quantity
        },
        success: function (response) {
            // Parse the JSON response
            const data = JSON.parse(response);

            if (data.success) {
                // Update the total price in the DOM
                console.log("Response received:", response);
                document.querySelector('.checkout-box h2').textContent = 'Tổng tiền: ' + data.total_price;
            } else {
                alert('Error updating quantity');
            }
        },
        error: function () {
            alert('AJAX request failed');
        }
    });
}