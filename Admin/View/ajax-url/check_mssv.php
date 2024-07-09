<?php
require_once "../../Model/connect.php";
require_once "../../Model/sinhvien.php";
if (isset($_GET['mssv'])&& isset($_GET['role'])) {
    $mssv = $_GET['mssv'];
    $role = $_GET['role'];

    $sinhvien_model = new sinhvien();

    if ($role == 'add') {
        $total = $sinhvien_model->checkMSSVadd($mssv);
    } else if ($role == 'edit') {
        if( isset($_GET['idsv'])){
        $idsv = $_GET['idsv'];
        $sinhvien_info = $sinhvien_model->getSinhVienById($idsv);
        $mssv_now=$sinhvien_info['mssv'];
        $total = $sinhvien_model->checkMSSVedit($mssv,$mssv_now);
        }
       
    }
    if ($total > 0) {
        echo "exists"; 
    } else {
        echo "not_exists";
    }
}
?>