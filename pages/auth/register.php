<?php
include "../../include/Shop.inc.php";

if (Utils::isLoggedIn()) {
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
    <script src="js/modernizr.js"></script>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
    <?php include "../../components/header.php"; ?>
    <section class="text-center" style="padding-top: 7rem; margin-bottom: 7rem;">
        <h2>Đăng ký</h2>

        <div class="container" style="text-align: left;">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form id="reg-form">
                        <div class="mb-3">
                            <label for="username" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="Nhập Email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" placeholder="Nhập mật khẩu">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" id="password-confirm" placeholder="Nhập lại mật khẩu">
                        </div>
                        <button type="submit" class="btn btn-primary">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php include "../../components/footer.html" ?>
    <script src="/js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/js/plugins.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#reg-form").on("submit", (e) => {
            e.preventDefault();
            if (!$("#email").val() || !$("#password").val()) return alert("Vui lòng điền đầy đủ thông tin!");
            if ($("#password").val() !== $("#password-confirm").val()) return alert("Mật khẩu không trùng khớp!");
            $.ajax({
                url: "/api/auth/register.php",
                method: "post",
                dataType: "json",
                data: {
                    email: $("#email").val(),
                    password: $("#password").val(),
                },
                success: function(data) {
                    if (data.code == 200) {
                        Swal.fire({
                            title: "Đăng ký thành công!",
                            text: "Đang chuyển bạn đến trang đăng nhập...",
                            icon: "success"
                        });
                        setTimeout(() => window.location = "/pages/auth/login.php", 1000);
                    }
                }
            });
        })
    </script>
</body>

</html>