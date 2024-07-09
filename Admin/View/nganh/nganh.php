<?php
require_once "./Model/nganh.php";
$nganh_model = new nganh();
$nganh_list = $nganh_model->getnganh();
require_once "./Model/khoa.php";
$khoa_model = new khoa();
$khoa_list = $khoa_model->getkhoa();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách ngành</title>
    <link rel="stylesheet" href="View/assets/css/nganh/nganh.css">

</head>

<body>
    <br>
    <div class="nav">
        <p><a href="index.php?action=home"><i class="fa-solid fa-house"></i></a> > <a href="index.php?action=nganh">
                Danh sách ngành</a> >
            <a href="index.php?action=nganh&act=insert_nganh" class="btn-add"><i class="fa-solid fa-plus"></i>
                Thêm mới</a>
        </p>
    </div>
    <!-- them -->
    <?php if (isset($_SESSION['add_alert']) && $_SESSION['add_alert'] === true) {
        ?>
    <div class="alert alert-success alert-dismissible w-75" style="margin-left:180px" role="alert">
        <b>Thêm chuyên ngành thành công !</b>
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
        <b>Sửa chuyên ngành thành công !</b>
        <button type="button" class="btn-close pt-3" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
        unset($_SESSION['edit_alert']);
        }
    ?>
    <div class="form-group">
        <form method="POST" action="">
            <select name="filter_khoa" id="filter_khoa" style="height:40px">
                <option value="" disabled selected>--Chọn khoa--</option>
                <?php foreach ($khoa_list as $khoa): ?>
                <option value="<?php echo $khoa['idkhoa']; ?>"><?php echo $khoa['tenkhoa']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit"><i class="fa-solid fa-rotate-right"></i></button>
        </form>
    </div>
    <br>
    <div class="container">
        <table id="table">
            <tr>
                <th>Tên Chuyên Ngành</th>
                <th>Mã Ngành</th>
                <th>Khoa</th>
                <th></th>
            </tr>
            <?php foreach ($nganh_list as $nganh): ?>
            <tr>
                <td>
                    <div data-id="<?php echo $nganh['idnganh']; ?>" id="id"><?php echo $nganh['tennganh']; ?></div>
                </td>
                <td>
                    <?php echo $nganh['manganh']; ?>
                </td>
                <td>
                    <?php echo $nganh['tenkhoa']; ?>
                </td>
                <td>
                    <a href="index.php?action=nganh&act=update_nganh&id=<?php echo $nganh['idnganh']; ?>"
                        class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a class="btn btn-danger" id="del-btn">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
<script>
$(document).ready(function() {
    $('#filter_khoa').change(function() {
        var khoa_id = $(this).val();
        $.ajax({
            url: 'View/ajax-url/filter_nganh.php',
            type: 'POST',
            data: 'request=' + khoa_id,
            success: function(data) {
                $('#table').html(data);
            }
        });
    });
});

$(document).ready(function() {
    $(document).on('click', "#del-btn", function() {
        let delete_id = $(this).closest('tr').find('#id').data("id");
        Swal.fire({
            title: "Xoá chuyên ngành này?",
            text: "Sau khi xoá chuyên ngành sẽ mất vĩnh viễn !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "Controller/nganh.php?act=delete_nganh",
                    method: "POST",
                    data: {
                        delete_id: delete_id
                    },
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res);
                        if (res.status === 'success') {
                            Swal.fire({
                                title: "Xoá chuyên ngành thành công!",
                                text: res.message,
                                icon: "success",
                                timer: 900,
                                timerProgressBar: true
                            }).then(() => {
                                window.location.reload();
                            })
                        } else {
                            Swal.fire({
                                title: "Xoá chuyên ngành thất bại!",
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