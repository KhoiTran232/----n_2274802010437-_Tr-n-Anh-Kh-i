<?php
include "../../include/Shop.inc.php";
$db = new DB();

$sqlString = "SELECT * FROM products ORDER BY created_at DESC;";
$sqlQuery = $db->mysql->query($sqlString);
$sqlResult = $sqlQuery->fetch_all(MYSQLI_ASSOC);
?>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nhãn hiệu</th>
            <th scope="col">Tên</th>
            <th scope="col">Mô tả</th>
            <th scope="col">Giá</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Hết hàng?</th>
            <th scope="col">Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($sqlResult as $product) {
        ?>
            <tr>
                <th scope="row"><?php echo $product["id"]; ?></th>
                <td><?php echo $product["brand"]; ?></td>
                <td><?php echo $product["name"]; ?></td>
                <td><?php echo $product["description"]; ?></td>
                <td><?php echo number_format($product["price"]); ?> VND</td>
                <td><img src="<?php echo $product["image"]; ?>" width="40%"></td>
                <td><?php if ($product["out_of_stock"] == 1) echo "Có";
                    else echo "Không"; ?></td>
                <td><button class="btn btn-primary" onclick="window.location='/admin/product-edit.php?id=<?php echo $product["id"]; ?>'">Chỉnh sửa</button><button class="btn btn-danger mt-1 delete-product" data-id="<?php echo $product["id"] ?>">Xóa</button></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<script type="text/javascript" src="/js/jquery-1.11.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(".admin-edit").click(function() {
        $.ajax({
            url: "/api/admin/users/admin-edit.php",
            dataType: "json",
            method: "post",
            data: {
                id: $(this).data("id")
            },
            success: function(data) {
                if (data.code == 200) {
                    Swal.fire({
                        title: "Thao tác thành công!",
                        text: "Người dùng đã được cấp/bỏ quyền Admin! Vui lòng yêu cầu người dùng đăng nhập lại.",
                        icon: "success"
                    });

                    setTimeout(() => window.location.reload(), 1000);
                }
                if (data.code == 103) {
                    Swal.fire({
                        title: "Thao tác thất bại!",
                        text: "Bạn không thể thay đổi quyền hạn tài khoản hiện hành!",
                        icon: "error"
                    });
                }
            }
        })
    })

    $(".delete-product").click(function() {
        $.ajax({
            url: "/api/admin/products/delete.php",
            dataType: "json",
            method: "post",
            data: {
                id: $(this).data("id")
            },
            success: function(data) {
                if (data.code == 200) {
                    Swal.fire({
                        title: "Thao tác thành công!",
                        text: "Đã xóa sản phẩm!",
                        icon: "success"
                    });

                    setTimeout(() => window.location.reload(), 1000);
                }
            }
        })
    })
</script>