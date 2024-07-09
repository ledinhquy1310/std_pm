<?php 
    require_once '../../Model/connect.php';
    require_once '../../Model/diachi.php';
    $province_id = $_GET['province_id'];
    
    $diachi_model = new diachi();
    $diachi_list = $diachi_model->getQuanbyTinh($province_id);
    $data[0] = [
        'id' => 0,
        'name' => 'Chọn một Quận/huyện'
        
    ];
    foreach ($diachi_list as $diachi) {
        $data[] = [
            'id' => $diachi['district_id'],
            'name' => $diachi['name']
        ];
    }
    echo json_encode($data);
?>