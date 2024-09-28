<?php
include "../include/Shop.inc.php";
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
        <h2>Sản phẩm</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Tạo SP mới</button>
        <div id="tbl"></div>
    </div>
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tạo SP mới</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="new-prd">
                        <div class="mb-3">
                            <label class="form-label">Tên SP</label>
                            <input type="text" class="form-control" id="prd-name" placeholder="Tên SP">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nhãn hiệu</label>
                            <input type="text" class="form-control" id="prd-brand" placeholder="Nhãn hiệu">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <input type="text" class="form-control" id="prd-desc" placeholder="Mô tả">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giá</label>
                            <input type="text" class="form-control" id="prd-price" placeholder="Giá">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Link ảnh</label>
                            <input type="text" class="form-control" id="prd-img" placeholder="Link ảnh">
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="prd-oos">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Hết hàng?
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Tạo mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#tbl").load("/admin/components/products.php");

        $("#new-prd").on("submit", (e) => {
            e.preventDefault();
            $.ajax({
                url: "/api/admin/products/add.php",
                method: "post",
                dataType: "json",
                data: {
                    name: $("#prd-name").val(),
                    brand: $("#prd-brand").val(),
                    description: $("#prd-desc").val(),
                    price: $("#prd-price").val(),
                    image: $("#prd-img").val(),
                    outOfStock: $("#prd-oos").is(":checked"),
                },
                success: function(data) {
                    if (data.code == 200) {
                        Swal.fire({
                            title: "Thao tác thành công!",
                            text: "Đã thêm sản phẩm mới!",
                            icon: "success"
                        });

                        $("#tbl").load("/admin/components/products.php");
                    }
                }
            })
        })
    </script>
</body>

</html>