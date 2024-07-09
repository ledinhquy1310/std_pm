<?php
require './Model/class.phpmailer.php';
$act = "lichhen";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}

switch ($act) {
    case 'lichhen':
        include_once "View/lichhen/lichhen.php";
        break;

    case 'insert_lichhen':
        include_once "./View/lichhen/addlichhen.php";
        break;

    case 'insert_action':
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $idsv = $_POST['sinhvien'];
            $idgv = $_POST['giangvien'];
            $ngayhen = $_POST['ngayhen'];
            $ghichu = $_POST['ghichu'];
            $_SESSION['alert']=false;


            require_once './Model/lichhen.php';
            $lichhen = new lichhen();
            $check = $lichhen->insertlichhen($idsv, $idgv, $ngayhen, $ghichu);
            if ($check !== false) {
                echo 'success';
                $_SESSION['add_alert']=true;

                echo '<meta http-equiv=refresh content="0;url=index.php?action=lichhen"/>';
            } else {
                echo '<script>alert("Thêm lịch hẹn không thành công");</script>';
                include_once "./View/lichhen/addlichhen.php";
            }
        }
        break;
        case 'edit':
            include_once "./View/lichhen/editlichhen.php";
            break;
            case 'edit_action':
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $id = $_POST['id'];
                    $idsv = $_POST['sinhvien'];
                    $idgv = $_POST['giangvien'];
                    $ngayhen = $_POST['ngayhen'];
                    $ghichu = $_POST['ghichu'];
                    $_SESSION['alert']=false;

            
                    require_once './Model/lichhen.php';
                    $lichhen = new lichhen();
                    $check = $lichhen->editlichhen($id, $idsv, $idgv, $ngayhen, $ghichu);
                    if ($check !== false) {
                        echo 'success';
                        $_SESSION['edit_alert']=true;

                        echo '<meta http-equiv=refresh content="0;url=index.php?action=lichhen"/>';
                    } else {
                        echo '<script>alert("Sửa lịch hẹn không thành công");</script>';
                        include_once "./View/lichhen/editlichhen.php";
                    }
                }
                break;
            
    case 'delete_lichhen':
        if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['delete_id'])) {
            $delete_id = $_GET['delete_id'];
            require_once './Model/lichhen.php';
            $lichhen = new lichhen();
            $result = $lichhen->deletelichhen($delete_id);

            if ($result !== false) {
                echo '<script>alert("Xóa thành công");</script>';
                echo '<meta http-equiv=refresh content="0;url=index.php?action=lichhen"/>';
            } else {
                echo '<script>alert("Xóa không thành công");</script>';
            }
        }
        break;
        case 'delete_lichhen_sended':
            if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['delete_id'])) {
                $delete_id = $_GET['delete_id'];
                require_once './Model/lichhen.php';
                $lichhen = new lichhen();
                $result = $lichhen->deletelichhensended($delete_id);
    
                if ($result !== false) {
                    echo '<script>alert("Xóa thành công");</script>';
                    echo '<meta http-equiv=refresh content="0;url=index.php?action=lichhen"/>';
                } else {
                    echo '<script>alert("Xóa không thành công");</script>';
                }
            }
            break;
}
?>