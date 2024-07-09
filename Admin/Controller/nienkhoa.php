<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php');
spl_autoload_register();
$act = "nienkhoa";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}

switch ($act) {
    case 'nienkhoa':
        include_once "View/nienkhoa/nienkhoa.php";
        break;

    case 'insert_nienkhoa':
        include_once "./View/nienkhoa/addnienkhoa.php";
        break;
    case 'insert_action':
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $tennienkhoa = $_POST['nienkhoa1'] . '-' . $_POST['nienkhoa2'];
            $loai=$_POST['nienkhoa2']-$_POST['nienkhoa1'];
            require_once './Model/nienkhoa.php';
            $nienkhoa = new nienkhoa();
            $check = $nienkhoa->insertNienKhoa($tennienkhoa,$loai);
            if ($check !== false) {
                echo 'success';
                $_SESSION['add_alert']=true;
                echo '<meta http-equiv=refresh content="0;url=index.php?action=nienkhoa"/>';
            } else {
                echo '<script>alert("Thêm niên khóa không thành công");</script>';
                include_once "./View/nienkhoa/addnienkhoa.php";
            }
        }
        break;

    case 'delete_nienkhoa':
        if (isset($_POST['delete_id'])) {
            $delete_id = $_POST['delete_id'];    
            $nienkhoa = new nienkhoa();
            $result = $nienkhoa->deletenienkhoa($delete_id);

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

    case 'update_nienkhoa':
        include_once "./View/nienkhoa/editnienkhoa.php";
        break;

    case "update_action":
        // Nhận thông tin từ form
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $idnk = $_POST['idnk'];
            $tennienkhoa = $_POST['nienkhoa1'] . '-' . $_POST['nienkhoa2'];
            $loai=$_POST['nienkhoa2']-$_POST['nienkhoa1'];
            require_once './Model/nienkhoa.php';
            $nienkhoa = new nienkhoa();
            $check = $nienkhoa->updateNienKhoa($idnk, $tennienkhoa,$loai);

            // Kiểm tra kết quả và hiển thị thông báo
            if ($check !== false) {
                echo 'success';
                $_SESSION['edit_alert']=true;
                echo '<meta http-equiv=refresh content="0;url=index.php?action=nienkhoa"/>';
            } else {
                echo '<script>alert("Cập nhật dữ liệu không thành công");</script>';
                include_once "./View/nienkhoa/editnienkhoa.php";
            }
        }
        break;
}
?>