<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>
  <div class="nav">
    <div class="store">
      <a href="#"><img src="assets/images/Logo.jpg" class="logo" alt="Logo"></a>
    </div>
    <div class="search-container">
      <input type="text" placeholder="Search" class="search-input">
      <i class="fas fa-search"></i>
    </div>
    <ul>
      <a href="#" class="cart"><i class="fa-solid fa-cart-shopping"></i> Giỏ hàng</a>
      <a href="login.html" class="login"><i class="fa-regular fa-user"></i>Tài khoản</a>
    </ul>
  </div>



  <!-- <div class="banner">
    <div class="banner-item">
      <img src="asset/hp-15-fd0234tu-i5-9q969pa-2-1-750x500.jpg" alt="Laptop HP Banner">
      <div class="banner-text">
        <p>LAPTOP HP CORE I5/R5</p>
        <span class="price">Chỉ từ 13.490.000₫</span>
        <p>TẶNG OFFICE BẢN QUYỀN + TRẢ TRƯỚC 0đ/TRẢ GÓP 0%</p>
        <small>Học sinh – Sinh viên giảm thêm đến 500.000</small>
      </div>
    </div>

    <div class="banner-item">
      <img src="asset/lenovo-ideapad-slim-3-15iah8-i5-83er00evn-glr-2-750x500.jpg" alt="Laptop Lenovo Banner">
      <div class="banner-text">
        <p>LAPTOP LENOVO CORE I5/R5</p>
        <span class="price">Chỉ từ 12.490.000₫</span>
        <p>TẶNG OFFICE BẢN QUYỀN + TRẢ TRƯỚC 0đ/TRẢ GÓP 0%</p>
        <small>Học sinh – Sinh viên giảm thêm đến 500.000</small>
      </div>
    </div>
  </div> -->


  <div class="center">
    <div class="container">
      <div class="filter-options">
        <div class="filter-btn">
          <button id="filterButton"><i class="fa-solid fa-filter"></i>&nbspLọc</button>

          <div class="filter-content">
            <!-- Nội dung hiển thị khi nhấn vào nút Lọc -->
            <div class="filter-section" id="model">
              <h3>Hãng</h3>
              <img src="assets/images/asus/asus.png" alt="HP">
              <img src="assets/images/dell/dell.png" alt="Asus">
              <img src="assets/images/hp/hp.png" alt="Dell">
              <img src="assets/images/lenovo/lenovo.png" alt="Lenovo">
              <img src="assets/images/macbook/macbook.png" alt="Macbook">
              <img src="assets/images/acer/acer.png" alt="Acer">
            </div>

            <div class="filter-section_1">
              <div class="filter-section">
                <h3>Giá</h3>
                <select name="price">
                  <option>none</option>
                  <option>Dưới 10 triệu</option>
                  <option>15 - 20 triệu</option>
                  <option>10 - 15 triệu</option>
                  <option>20 - 25 triệu</option>
                  <option>25 - 30 triệu</option>
                  <option>Trên 30 triệu</option>
                </select>
              </div>

              <div class="filter-section">
                <h3>Loại sản phẩm</h3>
                <select name="type" >
                  <option>none</option>
                  <option>Laptop AI</option>
                  <option>Gaming</option>
                  <option>Học tập, văn phòng</option>
                  <option>Đồ họa</option>
                  <option>Kỹ thuật</option>
                  <option>Mỏng nhẹ</option>
                  <option>Cao cấp</option>
                </select>
              </div>

              <div class="filter-section">
                <h3>RAM</h3>
                  <select name="ram">
                    <option>none</option>
                    <option>2 GB</option>
                    <option>4 GB</option>
                    <option>8 GB</option>
                    <option>16 GB</option>
                    <option>18 GB</option>
                    <option>24 GB</option>
                  </select>
              </div>

              <div class="filter-section">
                <h3>Ổ cứng</h3>
                  <select name="disk">
                    <option>none</option>
                    <option>SSD 2TB</option>
                    <option>SSD 1TB</option>
                    <option>SSD 512GB</option>
                    <option>SSD 256GB</option>
                  </select>
              </div>
            </div>
          </div>
        </div>

        <div class="lst-img">
          <img src="assets/images/asus/asus.png" alt="HP">
          <img src="assets/images/dell/dell.png" alt="Asus">
          <img src="assets/images/hp/hp.png" alt="Dell">
          <img src="assets/images/lenovo/lenovo.png" alt="Lenovo">
          <img src="assets/images/macbook/macbook.png" alt="Macbook">
          <img src="assets/images/acer/acer.png" alt="Acer">
        </div>
      </div>

      <div class="product">
        <img src="assets/images/asus/Asus Vivobook Go 15/1.jpg"
          alt="Laptop Asus Vivobook Go 15 E1504FA R5 7520U/16GB/512GB/Chuột/Win11 (NJ776W)">
        <h3>Laptop Asus Vivobook Go 15 E1504FA R5 7520U/16GB/512GB/Chuột/Win11 (NJ776W)</h3>
        <p class="price">12.590.000₫</p>
        <p class="discount">14.490.000₫</p>
        <p>Quà 1.090.000₫</p>
        <button>Mua ngay</button>
      </div>

      <div class="product">
        <img src="assets/images/dell/Dell Inspiron 15 3520/1.jpg" alt="Dell Inspiron 15 3520 i5 1235U (N5I5052W1)">
        <h3>Dell Inspiron 15 3520 i5 1235U (N5I5052W1)</h3>
        <p class="price">16.490.000₫</p>
        <p class="discount">16.990.000₫ </p>
        <p>Quà 100.000₫</p>
        <button>Mua ngay</button>
      </div>

      <div class="product">
        <img src="assets/images/hp/HP 15 fd0234TU/1.jpg" alt="HP 15 fd0234TU i5 1334U (9Q969PA)">
        <h3>HP 15 fd0234TU i5 1334U (9Q969PA)</h3>
        <p class="price">16.790.000₫</p>
        <p class="discount">19.790.000₫</p>
        <p>Quà 1.190.000₫</p>
        <button>Mua ngay</button>
      </div>

      <div class="product">
        <img src="assets/images/lenovo/Lenovo Ideapad Slim 3/1.jpg"
          alt="Laptop Lenovo Ideapad Slim 3 15IAH8 i5 12450H/16GB/512GB/Win11 (83ER000EVN)">
        <h3>Laptop Lenovo Ideapad Slim 3 15IAH8 i5 12450H/16GB/512GB/Win11 (83ER000EVN)</h3>
        <p class="price">14.290.000₫</p>
        <p class="discount">15.990.000₫</p>
        <p>Quà 1.090.000₫</p>
        <button>Mua ngay</button>
      </div>

      <div class="product">
        <img src="assets/images/macbook/MacBook Air 13 inch/1.jpg" alt="MacBook Air 13 inch M1">
        <h3>MacBook Air 13 inch M1</h3>
        <p class="price">18.590.000₫</p>
        <p class="discount">19.990.000₫</p>
        <button>Mua ngay</button>
      </div>

      <div class="product">
        <img src="assets/images/lenovo/Lenovo Gaming LOQ 15IAX9/1.jpg"
          alt="Laptop Lenovo Gaming LOQ 15IAX9 i5 12450HX/16GB/512GB/6GB RTX3050/144Hz/Win11 (83GS000JVN)">
        <h3>Laptop Lenovo Gaming LOQ 15IAX9 i5 12450HX/16GB/512GB/6GB RTX3050/144Hz/Win11 (83GS000JVN)</h3>
        <p class="price">21.690.000₫</p>
        <p class="discount">24.990.000₫</p>
        <p>Quà 1.090.000₫</p>
        <button>Mua ngay</button>
      </div>

      <div class="product">
        <img src="assets/images/dell/Dell G15 5530/1.jpg"
          alt="Laptop Dell G15 5530 i9 13900HX/16GB/1TB/8GB RTX4060/165Hz/OfficeHS/Win11 (i9HX161W11GR4060)">
        <h3>Laptop Dell G15 5530 i9 13900HX/16GB/1TB/8GB RTX4060/165Hz/OfficeHS/Win11 (i9HX161W11GR4060)</h3>
        <p class="price">40.990.000₫</p>
        <p class="discount">46.190.000₫</p>
        <p>Quà 1.000.000₫</p>
        <button>Mua ngay</button>
      </div>

      <div class="product">
        <img src="assets/images/macbook/Apple MacBook Pro 16 inch/1.jpg" alt="MacBook Pro 16 inch M3 Max">
        <h3>MacBook Pro 16 inch M3 Max</h3>
        <p class="price">109.990.000₫</p>
        <p>Quà 500.000₫</p>
        <button>Mua ngay</button>
      </div>

      <div class="product">
        <img src="assets/images/hp/HP OMEN 16 xf0070AX/1.jpg" alt="HP OMEN 16 xf0070AX R9 7940HS (8W945PA)">
        <h3>HP OMEN 16 xf0070AX R9 7940HS (8W945PA)</h3>
        <p class="price">57.890.000₫</p>
        <p class="discount">62.890.000₫</p>
        <p>Quà 1.190.000₫</p>
        <button>Mua ngay</button>
      </div>

      <div class="product">
        <img src="assets/images/lenovo/Lenovo Gaming Legion Pro 7/1.jpg"
          alt="Laptop Lenovo Gaming Legion Pro 7 16IRX9H i9 14900HX/32GB/1TB/16GB RTX4090/240Hz/Win11">
        <h3>Laptop Lenovo Gaming Legion Pro 7 16IRX9H i9 14900HX/32GB/1TB/16GB RTX4090/240Hz/Win11</h3>
        <p class="price">96.990.000₫</p>
        <p class="discount">106.990.000₫%</p>
        <p>Quà 1.090.000₫</p>
        <button>Mua ngay</button>
      </div>

      <div class="product">
        <img src="assets/images/dell/Dell XPS 13 9340/1.jpg" alt="Dell XPS 13 9340 Ultra 7 155H (HXRGT)">
        <h3>Dell XPS 13 9340 Ultra 7 155H (HXRGT)</h3>
        <p class="price">55.990.000₫</p>
        <p class="discount">59.990.000₫</p>
        <p>Quà 100.000₫</p>
        <button>Mua ngay</button>
      </div>

      <div class="product">
        <img src="assets/images/macbook/MacBook Air 15 inch/1.jpg" alt="MacBook Air 15 inch M3">
        <h3>MacBook Air 15 inch M31</h3>
        <p class="price">36.690.000₫</p>
        <p class="discount">37.990.000₫</p>
        <button>Mua ngay</button>
      </div>
    </div>
  </div>

</html>