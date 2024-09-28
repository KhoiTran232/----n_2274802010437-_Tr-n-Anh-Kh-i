<?php
include "../include/Shop.inc.php";

$db = new DB();

if (empty($_GET["id"])) {
    header("Location: /admin/products.php");
    die();
}

$sqlString = "SELECT * FROM products WHERE id=" . $db->mysql->real_escape_string($_GET["id"]);
$sqlQuery = $db->mysql->query($sqlString);

if ($sqlQuery->num_rows <= 0) {
    header("Location: /admin/products.php");
    die();
}
$product = $sqlQuery->fetch_assoc();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ShoesShop - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body data-bs-theme="dark">
    <?php include "components/header.html" ?>
    <div style="margin-left: 2rem; margin-top: 2rem; margin-right: 2rem;">
        <h2>Chỉnh sửa SP: <?php echo $product["name"] ?> (ID: <?php echo $product["id"] ?>)</h2>
        <form id="edit-form">
            <div class="mb-3">
                <label class="form-label">Tên</label>
                <input type="text" class="form-control" id="name" placeholder="Tên" value="<?php echo $product["name"] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Nhãn hiệu</label>
                <input type="text" class="form-control" id="brand" placeholder="Nhãn hiệu" value="<?php echo $product["brand"] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <input type="text" class="form-control" id="desc" placeholder="Mô tả" value="<?php echo $product["description"] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Giá (VND)</label>
                <input type="text" class="form-control" id="price" placeholder="Giá" value="<?php echo $product["price"] ?>">
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="oos" <?php if ($product["out_of_stock"] == 1) echo "checked"; ?>>
                    <label class="form-check-label" for="flexCheckChecked">
                        Hết hàng?
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Link ảnh</label>
                <input type="text" class="form-control" id="image" placeholder="Link ảnh" value="<?php echo $product["image"] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Ảnh hiện tại</label><br>
                <img width="300px" src="<?php echo $product["image"] ?>">
            </div>
            <button class="btn btn-primary mb-3" type="submit">Lưu lại</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#edit-form").on("submit", (e) => {
            e.preventDefault();
            $.ajax({
                url: "/api/admin/products/edit.php",
                method: "post",
                dataType: "json",
                data: {
                    id: <?php echo $_GET["id"] ?>,
                    name: $("#name").val(),
                    brand: $("#brand").val(),
                    description: $("#desc").val(),
                    price: $("#price").val(),
                    image: $("#image").val(),
                    outOfStock: $("#oos").is(":checked"),
                },
                success: function(data) {
                    if (data.code == 200) {
                        Swal.fire({
                            title: "Thao tác thành công!",
                            text: "Đã chỉnh sửa sản phẩm! Đang chuyển hướng về toàn bộ sản phẩm...",
                            icon: "success"
                        });
                        setTimeout(() => window.location = "/admin/products.php", 1000);
                    }
                }
            })
        })
    </script>
</body>

</html>