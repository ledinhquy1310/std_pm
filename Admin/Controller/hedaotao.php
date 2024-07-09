<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php');
spl_autoload_register();
$act = "hedaotao";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}

switch ($act) {
    case 'hedaotao':
        include_once "View/hedaotao/hedaotao.php";
        break;

    case 'insert_hedaotao':
        include_once "./View/hedaotao/addhdt.php";
        break;

    case 'insert_action':
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $tenhdt = $_POST['tenhdt'];
            $mahdt = $_POST['mahdt'];

            require_once './Model/hedaotao.php';
            $hedaotao = new hedaotao();
            $check = $hedaotao->insertHeDaoTao($tenhdt, $mahdt);
            if ($check !== false) {
                echo '<script>alert("Thêm hệ đào tạo thành công");</script>';
                echo '<meta http-equiv=refresh content="0;url=index.php?action=hedaotao"/>';
            } else {
                echo '<script>alert("Thêm hệ đào tạo không thành công");</script>';
                include_once "./View/hedaotao/addhedaotao.php";
            }
        }
        break;

    case 'delete_hedaotao':
        if (isset($_POST['delete_id'])) {
            $delete_id = $_POST['delete_id'];    
            $hedaotao = new hedaotao();
            $result = $hedaotao->deletehedaotao($delete_id);

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

    case 'update_hedaotao':
        include_once "./View/hedaotao/edithdt.php";
        break;

    case "update_action":
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $idhdt = $_POST['idhdt'];
            $tenhdt = $_POST['tenhdt'];
            $mahdt = $_POST['mahdt'];
            require_once './Model/hedaotao.php';
            $hedaotao = new hedaotao();
            $check = $hedaotao->updateHeDaoTao($idhdt, $tenhdt, $mahdt);

            if ($check !== false) {
                echo '<script>alert("Cập nhật dữ liệu thành công");</script>';
                echo '<meta http-equiv=refresh content="0;url=index.php?action=hedaotao"/>';
            } else {
                echo '<script>alert("Cập nhật dữ liệu không thành công");</script>';
                include_once "./View/hedaotao/edithedaotao.php";
            }
        }
        break;
}

?>