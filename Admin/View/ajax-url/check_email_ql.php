<?php
require_once "../../Model/connect.php";
require_once "../../Model/nhanvien.php";

if (isset($_GET['email']) && isset($_GET['role']) ) {
    $email = $_GET['email'];
    $role = $_GET['role'];

    $quanli_model = new quanli();
    if ($role == 'add') {
        $total = $quanli_model->checkemail($email);
    } else if ($role == 'edit') {
        if( isset($_GET['id'])){
        $idql = $_GET['id'];
        $quanli_info = $quanli_model->getquanliById($idql); 
        $email_now = $quanli_info['email'];
        $total = $quanli_model->checkemail_edit($email, $email_now);
        }
       
    }
    if ($total > 0) {
        echo "exists"; 
    } else {
        echo "not_exists";
    }
}
?>