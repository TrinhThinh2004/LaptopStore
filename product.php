<html>

<head>
    <title>
        Product Page
    </title>
    <link rel="stylesheet" href="assets/css/product.css">
    <link rel="stylesheet" href="assets/css/base.css">
    <script>
        function changeImage(src) {
            const mainImage = document.getElementById('main-image');
            mainImage.src = src;
        }
    </script>
</head>

<body>
    <div class="main">
        <div class="container">
            <div class="left-section">
                <img id="main-image" alt="Laptop image" height="400" src="assets/images/img_product/product1.jpg" width="600" />
                <div class="thumbnail-container">
                    <img alt="Thumbnail 1" height="60" src="assets/images/img_product/product1.jpg" onclick="changeImage(this.src)" />
                    <img alt="Thumbnail 1" height="60" src="assets/images/img_product/product2.jpg" onclick="changeImage(this.src)" />
                    <img alt="Thumbnail 2" height="60" src="assets/images/img_product/product3.jpg" onclick="changeImage(this.src)" />
                    <img alt="Thumbnail 3" height="60" src="assets/images/img_product/product4.jpg" onclick="changeImage(this.src)" />
                    <img alt="Thumbnail 4" height="60" src="assets/images/img_product/product5.jpg" onclick="changeImage(this.src)" />
                    <img alt="Thumbnail 5" height="60" src="assets/images/img_product/product6.jpg" onclick="changeImage(this.src)" />
                </div>
            </div>
            <div class="right-section">
                <h2>Laptop Lenovo Ideapad Slim 3 15IAH8 i5 12450H/16GB/512GB/Win11 (83ER000EVN)</h2>

                <div class="price-section">
                    <span class="price">36.690.000₫</span>
                    <span class="old-price">37.990.000₫</span>
                </div>
                <div class="content">
                    <h3>Thông số kỹ thuật</h3>
                    <table>
                        
                        <tr>
                            <td>Laptop ID</td>
                            <td>001</td>
                        </tr>
                        <tr>
                            <td>Brand</td>
                            <td>Lenovo</td>
                        </tr>
                        <tr>
                            <td>Model</td>
                            <td>Ideapad Slim 3 15IAH8</td>
                        </tr>
                        <tr>
                            <td>Bộ xử lí</td>
                            <td>Intel Core i5-12450H</td>
                        </tr>
                        <tr>
                            <td>Ram</td>
                            <td>16GB</td>
                        </tr>
                        <tr>
                            <td>Kiểu Ram</td>
                            <td>DDR4</td>
                        </tr>
                        <tr>
                            <td>Tốc độ Ram</td>
                            <td>3200MHz</td>
                        </tr>
                        <tr>
                            <td>Bộ nhớ</td>
                            <td>512GB</td>
                        </tr>
                        <tr>
                            <td>Loại lưu trữ</td>
                            <td>NVMe SSD</td>
                        </tr>
                        <tr>
                            <td>Gpu</td>
                            <td>Intel Iris Xe Graphics</td>
                        </tr>
                        <tr>
                            <td>Tỉ lệ màn hình</td>
                            <td>15.6 inches</td>
                        </tr>
                        <tr>
                            <td>Độ phân giải</td>
                            <td>1920x1080p (FullHD)</td>
                        </tr>
                        <tr>
                            <td>Độ làm mới</td>
                            <td>60Hz</td>
                        </tr>
                    </table>
                </div>
                <div class="cta-buttons">
                    <button class="buy">Mua ngay</button>
                    <button class="shoppingcart">Thêm vào giỏ hàng</button>

                </div>

            </div>
        </div>
    </div>
</body>

</html>