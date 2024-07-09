<?php
require_once "./Model/hedaotao.php";
$hedaotao_model = new hedaotao();
$hedaotao_list = $hedaotao_model->getHeDaoTao();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách hedaotao</title>
    <link rel="stylesheet" href="View/assets/css/hedaotao/hedaotao.css">
</head>


<body>
    <br>
    <div class="nav">
        <p><a href="index.php?action=home"><i class="fa-solid fa-house"></i></a> >
            <a href="index.php?action=hedaotao"> Danh sách hệ đào tạo</a> >
            <a href="index.php?action=hedaotao&act=insert_hedaotao" class="btn-add"><i class="fa-solid fa-plus"></i>
                Thêm mới</a>
        </p>
    </div>
    <table>
        <tr>
            <th>Tên Hệ Đào Tạo</th>
            <th>Mã Hệ Đào Tạo</th>
            <th></th>
        </tr>
        <?php foreach ($hedaotao_list as $hedaotao): ?>
        <tr>
            <td>
                <div data-id="<?php echo $hedaotao['idhdt']; ?>" id="id"><?php echo $hedaotao['tenhdt']; ?></div>
            </td>
            <td>
                <?php echo $hedaotao['mahdt']; ?>
            </td>

            <td>
                <a href="index.php?action=hedaotao&act=update_hedaotao&id=<?php echo $hedaotao['idhdt']; ?>"
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
            title: "Xoá hệ đào tạo này?",
            text: "Sau khi xoá hệ đào tạo sẽ mất vĩnh viễn !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "Controller/hedaotao.php?act=delete_hedaotao",
                    method: "POST",
                    data: {
                        delete_id: delete_id
                    },
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res);
                        if (res.status === 'success') {
                            Swal.fire({
                                title: "Xoá hệ đào tạo thành công!",
                                text: res.message,
                                icon: "success",
                                timer: 900,
                                timerProgressBar: true
                            }).then(() => {
                                window.location.reload();
                            })
                        } else {
                            Swal.fire({
                                title: "Xoá hệ đào tạo thất bại!",
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