<?php
require_once "./Model/lop.php";
$lop_model = new lop();

require_once "./Model/page.php";
$trang = new page();
$limit = 4;
$count =$lop_model->getLop()->rowCount();
$pages = $trang->findPage($count, $limit);
$start = $trang->findStart($limit);
$showPagination = true;
$lop_list=$lop_model->getLopPage($start,$limit);
$lop_count=$lop_model->countLop();
require_once "./Model/nganh.php";
$nganh_model = new nganh();
$nganh_list = $nganh_model->getNganh();

require_once "./Model/nienkhoa.php";
$nienkhoa_model = new nienkhoa();
$nienkhoa_list = $nienkhoa_model->getNienKhoa();

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Lớp</title>
    <link rel="stylesheet" href="View/assets/css/lop/Lop.css">

</head>

<body>
    <br>
    <div class="nav">
        <p><a href="index.php?action=home"><i class="fa-solid fa-house"></i></a> >
            <a href="index.php?action=lop">Danh sách lớp</a> >
            <a href="index.php?action=lop&act=insert_lop" class="btn-add"><i class="fa-solid fa-plus"></i> Thêm mới</a>
        </p>
    </div>
    <!-- them -->
    <?php if (isset($_SESSION['add_alert']) && $_SESSION['add_alert'] === true) {
        ?>
    <div class="alert alert-success alert-dismissible w-75" style="margin-left:180px" role="alert">
        <b>Thêm lớp thành công !</b>
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
        <b>Sửa thông tin lớp thành công !</b>
        <button type="button" class="btn-close pt-3" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
        unset($_SESSION['edit_alert']);
        }
    ?>
    <div class="form-group">
        <form method="POST" action="">
            <select name="filter_nganh" id="filter_nganh">
                <option value="" disabled selected>--Chọn ngành--</option>
                <?php foreach ($nganh_list as $nganh): ?>
                <option value="<?php echo $nganh['idnganh']; ?>"><?php echo $nganh['tennganh']; ?></option>
                <?php endforeach; ?>
            </select>
            <select name="filter_nienkhoa" id="filter_nienkhoa">
                <option value="" disabled selected>--Chọn niên khóa--</option>
                <?php foreach ($nienkhoa_list as $nienkhoa): ?>
                <option value="<?php echo $nienkhoa['idnk']; ?>"><?php echo $nienkhoa['nienkhoa']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit"><i class="fa-solid fa-rotate-right"></i></button>
        </form>
    </div>
    <?php if ($lop_count==0) { ?>
    <p class="text-center text-danger">Không tìm thấy lớp</p>
    <?php } else { ?>
    <table id="table">
        <tr>
            <th>Tên lớp</th>
            <th>Mã lớp</th>
            <th>Ngành</th>
            <th>Thông tin</th>
            <th></th>
        </tr>
        <?php foreach ($lop_list as $lop): ?>

        <tr>
            <td>
                <div data-id="<?php echo $lop['idlop']; ?>" id="id"><?php echo $lop['tenlop']; ?></div>
            </td>
            <td>
                <?php echo $lop['malop']; ?>
            </td>
            <td>
                <?php echo $lop['tennganh']; ?>
            </td>
            <td>
                <ul>
                    <li>Sĩ số: <?php
                        $totalSV = $lop_model->countSVinLop($lop['idlop']);
                        echo $totalSV ?></li>
                    <li>Hệ Đào Tạo: <?php echo $lop['tenhdt'] ?></li>
                    <li>Niên khóa: <?php echo $lop['nienkhoa']; ?></li>
                </ul>

            </td>
            <td>
                <a href="index.php?action=lop&act=update_lop&id=<?php echo $lop['idlop']; ?>" class="btn btn-info">
                    <i class="fa-solid fa-pen-to-square"></i></a>
                <a class="btn btn-danger" id="del-btn">
                    <i class="fa-solid fa-trash"></i>
                </a>
                <a href="index.php?action=lop&act=svlop&id=<?php echo $lop['idlop']; ?>" class="btn btn-success"><i
                        class="fa-solid fa-circle-info"></i></a>
            </td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="5" style="border:none; text-align:center">
                <?php if ($showPagination): ?>
                <div class="">
                    <ul class="pagination">
                        <?php
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            if ($current_page > 1 && $pages > 1) {
                echo '<li><a href="index.php?action=lop&page' . ($current_page - 1) . '"><<</a></li>';
            }
            for ($i = 1; $i <= $pages; $i++) {
                ?>
                        <li <?php if ($i == $current_page) echo 'class="active" '?>>
                            <a href="index.php?action=lop&page=<?php echo $i; ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                        <?php
            }
            if ($current_page < $pages && $pages > 1) {
                echo '<li><a href="index.php?action=lop&page=' . ($current_page + 1) . '">>></a></li>';
            }
            ?>
                    </ul>
                </div>
                <?php endif; ?>
            </td>
        </tr>
    </table>
    <?php }?>
</body>
<script>
$(document).ready(function() {
    $('#filter_nganh, #filter_nienkhoa').change(function() {
        var nganh_id = $('#filter_nganh').val();
        var nienkhoa_id = $('#filter_nienkhoa').val();

        $.ajax({
            url: 'View/ajax-url/filter_lop.php',
            type: 'POST',
            data: {
                filter_nganh: nganh_id,
                filter_nienkhoa: nienkhoa_id
            },
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
            title: "Xoá lớp này?",
            text: "Sau khi xoá lớp sẽ mất vĩnh viễn !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "Controller/lop.php?act=delete_lop",
                    method: "POST",
                    data: {
                        delete_id: delete_id
                    },
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res);
                        if (res.status === 'success') {
                            Swal.fire({
                                title: "Xoá lớp thành công!",
                                text: res.message,
                                icon: "success",
                                timer: 900,
                                timerProgressBar: true
                            }).then(() => {
                                window.location.reload();
                            })
                        } else {
                            Swal.fire({
                                title: "Xoá lớp thất bại!",
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