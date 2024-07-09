<?php
require_once "../../Model/connect.php";
require_once "../../Model/lop.php";
if (isset($_GET['malop'])) {
    $malop = $_GET['malop'];

    $lop_model = new lop();
    $total = $lop_model->checkmalop($malop);
    if ($total > 0) {
        echo "exists"; 
    } else {
        echo "not_exists";
    }
}
?>