<?php
require_once "./Model/nienkhoa.php";
$nienkhoa_model = new nienkhoa();
require_once "./Model/page.php";
$trang = new page();
$limit = 4;
$count =$nienkhoa_model->getnienkhoa()->rowCount();
$pages = $trang->findPage($count, $limit);
$start = $trang->findStart($limit);
$showPagination = true;
$nienkhoa_list=$nienkhoa_model->getnienkhoaPage($start,$limit);
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Lớp</title>
    <link rel="stylesheet" href="View/assets/css/nienkhoa/nienkhoa.css">

</head>

<body>
    <br>
    <div class="nav">
        <p><a href="index.php?action=home"><i class="fa-solid fa-house"></i></a> > <a href="index.php?action=nienkhoa">
                Danh sách niên khóa</a> >
            <a href="index.php?action=nienkhoa&act=insert_nienkhoa" class="btn-add"><i class="fa-solid fa-plus"></i>
                Thêm mới</a>
        </p>
    </div>
    <!-- them -->
    <?php if (isset($_SESSION['add_alert']) && $_SESSION['add_alert'] === true) {
        ?>
    <div class="alert alert-success alert-dismissible w-75" style="margin-left:180px" role="alert">
        <b>Thêm niên khóa thành công !</b>
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
        <b>Sửa thông tin niên khóa thành công !</b>
        <button type="button" class="btn-close pt-3" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
        unset($_SESSION['edit_alert']);
        }
    ?>
    <table>
        <tr>
            <th>Niên Khóa</th>
            <th>Loại</th>
            <th></th>
        </tr>
        <?php foreach ($nienkhoa_list as $nienkhoa): ?>
        <tr>
            <td>
                <div data-id="<?php echo $nienkhoa['idnk']; ?>" id="id"> <?php echo $nienkhoa['nienkhoa']; ?></div>
            </td>
            <td>
                <?php echo $nienkhoa['loai']; ?> năm
            </td>
            <td>
                <a href="index.php?action=nienkhoa&act=update_nienkhoa&id=<?php echo $nienkhoa['idnk']; ?>"
                    class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                <a class="btn btn-danger" id="del-btn">
                    <i class="fa-solid fa-trash"></i>
                </a>
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
                echo '<li><a href="index.php?action=nienkhoa&page=1"><<</a></li>';
            }
            for ($i = 1; $i <= $pages; $i++) {
                ?>
                        <li <?php if ($i == $current_page) echo 'class="active" '?>>
                            <a href="index.php?action=nienkhoa&page=<?php echo $i; ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                        <?php
            }
            if ($current_page < $pages && $pages > 1) {
                echo '<li><a href="index.php?action=nienkhoa&page=' . $pages . '">>></a></li>';
            }
            ?>
                    </ul>
                </div>
                <?php endif; ?>
            </td>
        </tr>
    </table>
</body>
<script>
$(document).ready(function() {
    $(document).on('click', "#del-btn", function() {
        let delete_id = $(this).closest('tr').find('#id').data("id");
        Swal.fire({
            title: "Xoá niên khóa này?",
            text: "Sau khi xoá niên khóa sẽ mất vĩnh viễn !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "Controller/nienkhoa.php?act=delete_nienkhoa",
                    method: "POST",
                    data: {
                        delete_id: delete_id
                    },
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res);
                        if (res.status === 'success') {
                            Swal.fire({
                                title: "Xoá niên khóa thành công!",
                                text: res.message,
                                icon: "success",
                                timer: 900,
                                timerProgressBar: true
                            }).then(() => {
                                window.location.reload();
                            })
                        } else {
                            Swal.fire({
                                title: "Xoá niên khóa thất bại!",
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