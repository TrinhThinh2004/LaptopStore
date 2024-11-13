<?php include("includes/add_to_cart.php"); ?>
<link rel="stylesheet" href="assets/css/base.css">
<link rel="stylesheet" href="assets/css/products.css">
<link rel="stylesheet" href="assets/css/filter.css">
<div class="main">
    <?php include("includes/filter.php"); ?>
    <div class="product-container">
        <?php
        if ($num_of_laptop == 0) { ?>
            <div class="sorry-box">
                <h2 class="sorry">Rất tiếc, hiện tại chúng tôi không có sản phẩm nào phù hợp với nhu cầu của bạn!</h2>
            </div>
        <?php }
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
                            <button type="submit" class="btnp" name="buy">Mua ngay</button>
                        </form>

                        <form action="" method="POST" style="display: inline;">
                            <input type="hidden" name="laptop_id" value="<?php echo $product['laptop_id']; ?>">
                            <button type="submit" class="btnp" name="add_to_cart">Giỏ hàng</button>
                        </form>

                    </div>
                </div>
            </a>
        <?php
        }
        ?>
    </div>
    <?php if ($total_page > 1) { ?>
        <div class="page-option">
            <p>Trang
                <?php
                for ($i = 1; $i <= $total_page; $i++) {
                    if ($page == $i)
                        echo "<span class='now'>$i</span>";
                    else { ?>
                        <a href="?act=products<?php echo $brand; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php
                    }
                }
                ?>
            </p>
        </div>
    <?php
    }
    ?>
</div>