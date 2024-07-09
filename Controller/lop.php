<?php
$act = "lop";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}

switch ($act) {
    case 'lop':
        include_once "View/lop.php";
        break;
    case 'svlop':
        include_once "View/sinhvienlop.php";
        break;
    case "filter":
        include_once "View/lop.php";
        break;
}
?>