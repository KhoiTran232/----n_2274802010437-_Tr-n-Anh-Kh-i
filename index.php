<?php
include "include/Shop.inc.php";

$db = new DB();

$sqlString = "SELECT * FROM homedata";
$sqlQuery = $db->mysql->query($sqlString);
$sqlResult = $sqlQuery->fetch_all(MYSQLI_ASSOC);

$sqlString = "SELECT * FROM products ORDER BY created_at DESC LIMIT 15;";
$sqlQuery = $db->mysql->query($sqlString);
$recentProducts = $sqlQuery->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
  <title>ShoesShop</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
  <script src="js/modernizr.js"></script>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol xmlns="http://www.w3.org/2000/svg" id="quality" viewBox="0 0 16 16">
      <path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702 1.509.229z" />
      <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z" />
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" id="price-tag" viewBox="0 0 16 16">
      <path d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0z" />
      <path d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1zm0 5.586 7 7L13.586 9l-7-7H2v4.586z" />
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" id="shield-plus" viewBox="0 0 16 16">
      <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
      <path d="M8 4.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V9a.5.5 0 0 1-1 0V7.5H6a.5.5 0 0 1 0-1h1.5V5a.5.5 0 0 1 .5-.5z" />
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" id="nav-icon" viewBox="0 0 16 16">
      <path d="M14 10.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 .5-.5zm0-3a.5.5 0 0 0-.5-.5h-7a.5.5 0 0 0 0 1h7a.5.5 0 0 0 .5-.5zm0-3a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0 0 1h11a.5.5 0 0 0 .5-.5z" />
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" id="close" viewBox="0 0 16 16">
      <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" id="navbar-icon" viewBox="0 0 16 16">
      <path d="M14 10.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 .5-.5zm0-3a.5.5 0 0 0-.5-.5h-7a.5.5 0 0 0 0 1h7a.5.5 0 0 0 .5-.5zm0-3a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0 0 1h11a.5.5 0 0 0 .5-.5z" />
    </symbol>
  </svg>

  <header id="header" class="site-header header-scrolled position-fixed text-black bg-light">
    <nav id="header-nav" class="navbar navbar-expand-lg px-3">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">
          ShoesShop
        </a>
        <button class="navbar-toggler d-flex d-lg-none order-3 p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-expanded="false" aria-label="Toggle navigation">
          <svg class="navbar-icon">
            <use xlink:href="#navbar-icon"></use>
          </svg>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="bdNavbar" aria-labelledby="bdNavbarOffcanvasLabel">
          <div class="offcanvas-header px-4 pb-0">
            <a class="navbar-brand" href="/">
              ShoesShop
            </a>
            <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close" data-bs-target="#bdNavbar"></button>
          </div>
          <div class="offcanvas-body">
            <ul id="navbar" class="navbar-nav text-uppercase justify-content-end align-items-center flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link me-4 active" href="/">TRANG CHỦ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link me-4" href="/products.php">SẢN PHẨM</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link me-4 dropdown-toggle link-dark" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">TÀI KHOẢN</a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <?php
                  if (Utils::isLoggedIn()) {
                  ?>
                    <li>
                      <p class="dropdown-item" style="font-size: small;"><?php echo $_SESSION["email"] ?></p>
                    </li>
                    <li>
                      <a href="/pages/home/account.php" class="dropdown-item">Tài khoản</a>
                    </li>
                    <li>
                      <a href="/pages/home/cart.php" class="dropdown-item">Giỏ hàng</a>
                    </li>
                    <li>
                      <a href="#" class="dropdown-item" onclick="logout()">Đăng xuất</a>
                    </li>
                  <?php
                  }
                  ?>
                  <?php
                  if (!Utils::isLoggedIn()) {
                  ?>
                    <li>
                      <a href="/pages/auth/login.php" class="dropdown-item">Đăng nhập</a>
                    </li>
                    <li>
                      <a href="/pages/auth/register.php" class="dropdown-item">Đăng ký</a>
                    </li>
                  <?php
                  }
                  ?>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <section id="billboard" class="position-relative overflow-hidden bg-light-blue">
    <div class="swiper main-swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <div class="container">
            <div class="row d-flex align-items-center">
              <div class="col-md-6">
                <div class="banner-content">
                  <h1 class="display-2 text-uppercase text-dark pb-5"><?php echo $sqlResult[0]["title"]; ?></h1>
                  <a href="<?php echo $sqlResult[0]["btn_link"]; ?>" class="btn btn-medium btn-dark text-uppercase btn-rounded-none"><?php echo $sqlResult[0]["btn_title"]; ?></a>
                </div>
              </div>
              <div class="col-md-5">
                <div class="image-holder">
                  <img src="<?php echo $sqlResult[0]["image"]; ?>" alt="banner" width="600px">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="company-services" class="padding-large">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 pb-3">
          <div class="icon-box d-flex">
            <div class="icon-box-icon pe-3 pb-3">
              <svg class="cart-outline">
                <use xlink:href="#cart-outline" />
              </svg>
            </div>
            <div class="icon-box-content">
              <h3 class="card-title text-uppercase text-dark">Giao hàng toàn quốc</h3>
              <p>Mạng lưới giao hàng xuyên suốt 63 tỉnh thành, mang tới cho bạn sự tiện lợi.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 pb-3">
          <div class="icon-box d-flex">
            <div class="icon-box-icon pe-3 pb-3">
              <svg class="quality">
                <use xlink:href="#quality" />
              </svg>
            </div>
            <div class="icon-box-content">
              <h3 class="card-title text-uppercase text-dark">100% Chính hãng</h3>
              <p>Sản phẩm được phân phối đảm bảo 100% chính hãng với đầy đủ hóa đơn, chứng từ.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 pb-3">
          <div class="icon-box d-flex">
            <div class="icon-box-icon pe-3 pb-3">
              <svg class="price-tag">
                <use xlink:href="#price-tag" />
              </svg>
            </div>
            <div class="icon-box-content">
              <h3 class="card-title text-uppercase text-dark">Giá cả hợp lí</h3>
              <p>Giá cả trên ShoesShop luôn thuộc top giá mềm nhất trên thị trường nhưng vẫn đảm bảo chất lượng cao.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 pb-3">
          <div class="icon-box d-flex">
            <div class="icon-box-icon pe-3 pb-3">
              <svg class="shield-plus">
                <use xlink:href="#shield-plus" />
              </svg>
            </div>
            <div class="icon-box-content">
              <h3 class="card-title text-uppercase text-dark">Thanh toán đa dạng</h3>
              <p>Thanh toán bằng bất kì phương thức gì bạn muốn, từ thẻ, chuyển khoản, COD, ...</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="product-store position-relative padding-large no-padding-top">
    <div class="container">
      <div class="row">
        <div class="display-header d-flex justify-content-between pb-3">
          <h2 class="display-7 text-dark text-uppercase">Sản phẩm mới</h2>
          <div class="btn-right">
            <a href="products.php" class="btn btn-medium btn-normal text-uppercase">Toàn bộ sản phẩm</a>
          </div>
        </div>
        <div class="swiper product-swiper">
          <div class="swiper-wrapper">
            <?php
            foreach ($recentProducts as $product) {
            ?>
              <div class="swiper-slide">
                <div class="product-card position-relative">
                  <div class="image-holder">
                    <img src="<?php echo $product["image"] ?>" alt="product-item" class="img-fluid">
                  </div>
                  <div class="cart-concern position-absolute">
                    <div class="cart-button d-flex">
                      <a href="/product.php?id=<?php echo $product["id"] ?>" class="btn btn-medium btn-black">Chi tiết</a>
                    </div>
                  </div>
                  <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                    <h3 class="card-title text-uppercase">
                      <a href="/product.php?id=<?php echo $product["id"] ?>"><?php echo $product["name"] ?></a>
                    </h3>
                    <span class="item-price text-primary"><?php echo number_format($product["price"]) ?> VND</span>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="swiper-pagination position-absolute text-center"></div>
  </section>
  <section class="bg-light-blue overflow-hidden mt-5 padding-xlarge mb-5" style="background-image: url('<?php echo $sqlResult[1]["image"]; ?>');background-position: right; background-repeat: no-repeat;">
    <div class="row d-flex flex-wrap align-items-center">
      <div class="col-md-6 col-sm-12">
        <div class="text-content offset-4 padding-medium">
          <h2 class="display-2 pb-5 text-uppercase text-dark"><?php echo $sqlResult[1]["title"]; ?></h2>
          <a href="<?php echo $sqlResult[1]["btn_link"]; ?>" class="btn btn-medium btn-dark text-uppercase btn-rounded-none"><?php echo $sqlResult[1]["btn_title"]; ?></a>
        </div>
      </div>
    </div>
  </section>
  <footer id="footer" class="overflow-hidden">
    <div class="container">
      <div class="row">
        <div class="footer-top-area">
          <div class="row d-flex flex-wrap justify-content-between">
            <div class="col-lg-3 col-sm-6 pb-3">
              <div class="footer-menu">
                <h3>ShoeShop</h3>
                <p>Chuỗi cửa hàng kinh doanh giày 100% chính hãng với mức giá hợp lí. ShoesShop - Giày cho mọi nhà!</p>
              </div>
            </div>
            <div class="col-lg-8 col-sm-6 pb-3">
              <div class="footer-menu contact-item">
                <h5 class="widget-title text-uppercase pb-2">Liên hệ</h5>
                <p>Bạn có câu hỏi hoặc góp ý? Gửi email cho chúng tôi tại <a href="mailto:">webmaster@shoesshop.vn</a>
                </p>
                <p>Cần hỗ trợ ư? Đừng ngần ngại, hãy gọi điện cho chúng tôi: <a href="">+84 0123456789</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr>
  </footer>
  <div id="footer-bottom">
    <div class="container">
      <div class="row d-flex flex-wrap justify-content-between">
        <div class="col-md-4 col-sm-6">
          <div class="payment-method d-flex">
            <p>Chấp nhận thanh toán:</p>
            <div class="card-wrap ps-2">
              <img src="images/visa.jpg" alt="visa">
              <img src="images/mastercard.jpg" alt="mastercard">
              <img src="images/paypal.jpg" alt="paypal">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="js/jquery-1.11.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="js/plugins.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
</body>

</html>