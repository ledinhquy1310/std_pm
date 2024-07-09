<?php
require_once "../../Model/doan.php";
require_once "../../Model/connect.php";

if (isset($_GET['madoan'])&& isset($_GET['role'])) {
    $madoan = $_GET['madoan'];
    $role = $_GET['role'];
    $doan_model = new doan();
    if ($role == 'add') {
    $total = $doan_model->checkmadoan($madoan)->rowCount();
    } else {
        if(isset($_GET['iddoan'])){
        $iddoan = $_GET['iddoan'];
        $doan_info = $doan_model->getDoanById($iddoan);
        $madoan_now = $doan_info['madoan'];
        $total = $doan_model->checkmadoanedit($madoan,$madoan_now)->rowCount();
        }    
    }
    if ($total > 0) {
        echo "exists"; 
    } else {
        echo "not_exists";
    }
}
?>