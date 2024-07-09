<?php
require_once '../../Model/connect.php';
require_once '../../Model/nganh.php';
$khoa_id = $_GET['khoa_id'];

$nganh_model = new nganh();
$nganh_list = $nganh_model->getnganhByKhoa($khoa_id);
$data[0] = [
    'id' => 0,
    'name' => '--Chọn Ngành--',
];
foreach ($nganh_list as $nganh) {
    $data[] = [
        'id' => $nganh['idnganh'],
        'name' => $nganh['tennganh'],
    ];
}
echo json_encode($data);
?>