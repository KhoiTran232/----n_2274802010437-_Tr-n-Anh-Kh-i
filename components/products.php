<?php
include "../include/Shop.inc.php";

$pageId = Utils::generateRandomString();
$db = new DB();
$pageNum = 0;

if (!empty($_GET["page"])) $pageNum = intval($_GET["page"]);

$sqlString = "SELECT * FROM products ORDER BY created_at DESC LIMIT " . $pageNum * 10 . ", 10;";
$sqlQuery = $db->mysql->query($sqlString);
if ($sqlQuery->num_rows <= 0) {
    die("<p style='margin-top: 2rem;'>Không còn bất kì sản phầm nào!</p>");
}
$products = $sqlQuery->fetch_all(MYSQLI_ASSOC);
?>

<div class="container">
    <div class="row">
        <?php
        foreach ($products as $product) {
        ?>
            <div class="col-sm-4 mx-auto mt-2">
                <div class="card" style="width: 100%">
                    <img class="card-img-top" src="<?php echo $product["image"] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product["name"] ?></h5>
                        <p class="card-text">Nhãn hiệu: <?php echo $product["brand"] ?><br>Tình trạng: <?php if ($product["out_of_stock"]) { echo "Hết hàng"; } else { echo "Còn hàng"; } ?></p>
                        <a href="/product.php?id=<?php echo $product["id"] ?>" class="btn btn-primary">Chi tiết</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<div id="load-more-<?php echo $pageId ?>">
    <button class="btn btn-primary mt-2 load-more-btn">TẢI THÊM</button>
</div>

<script type="text/javascript" src="/js/jquery-1.11.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(".load-more-btn").click(() => {
        $("#load-more-<?php echo $pageId ?>").load("/components/products.php?page=<?php echo $pageNum + 1 ?>")
    });
</script>