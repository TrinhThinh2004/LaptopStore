  <link rel="stylesheet" href="assets/css/header.css">
  <link rel="stylesheet" href="assets/fonts/fontawesome-free-6.6.0-web/css/all.min.css">

  <?php
  include('includes/header.php'); 
  ?>

  <div class="main">
      <?php
        switch ($_GET['act'] ?? '') {
          
          case 'product_detail':
            include('product_detail.php');
            break;
          case 'user':
            include('user.php');
            break;
          case 'cart1':
            include('cart1.php');
            break;
          case 'cart':
            include('cart.php');
            break;
          case 'payment':
            include('payment.php');
            break;
          case 'checkout':
            include('checkout.php');
            break;
          case 'login':
            include('login.php');
            break;

          default: include('home.php');
        }
      ?>
  </div>