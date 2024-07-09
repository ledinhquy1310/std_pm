<?php
require_once "../../Model/connect.php";
if (isset($_GET['old_password']) && isset($_GET['id'])){
    $password = $_GET['old_password'];
    $id = $_GET['id'];
    if ($_GET['type'] === 'sinhvien') {
        include_once '../../Model/sinhvien.php';
        $sv = new sinhvien();
        $total=$sv->checkPassword($id, $password)->rowCount();
    } elseif ($_GET['type'] === 'giangvien') {
        include_once '../../Model/giangvien.php';
        $gv = new giangvien();
        $total=$gv->checkPassword($id, $password)->rowCount();
    }
    if ($total > 0) {
        echo "exists"; 
    } else {
        echo "not_exists";
    }
}
?>