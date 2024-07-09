<?php 
require_once '../../Model/connect.php';
require_once '../../Model/lop.php';

$filter_nganh = $_POST['filter_nganh'];
$filter_nienkhoa = $_POST['filter_nienkhoa'];
$lop_model = new lop();
$count =$lop_model->getLop()->rowCount();
if (!empty($filter_nganh) && empty($filter_nienkhoa)) {
    $showPagination = false;
    $lop_list = $lop_model->filterLopByNganh($filter_nganh);
}
if (empty($filter_nganh) && !empty($filter_nienkhoa)) {
    $showPagination = false;
    $lop_list = $lop_model->filterLopByNienKhoa($filter_nienkhoa);
}
if(!empty($filter_nganh)&&!empty($filter_nienkhoa)){
    $showPagination = false;
    $lop_list = $lop_model->filterLopByNganhAndNienKhoa($filter_nganh,$filter_nienkhoa);
    $count=$lop_model->countLopByNganhAndNienKhoa($filter_nganh, $filter_nienkhoa);
}
?>
<table>
    <?php if($count>=1){?>
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
                    <a href="index.php?action=lop&act=svlop&id=<?php echo $lop['idlop']; ?>" class="btn btn-success">Sĩ
                        số: <?php
                        $totalSV = $lop_model->countSVinLop($lop['idlop']);
                        echo $totalSV ?> <i class="fa-solid fa-circle-info"></i> </a>
                </li>
                <li>Hệ Đào Tạo: <?php echo $lop['tenhdt'] ?></li>
                <li>Niên khóa: <?php echo $lop['nienkhoa']; ?></li>
            </ul>

        </td>
    </tr>
    <?php endforeach; 
        }else{
            echo "<p class='text-center text-danger'>Không tìm thấy lớp</p>";
        }?>
</table>