<?php
include "../../include/Shop.inc.php";

if (!Utils::isLoggedIn()) {
    header("Location: /");
    die();
}
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
        <h1>Tài khoản</h1>
        <h3>Đổi mật khẩu</h3>
        <form id="cpwd-form">
            <div class="mb-3">
                <label class="form-label">Mật khẩu cũ</label>
                <input type="password" class="form-control" id="old-pwd" placeholder="Nhập mật khẩu cũ">
            </div>
            <div class="mb-3">
                <label class="form-label">Mật khẩu mới</label>
                <input type="password" class="form-control" id="new-pwd" placeholder="Nhập mật khẩu mới">
            </div>
            <div class="mb-3">
                <label class="form-label">Xác thực mật khẩu mới</label>
                <input type="password" class="form-control" id="verify-pwd" placeholder="Nhập lại mật khẩu mới">
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Lưu lại</button>
            </div>
        </form>
    </section>
    <?php include "../../components/footer.html" ?>
    <script type="text/javascript" src="/js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/js/plugins.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#cpwd-form").on("submit", (e) => {
            e.preventDefault();
            if (!$("#old-pwd").val() || !$("#new-pwd").val() || !$("#verify-pwd").val()) return alert("Vui lòng điền đầy đủ thông tin!");
            if ($("#new-pwd").val() !== $("#verify-pwd").val()) return alert("Mật khẩu không trùng khớp!");
            $.ajax({
                url: "/api/account/change-pwd.php",
                dataType: "json",
                method: "post",
                data: {
                    oldPwd: $("#old-pwd").val(),
                    newPwd: $("#new-pwd").val(),
                    verifyPwd: $("#verify-pwd").val(),
                },
                success: function(data) {
                    if (data.code == 200) {
                        Swal.fire({
                            title: "Đổi mật khẩu thành công!",
                            text: "Đã đổi mật khẩu.",
                            icon: "success"
                        });
                    }
                    if (data.code == 401) {
                        Swal.fire({
                            title: "Đổi mật khẩu thất bại!",
                            text: "Mật khẩu cũ không trùng khớp!",
                            icon: "error"
                        });
                    }
                }
            })
        });
    </script>
</body>

</html>