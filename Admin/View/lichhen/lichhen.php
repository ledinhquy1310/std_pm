<?php
require_once "./Model/lichhen.php";
$lichhen_model = new lichhen();
$lichhen_not_send_list = $lichhen_model->getlichhen();
$lichhen_sended_list = $lichhen_model->getlichhen_sended();

$lichhen_count = $lichhen_model->getlichhen()->rowCount();
$lichhen_sended_count = $lichhen_model->getlichhen_sended()->rowCount();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách lịch hẹn</title>
    <link rel="stylesheet" href="View/assets/css/lichhen/lichhen.css">

</head>

<body>
    <br>
    <div class="nav">
        <p><a href="index.php?action=home"><i class="fa-solid fa-house"></i></a> >
            <a href="index.php?action=lichhen">Danh sách lịch hẹn</a> >
            <a href="index.php?action=lichhen&act=insert_lichhen" class="btn-add"><i class="fa-solid fa-plus"></i>
                Thêm mới</a>
        </p>
    </div>
    <!-- them -->
    <?php if (isset($_SESSION['add_alert']) && $_SESSION['add_alert'] === true) {
        ?>
    <div class="alert alert-success alert-dismissible w-75" style="margin-left:180px" role="alert">
        <b>Thêm lịch hẹn thành công !</b>
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
        <b>Sửa thông tin lịch hẹn thành công !</b>
        <button type="button" class="btn-close pt-3" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
        unset($_SESSION['edit_alert']);
        }
    ?>
    <h5>Lịch hẹn chưa gửi</h5>
    <?php if($lichhen_count>0){?>
    <table>
        <tr>
            <th>Sinh viên</th>
            <th>Giảng viên</th>
            <th>Ngày Hẹn</th>
            <th>Ghi chú</th>
            <th></th>
        </tr>
        <?php foreach ($lichhen_not_send_list as $lichhen): ?>
        <tr>
            <td>
                <div data-id="<?php echo $lichhen['idlh']; ?>" id="id"><?php echo $lichhen['tensv']; ?></div>
            </td>
            <td>
                <?php echo $lichhen['tengv']; ?>
            </td>
            <td>
                <?php echo $lichhen['ngayhen']; ?>
            </td>
            <td>
                <?php echo $lichhen['ghichu']; ?>
            </td>
            <td>
                <a href="index.php?action=lichhen&act=send&send_id=<?php echo $lichhen['idlh']; ?>"
                    class="btn btn-success"><i class="fa-solid fa-envelope"></i></a>
                <a href="index.php?action=lichhen&act=edit&edit_id=<?php echo $lichhen['idlh']; ?>"
                    class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                <a class="btn btn-danger" id="del-btn">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php }else{
        echo '<p class="text-center text-danger">Không có lịch hẹn nào !</p>';
    }
    
    if($lichhen_sended_count>0){
    ?>
    <br>
    <h5>Lịch hẹn đã gửi</h5>
    <table>
        <tr>
            <th>Sinh viên</th>
            <th>Giảng viên</th>
            <th>Ngày Hẹn</th>
            <th>Ghi chú</th>
            <th></th>
        </tr>
        <?php foreach ($lichhen_sended_list as $lichhen): ?>
        <tr>
            <td>
                <div data-id="<?php echo $lichhen['idlh']; ?>" id="id"><?php echo $lichhen['tensv']; ?></div>
            </td>
            <td>
                <?php echo $lichhen['tengv']; ?>
            </td>
            <td>
                <?php echo $lichhen['ngayhen']; ?>
            </td>
            <td>
                <?php echo $lichhen['ghichu']; ?>
            </td>
            <td>
                <a class="btn btn-danger" id="del-btn-sended">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php }else{
        echo '<p class="text-center text-danger">Không có lịch hẹn nào đã gửi!</p>';
    }?>
</body>
<script>
$(document).ready(function() {
    // not sended
    $(document).on('click', "#del-btn", function() {
        let delete_id = $(this).closest('tr').find('#id').data("id");
        Swal.fire({
            title: "Xoá lịch hẹn này?",
            text: "Sau khi xoá lịch hẹn sẽ mất vĩnh viễn !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "Controller/del_lichhen.php?act=delete_lichhen",
                    method: "POST",
                    data: {
                        delete_id: delete_id
                    },
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res);
                        if (res.status === 'success') {
                            Swal.fire({
                                title: "Xoá lịch hẹn thành công!",
                                text: res.message,
                                icon: "success",
                                timer: 900,
                                timerProgressBar: true
                            }).then(() => {
                                window.location.reload();
                            })
                        } else {
                            Swal.fire({
                                title: "Xoá lịch hẹn thất bại!",
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
    // sended
    $(document).on('click', "#del-btn-sended", function() {
        let delete_id = $(this).closest('tr').find('#id').data("id");
        Swal.fire({
            title: "Xoá lịch hẹn này?",
            text: "Sau khi xoá lịch hẹn sẽ mất vĩnh viễn !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "Controller/del_lichhen.php?act=delete_lichhen_sended",
                    method: "POST",
                    data: {
                        delete_id: delete_id
                    },
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res);
                        if (res.status === 'success') {
                            Swal.fire({
                                title: "Xoá lịch hẹn thành công!",
                                text: res.message,
                                icon: "success",
                                timer: 900,
                                timerProgressBar: true
                            }).then(() => {
                                window.location.reload();
                            })
                        } else {
                            Swal.fire({
                                title: "Xoá lịch hẹn thất bại!",
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
<?php
        if (isset($_SESSION['send']) && $_SESSION['send'] === true) {
            unset($_SESSION['send']);
            echo '
            Swal.fire({
                title: "Gửi lịch hẹn thành công!",
                text: "Đã gửi lịch hẹn về gmail của sinh viên và giảng viên!",
                icon: "success",
                timer: 3200,
                timerProgressBar: true
            });
            ';
        }
        ?>
</script>

</html>