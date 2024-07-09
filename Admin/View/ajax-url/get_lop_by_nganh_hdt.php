<?php
require_once '../../Model/connect.php';
require_once '../../Model/lop.php';
$nganh_id = $_GET['nganh_id'];
$hedaotao_id = $_GET['hedaotao_id'];
$lop_model = new lop();
$lop_list = $lop_model->getLopByNganhHdt($nganh_id, $hedaotao_id);
$data[0] = [
    'id' => 0,
    'name' => '--Chọn Lớp--'
];
foreach ($lop_list as $lop) {
    $data[] = [
        'id' => $lop['idlop'],
        'name' => $lop['tenlop']
    ];
}
echo json_encode($data);
?>