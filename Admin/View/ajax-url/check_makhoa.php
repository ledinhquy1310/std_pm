<?php
require_once "../../Model/connect.php";
require_once "../../Model/khoa.php";
if (isset($_GET['makhoa'])) {
    $makhoa = $_GET['makhoa'];

    $khoa_model = new khoa();
    $total = $khoa_model->checkmakhoa($makhoa);
    if ($total > 0) {
        echo "exists"; 
    } else {
        echo "not_exists";
    }
}
?>