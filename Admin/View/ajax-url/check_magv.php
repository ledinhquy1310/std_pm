<?php
require_once "../../Model/connect.php";
require_once "../../Model/giangvien.php";

if (isset($_GET['magv'])&& isset($_GET['role'])) {
    $magv = $_GET['magv'];
    $role = $_GET['role'];
    $gv_model = new giangvien();
    if ($role == 'add') {
        $total = $gv_model->checkmagv($magv);
    } else {
        if(isset($_GET['idgv'])){
        $idgv = $_GET['idgv'];
        $giangvien_info = $gv_model->getGiangvienById($idgv);
        $magv_now = $giangvien_info['magv'];
        $total = $gv_model->checkMagv_edit($magv, $magv_now);
        }    
    }
    if ($total > 0) {
        echo "exists"; 
    } else {
        echo "not_exists";
    }
}
?>