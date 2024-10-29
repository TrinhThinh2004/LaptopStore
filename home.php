<?php
ob_start();
include_once("includes/connect.php");

$sql =
  "SELECT laptops.laptop_id, laptops.price, laptops.description, MAX(laptop_images.image_url) AS image_url
FROM laptops
LEFT JOIN laptop_images ON laptops.laptop_id = laptop_images.laptop_id
GROUP BY laptops.laptop_id DESC
ORDER BY laptops.laptop_id DESC
LIMIT 10";

$query = mysqli_query($conn, $sql);

?>

<link rel="stylesheet" href="assets/css/home.css">
<link rel="stylesheet" href="assets/css/header.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<div class="container">
  <div class="carousel">
    <div class="carousel-inner">
      <a href="product.php" class="carousel-item"><img src="https://laptopaz.vn/media/banner/18_Mare95ffd274c039d51bb5b9fa0e7e5dbef.jpg" class="img-feature"></a>
      <a href="product.php" class="carousel-item"><img src="https://laptopaz.vn/media/banner/22_Marf1a391c8c48fca0c805c17e2c743086c.jpg" class="img-feature"></a>
      <a href="product.php" class="carousel-item"><img src="https://laptopaz.vn/media/banner/23_Febb116d6e35406ebdef0d2ac4ce9cdde18.jpg" class="img-feature"></a>
      <a href="product.php" class="carousel-item"><img src="https://laptopaz.vn/media/banner/13_Marebcfec48f483f123a3559f099e10e6e8.jpg" class="img-feature"></a>
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
    <?php
    while ($product = mysqli_fetch_array($query)) { ?>
      <a href="product_detail.php?id=<?php echo $product['laptop_id']?> " class="product-link">
        <div class="product">
          <img
            src="<?php echo htmlspecialchars($product['image_url']); ?>"
            alt="<?php echo htmlspecialchars($product['description']); ?>">
          <h3><?php echo htmlspecialchars($product['description']); ?></h3>
          <p class="price"><?php echo number_format($product['price'], 0, ',', '.'); ?>₫</p>
          <p class="discount"><?php echo number_format($product['price'] * 1.2, 0, ',', '.'); ?>₫</p>
          <div class="button-container">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" style="display: inline;">
              <input type="hidden" name="product_id" value="83ER000EVN">
              <button type="submit" class="btn">Mua ngay</button>
            </form>

            <form action="cart.php" method="POST" style="display: inline;">
              <input type="hidden" name="product_id" value="83ER000EVN">
              <button type="submit" class="btn">Giỏ hàng</button>
            </form>
          </div>
        </div>
      </a>
    <?php
    }
    ?>
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