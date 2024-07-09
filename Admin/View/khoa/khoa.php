<?php
require_once "./Model/khoa.php";
$khoa_model = new khoa();
$khoa_list = $khoa_model->getKhoa();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách khoa</title>
    <link rel="stylesheet" href="View/assets/css/khoa/khoa.css">
</head>

<body>
    <br>
    <div class="nav">
        <p><a href="index.php?action=home"><i class="fa-solid fa-house"></i></a> >
            <a href="index.php?action=khoa">Danh sách khoa</a> >
            <a href="index.php?action=khoa&act=insert_khoa" class="btn-add"><i class="fa-solid fa-plus"></i>
                Thêm mới</a>
        </p>
    </div>
    <!-- them -->
    <?php if (isset($_SESSION['add_alert']) && $_SESSION['add_alert'] === true) {
        ?>
    <div class="alert alert-success alert-dismissible w-75" style="margin-left:180px" role="alert">
        <b>Thêm khoa thành công !</b>
        <button type="button" class="btn-close pt-3" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
        unset($_SESSION['add_alert']);
        }
            ?>
    <!-- sua -->
    <?php if (isset($_SESSION['edit_alert']) && $_SESSION['edit_alert'] === true) {
        ?>
    <div class="alert alert-primary alert-dismissible w-75" style="margin-left:180px" role="alert">
        <b>Sửa thông tin khoa thành công !</b>
        <button type="button" class="btn-close pt-3" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
        unset($_SESSION['edit_alert']);
        }
    ?>
    <table>
        <tr>
            <th>Tên khoa</th>
            <th>Mã khoa</th>
            <th>Ngày Lập</th>
            <th>Mô tả</th>
            <th></th>
        </tr>
        <?php foreach ($khoa_list as $khoa): ?>
        <tr>
            <td>
                <div data-id="<?php echo $khoa['idkhoa']; ?>" id="id"><?php echo $khoa['tenkhoa']; ?></div>
            </td>
            <td>
                <?php echo $khoa['makhoa']; ?>
            </td>
            <td>
                <?php echo $khoa['ngaylap']; ?>
            </td>
            <td>
                <?php echo $khoa['mota']; ?>
            </td>

            <td>
                <a href="index.php?action=khoa&act=update_khoa&id=<?php echo $khoa['idkhoa']; ?>"
                    class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                <a class="btn btn-danger" id="del-btn">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
<script>
$(document).ready(function() {
    $(document).on('click', "#del-btn", function() {
        let delete_id = $(this).closest('tr').find('#id').data("id");
        Swal.fire({
            title: "Xoá khoa này?",
            text: "Sau khi xoá khoa sẽ mất vĩnh viễn !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "Controller/khoa.php?act=delete_khoa",
                    method: "POST",
                    data: {
                        delete_id: delete_id
                    },
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res);
                        if (res.status === 'success') {
                            Swal.fire({
                                title: "Xoá khoa thành công!",
                                text: res.message,
                                icon: "success",
                                timer: 900,
                                timerProgressBar: true
                            }).then(() => {
                                window.location.reload();
                            })
                        } else {
                            Swal.fire({
                                title: "Xoá khoa thất bại!",
                                text: res.message,
                                icon: "error",
                                timer: 3200,
                                timerProgressBar: true
                            });
                        }
                    },
                    error: function(error) {
                        console.log("Error: ", error);
                        Swal.fire({
                            title: "Lỗi!",
                            text: "Có lỗi xảy ra!",
                            icon: "error",
                            timer: 3200,
                            timerProgressBar: true
                        });
                    }
                })
            }
        });
    })
})
</script>

</html>