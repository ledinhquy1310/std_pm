<!DOCTYPE html>
<html lang="en">
<?php
require_once "./Model/giangvien.php";
$giangvien_model = new giangvien();
$gv_count=$giangvien_model->countGV();
require_once "./Model/page.php";
$trang = new page();
$limit = 4;
$pages = $trang->findPage($gv_count, $limit);
$start = $trang->findStart($limit);
$showPagination = true;
$giangvien_list = $giangvien_model->getGiangVienPage($start,$limit);
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí giảng viên</title>
    <link rel="stylesheet" href="View/assets/css/giangvien/giangvien.css">
</head>

<body>
    <br>
    <div class="nav">
        <p><a href="index.php?action=home"><i class="fa-solid fa-house"></i></a> > <a href="index.php?action=giangvien">
                Danh sách giảng viên</a> >
            <a href="index.php?action=giangvien&act=insert_giangvien" class="btn-add"><i class="fa-solid fa-plus"></i>
                Thêm mới</a>
        </p>
    </div>
    <!-- them -->
    <?php if (isset($_SESSION['add_alert']) && $_SESSION['add_alert'] === true) {
        ?>
    <div class="alert alert-success alert-dismissible w-75" style="margin-left:180px" role="alert">
        <b>Thêm giảng viên thành công !</b>
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
        <b>Sửa thông tin giảng viên thành công !</b>
        <button type="button" class="btn-close pt-3" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
        unset($_SESSION['edit_alert']);
        }
    ?>
    <div class="row">
        <div class="col-lg-6">
            <form method="POST" id="searchForm" action="">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search" id="searchInput" placeholder="Tên Giảng Viên"
                        aria-label="Tên Giảng Viên" aria-describedby="button-addon2" required>
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
    </div>
    <?php if ($gv_count==0) { ?>
    <p class="text-center text-danger">Không tìm thấy giảng viên</p>
    <?php } else { ?>
    <table id="table">
        <tr>
            <th>Mã Giảng Viên</th>
            <th>Tên Giảng Viên</th>
            <th>Trình độ</th>
            <th>Chuyên Ngành</th>
            <th>Khoa</th>
            <th></th>
        </tr>
        <?php foreach ($giangvien_list as $giangvien): ?>
        <tr>
            <td>
                <div data-id="<?php echo $giangvien['idgv']; ?>" id="id"><?php echo $giangvien['magv']; ?></div>
            </td>
            <td>
                <a style="color: black; cursor: pointer;" data-bs-toggle="modal"
                    data-bs-target="#exampleModal<?php echo $giangvien['idgv']; ?>">
                    <?php echo $giangvien['tengv']; ?>
                </a>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal<?php echo $giangvien['idgv']; ?>" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="margin-left:150px">
                        <div class="modal-content" style="width:1000px">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thông tin giảng viên</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>

                            </div>
                            <div class="modal-body">
                                <table style="width:960px">
                                    <tr>
                                        <th colspan="2">
                                            <h2>Thông tin giảng viên</h2>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Mã giảng viên</th>
                                        <td><?php echo $giangvien['magv']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tên giảng viên</th>
                                        <td><?php echo $giangvien['tengv']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?php echo $giangvien['email_gv']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Trình độ</th>
                                        <td><?php echo $giangvien['tentd']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Số điện thoại</th>
                                        <td><?php echo $giangvien['sodienthoai']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Khoa</th>
                                        <td><?php echo $giangvien['tenkhoa']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Ngành</th>
                                        <td><?php echo $giangvien['tennganh']; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>

            <td><?php echo $giangvien['tentd']; ?></td>
            <td><?php echo $giangvien['tennganh']; ?></td>
            <td><?php echo $giangvien['tenkhoa']; ?></td>
            <td>
                <a class="btn btn-info"
                    href="index.php?action=giangvien&act=update_giangvien&id=<?php echo $giangvien['idgv']; ?>"><i
                        class="fa-solid fa-pen-to-square"></i></a>
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
                echo '<li><a href="index.php?action=giangvien&page=1"><<</a></li>';
            }
            for ($i = 1; $i <= $pages; $i++) {
                ?>
                        <li <?php if ($i == $current_page) echo 'class="active" '?>>
                            <a href="index.php?action=giangvien&page=<?php echo $i; ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                        <?php
            }
            if ($current_page < $pages && $pages > 1) {
                echo '<li><a href="index.php?action=giangvien&page=' . $pages. '">>></a></li>';
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
    $('#searchForm').submit(function(e) {
        e.preventDefault();
        var search = $('#searchInput').val();
        $.ajax({
            url: 'View/ajax-url/search_gv.php',
            type: 'POST',
            data: {
                search: search,
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
            title: "Xoá giảng viên này?",
            text: "Sau khi xoá giảng viên sẽ mất vĩnh viễn !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "Controller/giangvien.php?act=delete_giangvien",
                    method: "POST",
                    data: {
                        delete_id: delete_id
                    },
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res);
                        if (res.status === 'success') {
                            Swal.fire({
                                title: "Xoá giảng viên thành công!",
                                text: res.message,
                                icon: "success",
                                timer: 900,
                                timerProgressBar: true
                            }).then(() => {
                                window.location.reload();
                            })
                        } else {
                            Swal.fire({
                                title: "Xoá giảng viên thất bại!",
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