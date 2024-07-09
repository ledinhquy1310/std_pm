<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php');
spl_autoload_register();
$act = "khoa";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}

switch ($act) {
    case 'khoa':
        include_once "View/khoa/khoa.php";
        break;

    case 'insert_khoa':
        include_once "./View/khoa/addkhoa.php";
        break;

    case 'insert_action':
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $tenkhoa = $_POST['tenkhoa'];
            $makhoa = $_POST['makhoa'];
            $ngaylap = date('Y-m-d');
            $mota = $_POST['mota'];


            require_once './Model/khoa.php';
            $khoa = new khoa();
            $check = $khoa->insertkhoa($tenkhoa, $makhoa, $ngaylap, $mota);
            if ($check !== false) {
                echo 'success';
                $_SESSION['add_alert']=true;
            } else {
                echo 'error';
                include_once "./View/khoa/addkhoa.php";
            }
        }
        break;

    case 'delete_khoa':
        if (isset($_POST['delete_id'])) {
            $delete_id = $_POST['delete_id'];    
            $khoa = new khoa();
            $result = $khoa->deletekhoa($delete_id);

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

    case 'update_khoa':
        include_once "./View/khoa/editkhoa.php";
        break;

    case "update_action":
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $idkhoa = $_POST['idkhoa'];
            $tenkhoa = $_POST['tenkhoa'];
            $makhoa = $_POST['makhoa'];
            $ngaylap = date('Y-m-d');
            $mota = $_POST['mota'];
            require_once './Model/khoa.php';
            $khoa = new khoa();
            $check = $khoa->updatekhoa($idkhoa, $tenkhoa, $makhoa, $ngaylap, $mota);

            if ($check !== false) {
                echo 'success';
                $_SESSION['edit_alert']=true;
            } else {
                echo 'error';
                include_once "./View/khoa/editkhoa.php";
            }
        }
        break;
}
?>