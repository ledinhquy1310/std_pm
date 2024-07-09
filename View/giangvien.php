<!DOCTYPE html>
<html lang="en">
<?php
require_once "./Model/giangvien.php";
$giangvien_model = new giangvien();
$count = $giangvien_model->getGiangVien()->rowCount();
$gv_count=$giangvien_model->countGV();
require_once "./Model/page.php";
$trang = new page();
$limit = 4;
$pages = $trang->findPage($count, $limit);
$start = $trang->findStart($limit);
$showPagination = true;
$giangvien_list = $giangvien_model->getGiangVienPage($start,$limit);

?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí giảng viên</title>
</head>

<body>
    <br>
    <div class="nav">
        <p><a href="index.php?action=home"><i class="fa-solid fa-house"></i></a> > <a href="index.php?action=giangvien">
                Danh sách giảng viên</a>
        </p>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <form method="POST" id="searchForm" action="">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search" id="searchInput" placeholder="Tên Giảng Viên"
                        aria-label="Tên Giảng Viên" aria-describedby="button-addon2" required>
                    <button class="btn btn-outline-secondary me-2" type="submit" id="button-addon2"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                    <button type="submit"><i class="fa-solid fa-rotate-right"
                            onclick="window.location.href='index.php?action=giangvien'"></i></button>
                </div>
            </form>
        </div>
    </div>
    <?php if ($gv_count==0) { ?>
    <p class="text-center text-danger">Không tìm thấy giảng viên</p>
    <?php } else { ?>
    <table id="table">
        <tr>
            <th>Tên Giảng Viên</th>
            <th>Trình độ</th>
            <th>Chuyên Ngành</th>
            <th>Khoa</th>
        </tr>
        <?php foreach ($giangvien_list as $giangvien): ?>
        <tr>
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
                echo '<li><a href="index.php?action=giangvien&page=' . $pages . '">>></a></li>';
            }
            ?>
                    </ul>
                </div>
                <?php endif; ?>
            </td>
        </tr>
    </table>
    <?php }?>
    <link rel="stylesheet" href="View/assets/css/giangvien.css">

</body>
<script>
$(document).ready(function() {
    $('#searchForm').submit(function(e) {
        e.preventDefault();
        var search = $('#searchInput').val();
        $.ajax({
            url: 'Admin/View/ajax-url/search_gv.php',
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
</script>

</html>