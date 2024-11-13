<?php
ob_start();
include_once("includes/connect.php");

$sql =
  "SELECT laptops.laptop_id, laptops.price, laptops.description, MAX(laptop_images.image_url) AS image_url
FROM laptops
LEFT JOIN laptop_images ON laptops.laptop_id = laptop_images.laptop_id
WHERE laptops.deleted = 0
GROUP BY laptops.laptop_id DESC
ORDER BY laptops.laptop_id DESC
LIMIT 10";

$query = mysqli_query($conn, $sql);

include("includes/add_to_cart.php");

?>

<link rel="stylesheet" href="assets/css/home.css">
<link rel="stylesheet" href="assets/css/header.css">
<link rel="stylesheet" href="assets/css/filter.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<div class="container">
  <div class="carousel">
    <div class="carousel-inner">
      <a href="index.php?act=products" class="carousel-item"><img src="https://laptopaz.vn/media/banner/18_Mare95ffd274c039d51bb5b9fa0e7e5dbef.jpg" class="img-feature"></a>
      <a href="index.php?act=products" class="carousel-item"><img src="https://laptopaz.vn/media/banner/22_Marf1a391c8c48fca0c805c17e2c743086c.jpg" class="img-feature"></a>
      <a href="index.php?act=products" class="carousel-item"><img src="https://laptopaz.vn/media/banner/23_Febb116d6e35406ebdef0d2ac4ce9cdde18.jpg" class="img-feature"></a>
      <a href="index.php?act=products" class="carousel-item"><img src="https://laptopaz.vn/media/banner/13_Marebcfec48f483f123a3559f099e10e6e8.jpg" class="img-feature"></a>
    </div>
    <button class="control prev"><i class="fa-solid fa-arrow-left"></i></button>
    <button class="control next"><i class="fa-solid fa-arrow-right"></i></button>
  </div>

  <?php include("includes/filter.php"); ?>

  <div class="product-container">
    <?php
    while ($product = mysqli_fetch_array($query)) { ?>
      <a href="index.php?act=product_detail&id=<?php echo $product['laptop_id'] ?>" class="product-link">
        <div class="product">
          <img
            src="<?php echo htmlspecialchars($product['image_url']); ?>"
            alt="<?php echo htmlspecialchars($product['description']); ?>">
          <h3><?php echo htmlspecialchars($product['description']); ?></h3>
          <p class="price"><?php echo number_format($product['price'], 0, ',', '.'); ?>₫</p>
          <p class="discount"><?php echo number_format($product['price'] * 1.2, 0, ',', '.'); ?>₫</p>
          <div class="button-container">
            <form action="index.php" method="GET" style="display: inline;">
              <input type="hidden" name="act" value="checkout">
              <input type="hidden" name="laptop_id" value="<?php echo $product['laptop_id']; ?>">
              <button type="submit" class="btn" name="buy">Mua ngay</button>
            </form>

            <form action="" method="POST" style="display: inline;">
              <input type="hidden" name="laptop_id" value="<?php echo $product['laptop_id']; ?>">
              <button type="submit" class="btn" name="add_to_cart">Giỏ hàng</button>
            </form>

          </div>
        </div>
      </a>
    <?php
    }
    ?>
  </div>
  <div class="watch-more-box">
    <button class="btn watch-more" onclick="location.href='index.php?act=products'">Xem thêm</button>
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