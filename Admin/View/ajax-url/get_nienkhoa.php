<?php
require_once '../../Model/connect.php';
require_once '../../Model/nienkhoa.php';
$idhdt = $_GET['hdt_id'];
$nienkhoa_model = new nienkhoa();
$nienkhoa_list = $nienkhoa_model->getnienkhoabyhdt($idhdt); 
$data[0] = [
    'id' => 0,
    'name' => '--Chọn Niên Khóa--'
];
foreach ($nienkhoa_list as $nienkhoa) {
    $data[] = [
        'id' => $nienkhoa['idnk'],
        'name' => $nienkhoa['nienkhoa']
    ];
}
echo json_encode($data);
?>