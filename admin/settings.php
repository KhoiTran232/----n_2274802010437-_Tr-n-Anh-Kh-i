<?php
include "../include/Shop.inc.php";

$db = new DB();

$sqlString = "SELECT * FROM homedata";
$sqlQuery = $db->mysql->query($sqlString);
$sqlResult = $sqlQuery->fetch_all(MYSQLI_ASSOC);
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
    <div style="margin: 2rem 2rem 2rem 2rem;">
        <h2>Cài đặt</h2>
        <h3>Sản phẩm đề xuất</h3>
        <p><b>LƯU Ý:</b> Đầu vào "Tiêu đề" và "Tiêu đề nút bấm" hỗ trợ cú pháp HTML.</p>
        <div>
            <h4>Đầu trang</h4>
            <form id="1">
                <div class="mb-3">
                    <label class="form-label">Tiêu đề</label>
                    <input type="text" class="form-control" placeholder="Tiêu đề" id="1-title" value="<?php echo $sqlResult[0]["title"] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Link ảnh</label>
                    <input type="text" class="form-control" placeholder="Link ảnh" id="1-image" value="<?php echo $sqlResult[0]["image"] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tiêu đề nút bấm</label>
                    <input type="text" class="form-control" placeholder="Tiêu đề nút bấm" id="1-btn-title" value="<?php echo $sqlResult[0]["btn_title"] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Đường dẫn nút bấm</label>
                    <input type="text" class="form-control" placeholder="Tiêu đề nút bấm" id="1-btn-link" value="<?php echo $sqlResult[0]["btn_link"] ?>">
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Lưu lại</button>
                </div>
            </form>
        </div>
        <div id="2">
            <h4>Cuối trang</h4>
            <form>
                <div class="mb-3">
                    <label class="form-label">Tiêu đề</label>
                    <input type="text" class="form-control" placeholder="Tiêu đề" id="2-title" value="<?php echo $sqlResult[1]["title"] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Link ảnh</label>
                    <input type="text" class="form-control" placeholder="Link ảnh" id="2-image" value="<?php echo $sqlResult[1]["image"] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tiêu đề nút bấm</label>
                    <input type="text" class="form-control" placeholder="Tiêu đề nút bấm" id="2-btn-title" value="<?php echo $sqlResult[1]["btn_title"] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Đường dẫn nút bấm</label>
                    <input type="text" class="form-control" placeholder="Tiêu đề nút bấm" id="2-btn-link" value="<?php echo $sqlResult[1]["btn_link"] ?>">
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Lưu lại</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#1").on("submit", (e) => {
            e.preventDefault();

            $.ajax({
                url: "/api/admin/settings/edit.php",
                method: "post",
                dataType: "json",
                data: {
                    id: 1,
                    title: $("#1-title").val(),
                    image: $("#1-image").val(),
                    btnTitle: $("#1-btn-title").val(),
                    btnLink: $("#1-btn-link").val(),
                },
                success: function() {
                    Swal.fire({
                        title: "Chỉnh sửa thành công!",
                        text: "Đã lưu lại thay đổi. Nếu không thấy có thay đổi, vui lòng tải lại trang.",
                        icon: "success"
                    });
                }
            })
        });

        $("#2").on("submit", (e) => {
            e.preventDefault();

            $.ajax({
                url: "/api/admin/settings/edit.php",
                method: "post",
                dataType: "json",
                data: {
                    id: 2,
                    title: $("#2-title").val(),
                    image: $("#2-image").val(),
                    btnTitle: $("#2-btn-title").val(),
                    btnLink: $("#2-btn-link").val(),
                },
                success: function() {
                    Swal.fire({
                        title: "Chỉnh sửa thành công!",
                        text: "Đã lưu lại thay đổi. Nếu không thấy có thay đổi, vui lòng tải lại trang.",
                        icon: "success"
                    });
                }
            })
        });
    </script>
</body>

</html>