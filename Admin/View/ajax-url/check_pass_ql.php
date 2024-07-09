<?php
require_once "../../Model/connect.php";
require_once "../../Model/nhanvien.php";
if (isset($_GET['password']) && isset($_GET['id']) ) {
    $password = $_GET['password'];
    $id = $_GET['id'];

    $quanli_model = new quanli();
    $total = $quanli_model->checkpasswordbyid($password,$id);

    if ($total > 0) {
        echo "exists"; 
    } else {
        echo "not_exists";
    }
}
?>