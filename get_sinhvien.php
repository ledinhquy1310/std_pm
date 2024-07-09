<?php
require_once './Model/connect.php';
require_once './Model/sinhvien.php';
$lop_id = $_GET['lop_id'];

$sinhvien_model = new sinhvien();
$sinhvien_list = $sinhvien_model->getSinhVienByLop($lop_id);
$data[0] = [
    'id' => null,
    'name' => '--Chọn Sinh viên--',

];
foreach ($sinhvien_list as $sinhvien) {
    $data[] = [
        'id' => $sinhvien['idsv'],
        'name' => $sinhvien['tensv']
    ];
}
echo json_encode($data);
?>