<?php 
   require_once '../../Model/connect.php';
   require_once '../../Model/diachi.php';
   $district_id = $_GET['district_id'];
   $diachi_model = new diachi();
   $diachi_list = $diachi_model->getXabyQuan($district_id);
    $data[0] = [
        'id' => 0,
        'name' => 'Chọn một xã/phường'
    ];

    foreach ($diachi_list as $diachi) {
        $data[] = [
            'id' => $diachi['wards_id'],
            'name' => $diachi['name']
        ];
    }
    echo json_encode($data);
?>