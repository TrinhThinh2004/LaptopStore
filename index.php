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
  <?php
  include('includes/header.php');
  ?>

  <!-- <div class="nav">
    <h2 class="logo">Laptop4U</h2>
    <div class="search-container">
      <input type="text" placeholder="Search" class="search-input">
      <i class="fas fa-search"></i>
    </div>
    <ul>
      <i class="fa-solid fa-cart-shopping"></i>
      <li class="nav-item">
        <a href="#">Đăng ký</a>
      </li>
      <li class="nav-item">
        <a href="#">Đăng nhập</a>
      </li>
    </ul>
  </div> -->

  <!-- <div class="filter-options">
    <label for="price">Giá:</label>
    <select id="price">
      <option value="all">Tất cả</option>
      <option value="low">Dưới 10 triệu</option>
      <option value="medium">10-20 triệu</option>
      <option value="high">Trên 20 triệu</option>
    </select>
    <label for="brand">Thương hiệu:</label>
    <select id="brand">
      <option value="all">Tất cả</option>
      <option value="hp">HP</option>
      <option value="asus">Asus</option>
      <option value="dell">Dell</option>
      <option value="lenovo">Lenovo</option>
      <option value="acer">Acer</option>
      <option value="msi">MSI</option>
    </select>
    <label for="ram">RAM:</label>
    <select id="ram">
      <option value="all">Tất cả</option>
      <option value="2gb">2 GB</option>
      <option value="4gb">4 GB</option>
      <option value="8gb">8 GB</option>
    </select>
    <label for="rom">ROM:</label>
    <select id="rom">
      <option value="all">Tất cả</option>
      <option value="128gb">128 GB</option>
      <option value="256gb">256 GB</option>
      <option value="512gb">512 GB</option>
    </select>
    <label for="gpu">GPU:</label>
    <select id="gpu">
      <option value="all">Tất cả</option>
      <option value="intel">Intel</option>
      <option value="amd">AMD</option>
      <option value="nvidia">NVIDIA</option>
    </select>
    <label for="os">Hệ điều hành:</label>
    <select id="os">
      <option value="all">Tất cả</option>
      <option value="windows">Windows</option>
      <option value="macos">MacOS</option>
      <option value="linux">Linux</option>
    </select>
    <label for="screen">Màn hình:</label>
    <select id="screen">
      <option value="all">Tất cả</option>
      <option value="13inch">13 inch</option>
      <option value="15inch">15 inch</option>
      <option value="17inch">17 inch</option>
    </select>
    <label for="sort">Sắp xếp theo:</label>
    <select id="sort">
      <option value="all">Tất cả</option>
      <option value="price-asc">Giá tăng dần</option>
      <option value="price-desc">Giá giảm dần</option>
    </select>
  </div>
  <div class="filter-buttons">
    <button id="clear-btn">Xóa</button>
    <button id="filter-btn">Tìm kiếm</button>
  </div> -->

  <!-- <div class="sidebar" style="width: 25%">
    <table class="sidebar-table">
      <tr>
        <td><a href="#">Laptop Dell</a></td>
      </tr>

      <tr>
        <td><a href="#">Laptop HP</a></td>
      </tr>

      <tr>
        <td><a href="#">Macbook</a></td>
      </tr>

      <tr>
        <td><a href="#">Laptop Asus</a></td>
      </tr>

      <tr>
        <td><a href="#">Laptop Lenovo</a></td>
      </tr>
    </table>
  </div> -->

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
        <button class="filter-btn">Lọc</button>
        <img src="asset/hp.png" alt="HP">
        <img src="asset/asus.png" alt="Asus">
        <img src="asset/dell.png" alt="Dell">
        <img src="asset/lenovo.png" alt="Lenovo">
        <img src="asset/macbook.png" alt="Macbook">
      </div>

      <div class="product">
        <img src="https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
          alt="Laptop Asus Vivobook Go 15 E1504FA R5 7520U/16GB/512GB/Chuột/Win11 (NJ776W)">
        <h3>Laptop Asus Vivobook Go 15 E1504FA R5 7520U/16GB/512GB/Chuột/Win11 (NJ776W)</h3>
        <p class="price">12.590.000₫</p>
        <p class="discount">14.490.000₫</p>
        <p>Quà 1.090.000₫</p>
        <button>Mua ngay</button>
      </div>

      <div class="product">
        <img src="https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
          alt="Dell Inspiron 15 3520 i5 1235U (N5I5052W1)">
        <h3>Dell Inspiron 15 3520 i5 1235U (N5I5052W1)</h3>
        <p class="price">16.490.000₫</p>
        <p class="discount">16.990.000₫ </p>
        <p>Quà 100.000₫</p>
        <button>Mua ngay</button>
      </div>

      <div class="product">
        <img src="https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
          alt="HP 15 fd0234TU i5 1334U (9Q969PA)">
        <h3>HP 15 fd0234TU i5 1334U (9Q969PA)</h3>
        <p class="price">16.790.000₫</p>
        <p class="discount">19.790.000₫</p>
        <p>Quà 1.190.000₫</p>
        <button>Mua ngay</button>
      </div>

      <div class="product">
        <img src="https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
          alt="Laptop Lenovo Ideapad Slim 3 15IAH8 i5 12450H/16GB/512GB/Win11 (83ER000EVN)">
        <h3>Laptop Lenovo Ideapad Slim 3 15IAH8 i5 12450H/16GB/512GB/Win11 (83ER000EVN)</h3>
        <p class="price">14.290.000₫</p>
        <p class="discount">15.990.000₫</p>
        <p>Quà 1.090.000₫</p>
        <button>Mua ngay</button>
      </div>

      <div class="product">
        <img src="https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
        <h3>MacBook Air 13 inch M1</h3>
        <p class="price">18.590.000₫</p>
        <p class="discount">19.990.000₫</p>
        <button>Mua ngay</button>
      </div>

      <div class="product">
        <img src="https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
          alt="Laptop Lenovo Gaming LOQ 15IAX9 i5 12450HX/16GB/512GB/6GB RTX3050/144Hz/Win11 (83GS000JVN)">
        <h3>Laptop Lenovo Gaming LOQ 15IAX9 i5 12450HX/16GB/512GB/6GB RTX3050/144Hz/Win11 (83GS000JVN)</h3>
        <p class="price">21.690.000₫</p>
        <p class="discount">24.990.000₫</p>
        <p>Quà 1.090.000₫</p>
        <button>Mua ngay</button>
      </div>

      <div class="product">
        <img src="https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
          alt="Laptop Dell G15 5530 i9 13900HX/16GB/1TB/8GB RTX4060/165Hz/OfficeHS/Win11 (i9HX161W11GR4060)">
        <h3>Laptop Dell G15 5530 i9 13900HX/16GB/1TB/8GB RTX4060/165Hz/OfficeHS/Win11 (i9HX161W11GR4060)</h3>
        <p class="price">40.990.000₫</p>
        <p class="discount">46.190.000₫</p>
        <p>Quà 1.000.000₫</p>
        <button>Mua ngay</button>
      </div>

      <div class="product">
        <img src="https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
          alt="MacBook Pro 16 inch M3 Max">
        <h3>MacBook Pro 16 inch M3 Max</h3>
        <p class="price">109.990.000₫</p>
        <p>Quà 500.000₫</p>
        <button>Mua ngay</button>
      </div>

      <div class="product">
        <img src="https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
          alt="HP OMEN 16 xf0070AX R9 7940HS (8W945PA)">
        <h3>HP OMEN 16 xf0070AX R9 7940HS (8W945PA)</h3>
        <p class="price">57.890.000₫</p>
        <p class="discount">62.890.000₫</p>
        <p>Quà 1.190.000₫</p>
        <button>Mua ngay</button>
      </div>

      <div class="product">
        <img src="https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
          alt="Laptop Lenovo Gaming Legion Pro 7 16IRX9H i9 14900HX/32GB/1TB/16GB RTX4090/240Hz/Win11">
        <h3>Laptop Lenovo Gaming Legion Pro 7 16IRX9H i9 14900HX/32GB/1TB/16GB RTX4090/240Hz/Win11</h3>
        <p class="price">96.990.000₫</p>
        <p class="discount">106.990.000₫%</p>
        <p>Quà 1.090.000₫</p>
        <button>Mua ngay</button>
      </div>

      <div class="product">
        <img src="https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
          alt="Dell XPS 13 9340 Ultra 7 155H (HXRGT)">
        <h3>Dell XPS 13 9340 Ultra 7 155H (HXRGT)</h3>
        <p class="price">55.990.000₫</p>
        <p class="discount">59.990.000₫</p>
        <p>Quà 100.000₫</p>
        <button>Mua ngay</button>
      </div>

      <div class="product">
        <img src="https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
        <h3>MacBook Air 15 inch M31</h3>
        <p class="price">36.690.000₫</p>
        <p class="discount">37.990.000₫</p>
        <button>Mua ngay</button>
      </div>
    </div>
  </div>

</html>