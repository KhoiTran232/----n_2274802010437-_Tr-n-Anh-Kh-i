<?php
include "include/Shop.inc.php";

$db = new DB();

if (empty($_GET["id"])) {
    header("Location: /products.php");
    die();
}

$sqlString = "SELECT * FROM products WHERE id=" . $db->mysql->real_escape_string($_GET["id"]);
$sqlQuery = $db->mysql->query($sqlString);

if ($sqlQuery->num_rows <= 0) {
    header("Location: /products.php");
    die();
}
$product = $sqlQuery->fetch_assoc();
?>
<!DOCTYPE html>
<html>

<head>
    <title>ShoesShop</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- script
    ================================================== -->
    <script src="/js/modernizr.js"></script>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
    <?php include "components/header.php"; ?>
    <section class="" style="padding-top: 7rem; margin-bottom: 7rem; margin-left: 7rem; margin-right: 7rem;">
        <h1>Thông tin sản phẩm</h1>
        <div class="mt-3" style="position: relative">
            <img src="<?php echo $product["image"] ?>" width="500px" style="border-radius: 5px;">
            <div style="position: absolute; left: 35vw; top: 0">
                <h4><?php echo $product["brand"] ?><sup>&reg;</sup></h4>
                <h2><?php echo $product["name"] ?></h2>
                <div class="mt-4">
                    <h3><?php echo number_format($product["price"]) ?> VND</h3>
                    <h4 class="mt-4">Giới thiệu sản phẩm</h4>
                    <p style="color: black;"><?php echo $product["description"] ?></p>
                </div>
                <div class="mt-4">
                    <?php
                    if (!empty($_SESSION["user"])) {
                        if ($product["out_of_stock"] == 1) {
                    ?>
                            <button class="btn btn-primary mt-2" type="submit">HẾT HÀNG</button>
                        <?php
                        } else {
                        ?>
                            <form id="atc">
                                <input type="number" placeholder="Số lượng" class="form-control" min="1" max="99" id="cart-quanity">
                                <button class="btn btn-primary mt-2" type="submit">THÊM VÀO GIỎ HÀNG</button>
                            </form>
                        <?php
                        }
                    } else {
                        ?>
                        <button class="btn btn-primary mt-2" disabled>ĐĂNG NHẬP ĐỂ THÊM VÀO GIỎ HÀNG</button>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php include "components/footer.html" ?>
    <script type="text/javascript" src="/js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/js/plugins.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#atc").on("submit", (e) => {
            e.preventDefault();
            if ($("#cart-quanity").val() <= 0 || $("#cart-quanity").val() >= 100) return alert("Số lượng hàng thêm vào phải là số dương và nhỏ hơn 100!");
            $.ajax({
                url: "/api/cart/add.php",
                method: "post",
                dataType: "json",
                data: {
                    id: <?php echo $_GET["id"] ?>,
                    quanity: $("#cart-quanity").val(),
                },
                success: function(data) {
                    if (data.code == 200) {
                        Swal.fire({
                            title: "Thao tác thành công!",
                            text: "Đã thêm vào giỏ hàng!",
                            icon: "success"
                        });
                    }
                    if (data.code == 201) {
                        Swal.fire({
                            title: "Thao tác thất bại!",
                            text: "Đã có sản phẩm này trong giỏ hàng.",
                            icon: "error"
                        });
                    }
                }
            })
        })
    </script>
</body>

</html>