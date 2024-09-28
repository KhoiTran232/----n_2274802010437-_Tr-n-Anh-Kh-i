<?php
include "../../include/Shop.inc.php";
$db = new DB();

$sqlString = "SELECT * FROM users";
$sqlQuery = $db->mysql->query($sqlString);
$sqlResult = $sqlQuery->fetch_all(MYSQLI_ASSOC);
?>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Email</th>
            <th scope="col">Admin?</th>
            <th scope="col">Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($sqlResult as $user) {
        ?>
            <tr>
                <th scope="row"><?php echo $user["id"]; ?></th>
                <td><?php echo $user["email"]; ?></td>
                <td><?php if ($user["is_admin"]) echo "Có";
                    else echo "Không"; ?></td>
                <td><?php if ($user["id"] == $_SESSION["user"]["id"]) { ?> <p>Không thể thay đổi tài khoản hiện hành.</p> <?php } else { ?><button class="btn btn-info btn-sm reset-password" data-id="<?php echo $user["id"]; ?>">Đổi mật khẩu</button> <?php if (!$user["is_admin"]) { ?> <button class="btn btn-primary btn-sm admin-edit" data-id="<?php echo $user["id"]; ?>">Chỉ định Admin</button> <?php } else { ?> <button class="btn btn-primary btn-sm admin-edit" data-id="<?php echo $user["id"]; ?>">Xóa quyền Admin</button> <?php } ?> <button class="btn btn-danger btn-sm delete-user" data-id="<?php echo $user["id"]; ?>">Xóa người dùng</button> <?php } ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<script type="text/javascript" src="/js/jquery-1.11.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(".reset-password").click(function() {
        $.ajax({
            url: "/api/admin/users/reset-password.php",
            dataType: "json",
            method: "post",
            data: {
                id: $(this).data("id")
            },
            success: function(data) {
                if (data.code == 200) {
                    Swal.fire({
                        title: "Thao tác thành công!",
                        text: "Mật khẩu mới của người dùng là: " + data.newPwd,
                        icon: "success"
                    });
                }
                if (data.code == 103) {
                    Swal.fire({
                        title: "Thao tác thất bại!",
                        text: "Bạn không thể thay đổi mật khẩu tài khoản hiện hành!",
                        icon: "error"
                    });
                }
            }
        })
    })

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

    $(".delete-user").click(function() {
        $.ajax({
            url: "/api/admin/users/delete-user.php",
            dataType: "json",
            method: "post",
            data: {
                id: $(this).data("id")
            },
            success: function(data) {
                if (data.code == 200) {
                    Swal.fire({
                        title: "Thao tác thành công!",
                        text: "Đã xóa người dùng!",
                        icon: "success"
                    });

                    setTimeout(() => window.location.reload(), 1000);
                }
                if (data.code == 103) {
                    Swal.fire({
                        title: "Thao tác thất bại!",
                        text: "Bạn không thể thay đổi mật khẩu tài khoản hiện hành!",
                        icon: "error"
                    });
                }
            }
        })
    })
</script>