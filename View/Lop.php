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

</head>

<body>
    <br>
    <div class="nav">
        <p><a href="index.php?action=home"><i class="fa-solid fa-house"></i></a> >
            <a href="index.php?action=lop">Danh sách lớp</a>
        </p>
    </div>
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
            <button type="submit"><i class="fa-solid fa-rotate-right"
                    onclick="window.location.href='index.php?action=lop'"></i></button>
        </form>
    </div>
    <?php if ($lop_count==0) { ?>
    <p class="text-center text-danger">Không tìm thấy lớp</p>
    <?php } else { ?>
    <table id="table" class="mb-3">
        <tr>
            <th>Tên lớp</th>
            <th>Mã lớp</th>
            <th>Ngành</th>
            <th>Thông tin</th>

        </tr>
        <?php foreach ($lop_list as $lop): ?>

        <tr>
            <td>
                <?php echo $lop['tenlop']; ?>
            </td>
            <td>
                <?php echo $lop['malop']; ?>
            </td>
            <td>
                <?php echo $lop['tennganh']; ?>
            </td>
            <td>
                <ul>
                    <li>
                        <a href="index.php?action=lop&act=svlop&id=<?php echo $lop['idlop']; ?>"
                            class="btn btn-success">Sĩ số: <?php
                        $totalSV = $lop_model->countSVinLop($lop['idlop']);
                        echo $totalSV ?> <i class="fa-solid fa-circle-info"></i> </a>
                    </li>
                    <li>Hệ Đào Tạo: <?php echo $lop['tenhdt'] ?></li>
                    <li>Niên khóa: <?php echo $lop['nienkhoa']; ?></li>
                </ul>

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
                echo '<li><a href="index.php?action=lop&page=1"><<</a></li>';
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
                echo '<li><a href="index.php?action=lop&page=' . $pages . '">>></a></li>';
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
</script>

</html>
<link rel="stylesheet" href="View/assets/css/Lop.css">