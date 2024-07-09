<?php
$act = "sinhvien";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}

switch ($act) {
    case 'sinhvien':
        include_once "View/sinhvien.php";
        break;
    case 'search':
        include_once "View/sinhvien.php";
        break;
    case 'filter':
        include_once "View/sinhvien.php";
        break;



}
?>