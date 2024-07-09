<?php
$act = "giangvien";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}

switch ($act) {
    case 'giangvien':
        include_once "View/giangvien.php";
        break;
        case 'search':
            include_once "View/giangvien.php";
            break;

}
?>