<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/checkout.css">
</head>

<body>
    <div class="main">
        <div class="chekout-container">
            <div class="content-box">
                <h2>Thông tin người nhận</h2>
                <h3>Họ tên người nhận</h3>
                <input class="checkout-input" type="text">
                <h3>Email</h3>
                <input class="checkout-input" type="email">
                <h3>Số điện thoại</h3>
                <input class="checkout-input" type="text">
                <h3>Địa chỉ</h3>
                <input class="checkout-input" type="text">
                <div class="payment-type">
                    <h3>Phương thức thanh toán: </h3>
                    <input type="radio" id="payment1" name="payment" value="Tiền mặt">
                    <label for="payment1">Tiền măt</label>
                    <input type="radio" id="payment2" name="payment">
                    <label for="payment2">QR</label>
                </div>
            </div>
            <div class="content-box">
                <h2>Sản phảm đặt hàng</h2>
                <table>
                    <thead>
                        <td>Sản phẩm</td>
                        <td>Số lương</td>
                        <td>Giá</td>
                        <td>Tổng giá</td>
                    </thead>
                    <tbody>
                        <td class="product-content">
                            <img src="assets/images/acer/acer_aspire_3_a315_44p_r9w8_r7/chinh.jpg" alt="">
                            <h3>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</h3>
                        </td>
                        <td>1</td>
                        <td>trăm củaaaaaaaaaa</td>
                        <td>tỷ</td>
                    </tbody>
                </table>
                <h2 class="total-price">Tổng tiền: 000000VNĐ</h2>
                <button class="btn">Đặt hàng</button>
            </div>
        </div>
    </div>
</body>

</html>