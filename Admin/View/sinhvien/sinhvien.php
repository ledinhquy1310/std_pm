<!DOCTYPE html>
<html lang="en">

<?php
require_once "./Model/sinhvien.php";
$sinhvien_model = new sinhvien();

require_once "./Model/page.php";
$trang = new page();
$limit = 4;
$count = $sinhvien_model->getSinhVienList()->rowCount();
$pages = $trang->findPage($count, $limit);
$start = $trang->findStart($limit);
$showPagination = true;
$sinhvien_list = $sinhvien_model->getSinhVienListPage($start, $limit);
$sinhvien_count = $sinhvien_model->countSinhvien();
require_once "./Model/lop.php";
$lop_model = new lop();
$lop_list = $lop_model->getLop();
require_once "./Model/nganh.php";
$nganh_model = new nganh();
$nganh_list = $nganh_model->getnganh();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí sinh viên</title>
    <link rel="stylesheet" href="View/assets/css/sinhvien/sinhvien.css">
</head>

<body>
    <br>
    <div class="nav">
        <p><a href="index.php?action=home"><i class="fa-solid fa-house"></i></a> > <a href="index.php?action=sinhvien">
                Danh sách sinh viên</a> >
            <a href="index.php?action=sinhvien&act=insert_sinhvien" class="btn-add"><i class="fa-solid fa-plus"></i>
                Thêm mới</a>
            <!-- export excel -->
            <a href="excel_index.php?action=sinhvien&act=export" class="btn-add">
                <i class="fa-solid fa-upload"></i> Export Excel</a>
            <!-- import excel -->
            <a href="" class="btn-add" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa-solid fa-download"></i> Import Excel</a>

            <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Import Excel</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php include_once "import.php"; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
        </p>
    </div>
    <div class="row">
        <!-- filter -->
        <div class="col-lg-6">
            <div class="form-group">
                <form method="POST" id="filter" action="">
                    <select name="lop" id="lop" style="width:280px;height:40px">
                        <option value="" disabled selected>--Chọn Lớp--</option>
                        <?php foreach ($lop_list as $lop) : ?>
                            <option value="<?php echo $lop['idlop']; ?>"><?php echo $lop['tenlop']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>
        </div>
        <!-- search -->
        <div class="col-lg-6">
            <div class="form-group">
                <form method="POST" id="searchForm" action="">
                    <input type="text" name="search" id="searchInput" placeholder="Tên/MSSV" required>
                    <button type="submit" value="Tìm kiếm"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <button type="submit" value="reset" onclick="window.location.href='index.php?action=sinhvien'"><i class="fa-solid fa-rotate-right"></i></button>
                </form>

            </div>
        </div>
    </div>
    <!-- them -->
    <?php if (isset($_SESSION['add_alert']) && $_SESSION['add_alert'] === true) {
    ?>
        <div class="alert alert-success alert-dismissible w-75" style="margin-left:180px" role="alert">
            <b>Thêm sinh viên thành công !</b>
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
            <b>Sửa thông tin sinh viên thành công !</b>
            <button type="button" class="btn-close pt-3" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        unset($_SESSION['edit_alert']);
    }
    ?>
    <?php if ($sinhvien_count == 0) { ?>
        <p class="text-center text-danger">Không có sinh viên.</p>
    <?php } else {
    ?>
        <table id="table">
            <tr>
                <th>MSSV</th>
                <th>Tên sinh viên</th>
                <th>Thông tin</th>
                <th>Thông tin khác</th>
                <th></th>
            </tr>
            <?php
            foreach ($sinhvien_list as $sinhvien) :
                $diachi = $sinhvien['diachi'];
                $diachi_parts = explode(',', $diachi);
                $province_id = $diachi_parts[0];
                $district_id = $diachi_parts[1];
                $wards_id = $diachi_parts[2];
                $diachi_chitiet = implode(',', array_slice($diachi_parts, 3));
                require_once "./Model/diachi.php";
                $diachi_model = new diachi();
                $tinh = $diachi_model->getTinhbyId($province_id);
                $quan = $diachi_model->getQuanbyId($district_id);
                $xa = $diachi_model->getXabyId($wards_id);

            ?>
                <tr>
                    <td>
                        <div data-id="<?php echo $sinhvien['idsv']; ?>" id="id"><?php echo $sinhvien['mssv']; ?></div>
                    </td>
                    <td>
                        <a style="color: black; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $sinhvien['idsv']; ?>">
                            <?php echo $sinhvien['tensv']; ?>
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal<?php echo $sinhvien['idsv']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" style="margin-left:150px">
                                <div class="modal-content" style="width:1000px">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Thông tin sinh viên</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table style="width:960px">
                                            <tr>
                                                <th colspan="2">
                                                    <h2>Thông tin sinh viên</h2>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Mã số sinh viên</th>
                                                <td><?php echo $sinhvien['mssv']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Họ và tên</th>
                                                <td><?php echo $sinhvien['tensv']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Ngày sinh</th>
                                                <td><?php echo date('d/m/Y', strtotime($sinhvien['ngaysinh'])); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td><?php echo $sinhvien['email']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Giới tính</th>
                                                <td><?php echo $sinhvien['gioitinh']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Số điện thoại</th>
                                                <td><?php echo $sinhvien['sodienthoai']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Địa chỉ</th>
                                                <td><?php echo $diachi_chitiet . ',' . $xa['name'] . ',' . $quan['name'] . ',' . $tinh['name']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>CCCD</th>
                                                <td><?php echo $sinhvien['cccd']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Ngành</th>
                                                <td><?php echo $sinhvien['tennganh']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Lớp</th>
                                                <td><?php echo $sinhvien['tenlop']; ?></td>
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
                    <td>
                        <ul>
                            <li>- Ngày sinh: <?php echo date('d/m/Y', strtotime($sinhvien['ngaysinh'])); ?></li>
                            <li>- Số điện thoại: <?php echo $sinhvien['sodienthoai']; ?></li>
                            <li>- Địa chỉ: <br>
                                <?php echo $diachi_chitiet . ', ' . $xa['name'] . ', <br>' . $quan['name'] . ',' . $tinh['name']; ?>
                            </li>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <li>- Hệ đào tạo: <?php echo $sinhvien['tenhdt']; ?> </li>
                            <li>- Ngành: <?php echo $sinhvien['tennganh']; ?> </li>
                            <li>- Khoa: <?php echo $sinhvien['tenkhoa']; ?> </li>
                            <li>- Lớp: <?php echo $sinhvien['tenlop']; ?> </li>
                        </ul>
                    </td>
                    <td>
                        <a class="btn btn-info" href="index.php?action=sinhvien&act=update_sinhvien&id=<?php echo $sinhvien['idsv']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a class="btn btn-danger" id="del-btn">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

            if ($current_page < 1 || $current_page > $pages) {
                echo '<meta http-equiv=refresh content="0;url=index.php?action=sinhvien"/>';
                exit();
            }
            ?>
            <tr>
                <td colspan="5" style="border:none; text-align:center">
                    <?php if ($showPagination) : ?>
                        <div class="">
                            <ul class="pagination">
                                <?php
                                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                if ($current_page > 1 && $pages > 1) {
                                    echo '<li class="page-item"><a href="index.php?action=sinhvien&page=1"><<</a></li>';
                                }
                                for ($i = 1; $i <= $pages; $i++) {
                                ?>
                                    <li <?php if ($i == $current_page) echo 'class="active" ' ?>>
                                        <a href="index.php?action=sinhvien&page=<?php echo $i; ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    </li>
                                <?php
                                }
                                if ($current_page < $pages && $pages > 1) {
                                    echo '<li class="page-item"><a href="index.php?action=sinhvien&page='  . $pages .  '">>></a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    <?php } ?>
</body>
<script src="ajax/get_lop.js"></script>
<script>
    $(document).ready(function() {
        $('#searchForm').submit(function(e) {
            var lop_id = $('#lop').val();
            var search = $('#searchInput').val();
            e.preventDefault();
            $.ajax({
                url: 'View/ajax-url/search_sv.php',
                type: 'POST',
                data: {
                    search: search,
                    lop_id: lop_id,
                },
                success: function(data) {
                    $('#table').html(data);
                }
            });
        });

        $('#filter').change(function() {
            var lop_id = $('#lop').val();
            $.ajax({
                url: 'View/ajax-url/filter_sv.php',
                type: 'POST',
                data: 'request=' + lop_id,
                success: function(data) {
                    $('#table').html(data);
                }
            });
        });
    });

    //Xoá (soft delete)
    $(document).ready(function() {
        $(document).on('click', "#del-btn", function() {
            let delete_id = $(this).closest('tr').find('#id').data("id");
            Swal.fire({
                title: "Xoá sinh viên này?",
                text: "Sau khi xoá sinh viên sẽ mất vĩnh viễn !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "Controller/sinhvien.php?act=delete_sinhvien",
                        method: "POST",
                        data: {
                            delete_id: delete_id
                        },
                        dataType: "JSON",
                        success: function(res) {
                            console.log(res);
                            if (res.status === 'success') {
                                Swal.fire({
                                    title: "Xoá sinh viên thành công!",
                                    text: res.message,
                                    icon: "success",
                                    timer: 900,
                                    timerProgressBar: true
                                }).then(() => {
                                    window.location.reload();
                                })
                            } else {
                                Swal.fire({
                                    title: "Xoá sinh viên thất bại!",
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