<?php
require_once "../../Model/connect.php";
require_once "../../Model/nganh.php";
if (isset($_GET['manganh'])) {
    $manganh = $_GET['manganh'];

    $nganh_model = new nganh();
    $total = $nganh_model->checkmanganh($manganh);
    if ($total > 0) {
        echo "exists"; 
    } else {
        echo "not_exists";
    }
}
?>