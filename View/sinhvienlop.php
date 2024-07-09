<?php if (isset($_GET['id'])) {
    $idlop = $_GET['id'];
    require_once "./Model/sinhvien.php";
    $sinhvien_model = new sinhvien();
    $sinhvien_list = $sinhvien_model->SelectSVLop($idlop);
    $sinhvien_count=$sinhvien_model->countStudents($idlop);
}
?>

<div>
    <div class="nav">
        <p><a href="index.php?action=home"><i class="fa-solid fa-house"></i></a> >
            <a href="index.php?action=lop">Danh sách lớp</a> >
            <a href="index.php?action=lop" class="btn-return"><i class="fa-solid fa-circle-left"></i> Trở về</a>
        </p>
    </div>
    <?php if ($sinhvien_count==0) { ?>
    <p class="text-center text-danger">Không có sinh viên.</p>
    <?php } else { ?>
    <table>
        <th class="title" colspan="4">
            <h5>Danh Sách sinh viên</h5>
        </th>
        <tr>
            <th>MSSV</th>
            <th>Tên Sinh viên</th>
            <th>MSSV</th>
            <th>Số điện thoại</th>
        </tr>
        <?php foreach ($sinhvien_list as $sinhvien) { ?>
        <tr>
            <td>
                <?php echo $sinhvien['mssv']; ?>
            </td>
            <td>
                <?php echo $sinhvien['tensv']; ?>
            </td>
            <td>
                <?php echo $sinhvien['mssv']; ?>
            </td>
            <td>
                <?php echo $sinhvien['sodienthoai']; ?>
            </td>
        </tr>
        <?php } ?>
    </table>
    <?php } ?>
</div>
<link rel="stylesheet" href="View/assets/css/sinhvienlop.css">