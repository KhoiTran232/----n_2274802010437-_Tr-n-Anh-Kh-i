<?php
include "../../include/Shop.inc.php";

$db = new DB();

if (!Utils::isLoggedIn()) {
    header("Location: /");
    die();
}

$sqlString = "SELECT * FROM cart WHERE user_id=" . $_SESSION["user"]["id"] . " ORDER BY added_at DESC;";
$sqlQuery = $db->mysql->query($sqlString);
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
    <?php include "../../components/header.php"; ?>
    <section class="" style="padding-top: 7rem; margin-bottom: 7rem; margin-left: 7rem; margin-right: 7rem;">
        <h1>Giỏ hàng</h1>
        <?php
        if ($sqlQuery->num_rows <= 0) {
            echo "<p>Bạn chưa có sản phẩm nào trong giỏ hàng!</p>";
        } else {
            $products = $sqlQuery->fetch_all(MYSQLI_ASSOC);
            foreach ($products as $cartData) {
                $sqlString = "SELECT * FROM products WHERE id=" . $cartData["product_id"];
                $sqlQuery = $db->mysql->query($sqlString);
                $product = $sqlQuery->fetch_assoc();
                ?>
                <div style="border-top: 1px solid black; border-bottom: 1px solid black; padding: 5px; display: flex;">
                    <img src="<?php echo $product["image"] ?>" height="128px">
                    <div style="display: block;" class="ms-3">
                        <h5><?php echo $product["name"] ?></h5>
                        <h5><?php echo number_format($product["price"]) ?> VND</h5>
                        Số lượng: <input type="number" min="1" max="99" value="<?php echo $cartData["quanity"] ?>" data-id="<?php echo $cartData["product_id"] ?>" class="quanity"><br>
                        <button class="btn btn-danger remove-item" data-id="<?php echo $cartData["product_id"] ?>">Xóa</button>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        <button class="btn btn-primary mt-3" onclick="alert('Cảm ơn bạn đã mua hàng!')">Thanh toán</button>
    </section>
    <?php include "../../components/footer.html" ?>
    <script type="text/javascript" src="/js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/js/plugins.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(".quanity").on("change", function () {
            $.ajax({
                url: "/api/cart/edit.php",
                dataType: "json",
                method: "post",
                data: {
                    id: $(this).data("id"),
                    quanity: $(this).val(),
                }
            })
        });

        $(".remove-item").click(function () {
            $.ajax({
                url: "/api/cart/delete.php",
                dataType: "json",
                method: "post",
                data: {
                    id: $(this).data("id"),
                },
                success: function(data) {
                    if (data.code == 200) {
                        Swal.fire({
                            title: "Thao tác thành công!",
                            text: "Đã loại bỏ sản phẩm này.",
                            icon: "success"
                        });

                        setTimeout(() => window.location.reload(), 1000);
                    }
                }
            })
        });
    </script>
</body>

</html>