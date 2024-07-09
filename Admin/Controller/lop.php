<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php');
spl_autoload_register();
$act = "lop";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}

switch ($act) {
    case 'lop':
        include_once "View/lop/lop.php";
        break;
    case 'svlop':
        include_once "View/lop/sinhvienlop.php";
        break;
    case 'insert_lop':
        include_once "./View/lop/addlop.php";
        break;

    case 'insert_action':
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $tenlop = $_POST['tenlop'];
            $malop = $_POST['malop'];
            $nganh = $_POST['nganh'];
            $nienkhoa = $_POST['nienkhoa'];
            $hdt = $_POST['hdt'];

            require_once './Model/lop.php';
            $lop = new lop();
            $check = $lop->insertLop($tenlop, $malop, $nganh, $nienkhoa, $hdt);
            if ($check !== false) {
                echo 'success';
                $_SESSION['add_alert']=true;
                echo '<meta http-equiv=refresh content="0;url=index.php?action=lop"/>';
            } else {
                echo '<script>alert("Thêm lớp không thành công");</s>';
                include_once "./View/lop/addlop.php";
            }
        }
        break;

    case 'delete_lop':
        if (isset($_POST['delete_id'])) {
            $delete_id = $_POST['delete_id'];    
            $lop = new lop();
            $result = $lop->deletelop($delete_id);

            if ($result !==false) {
                $res=array(
                    "status"=>"success",
                    "message"=>"Xóa thành công" 
                );
            }else {
                $res=array(
                    "status"=>"fail",
                    "message"=>"Xóa không thành công"
                );
            }
            echo json_encode($res);
        }
        break;

    case 'update_lop':
        include_once "./View/lop/editlop.php";
        break;

    case "update_action":

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $idlop = $_POST['idlop'];
            $tenlop = $_POST['tenlop'];
            $malop = $_POST['malop'];
            $nganh = $_POST['nganh'];
            $nienkhoa = $_POST['nienkhoa'];
            $hdt = $_POST['hdt'];
            require_once './Model/lop.php';
            $lop = new lop();
            $check = $lop->updateLop($idlop, $tenlop, $malop, $nganh, $nienkhoa, $hdt);

            if ($check !== false) {
                echo 'success';
                $_SESSION['edit_alert']=true;
                echo '<meta http-equiv=refresh content="0;url=index.php?action=lop"/>';
            } else {
                echo '<script>alert("Cập nhật dữ liệu không thành công");</script>';
                include_once "./View/lop/editlop.php";
            }
        }
        break;
    case "filter":
        include_once "View/lop/lop.php";
        break;
}
?>