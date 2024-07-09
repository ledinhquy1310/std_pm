<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php');
spl_autoload_register();
$act = "nganh";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}

switch ($act) {
    case 'nganh':
        include_once "View/nganh/nganh.php";
        break;

    case 'insert_nganh':
        include_once "./View/nganh/addnganh.php";
        break;

    case 'insert_action':
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $tennganh = $_POST['tennganh'];
            $manganh = $_POST['manganh'];
            $khoa = $_POST['khoa'];

            require_once './Model/nganh.php';
            $nganh = new nganh(); 
            $check = $nganh->insertnganh($tennganh, $manganh, $khoa);

            if ($check !== false) {
                echo 'success';
                $_SESSION['add_alert']=true;
                echo '<meta http-equiv=refresh content="0;url=index.php?action=nganh"/>'; 
            } else {
                echo 'error';
                echo '<script>alert("Thêm ngành không thành công");</script>';
                include_once "./View/nganh/addnganh.php";
            }
        }
        break;

    case 'delete_nganh':
        if (isset($_POST['delete_id'])) {
            $delete_id = $_POST['delete_id'];    
            $nganh = new nganh();
            $result = $nganh->deletenganh($delete_id);

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

    case 'update_nganh':
        include_once "./View/nganh/editnganh.php";
        break;

    case "update_action":
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $idnganh = $_POST['idnganh'];
            $tennganh = $_POST['tennganh'];
            $manganh = $_POST['manganh'];
            $khoa = $_POST['khoa'];

            require_once './Model/nganh.php';
            $nganh = new nganh();
            $check = $nganh->updatenganh($idnganh, $tennganh, $manganh, $khoa);

            if ($check !== false) {
                echo 'success';
                $_SESSION['edit_alert']=true;
                echo '<meta http-equiv=refresh content="0;url=index.php?action=nganh"/>';
            } else {
                echo 'error';
                echo '<script>alert("Cập nhật dữ liệu không thành công");</script>';
                include_once "./View/nganh/editnganh.php";
            }
        }
        break;
}
?>