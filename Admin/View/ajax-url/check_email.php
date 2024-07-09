<?php
require_once "../../Model/connect.php";
require_once "../../Model/sinhvien.php";
if (isset($_GET['email']) && isset($_GET['role']) ) {
    $email = $_GET['email'];
    $role = $_GET['role'];

    $sinhvien_model = new sinhvien();


    if ($role == 'add') {
        $total = $sinhvien_model->checkemail($email)->rowCount();
    } else if ($role == 'edit') {
        if( isset($_GET['idsv'])){
        $idsv = $_GET['idsv'];
        $sinhvien_info = $sinhvien_model->getSinhVienById($idsv); 
        $email_now = $sinhvien_info['email'];
        $total = $sinhvien_model->checkemail_edit($email, $email_now)->rowCount();
        }
       
    }

    if ($total > 0) {
        echo "exists"; 
    } else {
        echo "not_exists";
    }
}
?>