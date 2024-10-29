<?php
ob_start();

if (isset($_POST["submit"])) {
  $product_id = $_POST['product_id'];
  if ($product_id) {
    header('location: checkout.php?product_id=' . urlencode($product_id));
    exit;
  } else {
    echo "Sản phẩm không tồn tại!";
  }
};
?>

<link rel="stylesheet" href="assets/css/home.css">
<link rel="stylesheet" href="assets/css/header.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<div class="container">
  <div class="carousel">
    <div class="carousel-inner">
      <img src="https://laptopaz.vn/media/banner/18_Mare95ffd274c039d51bb5b9fa0e7e5dbef.jpg" class="img-feature">
      <img src="https://laptopaz.vn/media/banner/22_Marf1a391c8c48fca0c805c17e2c743086c.jpg" class="img-feature">
    </div>
    <button class="control prev"><i class="fa-solid fa-arrow-left"></i></button>
    <button class="control next"><i class="fa-solid fa-arrow-right"></i></button>
  </div>

  <div class="lst-img">
    <img src="assets/images/logo/asus.png" alt="HP">
    <img src="assets/images/logo/dell.png" alt="Asus">
    <img src="assets/images/logo/hp.png" alt="Dell">
    <img src="assets/images/logo/lenovo.png" alt="Lenovo">
    <img src="assets/images/logo/macbook.png" alt="Macbook">
    <img src="assets/images/logo/acer.png" alt="Acer">
    <img src="assets/images/logo/msi.png" alt="MSI">
  </div>
  <div class="filter-section">
    <div>
      <h3>Giá:
        <select name="price">
          <option>none</option>
          <option>Dưới 10 triệu</option>
          <option>15 - 20 triệu</option>
          <option>10 - 15 triệu</option>
          <option>20 - 25 triệu</option>
          <option>25 - 30 triệu</option>
          <option>Trên 30 triệu</option>
        </select>
      </h3>
    </div>

    <div>
      <h3>Loại sản phẩm:
        <select name="type">
          <option>none</option>
          <option>Laptop AI</option>
          <option>Gaming</option>
          <option>Học tập, văn phòng</option>
          <option>Đồ họa</option>
          <option>Kỹ thuật</option>
          <option>Mỏng nhẹ</option>
          <option>Cao cấp</option>
        </select>
      </h3>
    </div>

    <div>
      <h3>RAM:
        <select name="ram">
          <option>none</option>
          <option>2 GB</option>
          <option>4 GB</option>
          <option>8 GB</option>
          <option>16 GB</option>
          <option>18 GB</option>
          <option>24 GB</option>
        </select>
      </h3>
    </div>

    <div>
      <h3>Ổ cứng:
        <select name="disk">
          <option>none</option>
          <option>SSD 2TB</option>
          <option>SSD 1TB</option>
          <option>SSD 512GB</option>
          <option>SSD 256GB</option>
        </select>
      </h3>
    </div>
    <button id="filterButton"><i class="fa-solid fa-filter"></i>&nbspLọc</button>
  </div>
  <div class="product-container">
    <div class="product" >
      <img
        src="https://cdn.tgdd.vn/Products/Images/44/313333/lenovo-ideapad-slim-3-15iah8-i5-83er00evn-thumb-600x600.jpg"
        alt="Laptop Lenovo Ideapad Slim 3 15IAH8 i5 12450H/16GB/512GB/Win11 (83ER000EVN)">
      <h3>Laptop Lenovo Ideapad Slim 3 15IAH8 i5 12450H/16GB/512GB/Win11 (83ER000EVN)</h3>
      <p class="price">36.690.000₫</p>
      <p class="discount">37.990.000₫</p>
      <div class="button-container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" style="display: inline;">
          <input type="hidden" name="product_id" value="83ER000EVN">
          <button type="submit" class="btn">Mua ngay</button>
        </form>

        <form action="cart.php" method="POST" style="display: inline;">
          <input type="hidden" name="product_id" value="83ER000EVN">
          <button type="submit" class="btn">Thêm</button>
        </form>
      </div>
    </div>
    <div class="product">
      <img src="https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=600"
        alt="MacBook Air 15 inch M3">
      <h3>MacBook Air 15 inch M3</h3>
      <p class="price">36.690.000₫</p>
      <p class="discount">37.990.000₫</p>
      <div class="button-container">
        <button>Mua ngay</button>
      </div>
    </div>
    <div class="product">
      <img src="https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=600"
        alt="MacBook Air 15 inch M3">
      <h3>MacBook Air 15 inch M3</h3>
      <p class="price">36.690.000₫</p>
      <p class="discount">37.990.000₫</p>
      <div class="button-container">
        <button>Mua ngay</button>
      </div>
    </div>
    <div class="product">
      <img src="https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=600"
        alt="MacBook Air 15 inch M3">
      <h3>MacBook Air 15 inch M3</h3>
      <p class="price">36.690.000₫</p>
      <p class="discount">37.990.000₫</p>
      <div class="button-container">
        <button>Mua ngay</button>
      </div>
    </div>
    <div class="product">
      <img src="https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=600"
        alt="MacBook Air 15 inch M3">
      <h3>MacBook Air 15 inch M3</h3>
      <p class="price">36.690.000₫</p>
      <p class="discount">37.990.000₫</p>
      <div class="button-container">
        <button>Mua ngay</button>
      </div>
    </div>
    <div class="product">
      <img src="https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=600"
        alt="MacBook Air 15 inch M3">
      <h3>MacBook Air 15 inch M3</h3>
      <p class="price">36.690.000₫</p>
      <p class="discount">37.990.000₫</p>
      <div class="button-container">
        <button>Mua ngay</button>
      </div>
    </div>
  </div>
</div>

<script>
  const carouselInner = document.querySelector('.carousel-inner');
  const images = document.querySelectorAll('.img-feature');
  let index = 0;

  document.querySelector('.next').addEventListener('click', () => {
    index = (index + 1) % images.length;
    updateCarousel();
  });

  document.querySelector('.prev').addEventListener('click', () => {
    index = (index - 1 + images.length) % images.length;
    updateCarousel();
  });

  function updateCarousel() {
    const offset = -index * 100;
    carouselInner.style.transform = `translateX(${offset}%)`;
  }
</script>