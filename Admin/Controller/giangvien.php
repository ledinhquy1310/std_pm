<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php');
spl_autoload_register();
$act = "giangvien";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}

switch ($act) {
    case 'giangvien':
        include_once "View/giangvien/giangvien.php";
        break;

    case 'insert_giangvien':
        include_once "./View/giangvien/addgiangvien.php";
        break;

    case 'insert_action':
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $magv = $_POST['magv'];
            $pass=$_POST['magv'];
            $tengv = $_POST['tengv'];
            $email=$_POST['email'];
            $trinhdo = $_POST['trinhdo'];
            $sodienthoai = $_POST['sodienthoai'];
            $khoa = $_POST['khoa'];
            $nganh = $_POST['nganh'];
            $salfF = "G435#";
            $salfL = "T34a!&";
            $password = md5($salfF . $pass . $salfL);

            require_once './Model/giangvien.php';
            $giangvien = new giangvien();
            $check = $giangvien->insertGiangVien($magv,$password, $tengv,$email, $trinhdo, $sodienthoai, $khoa, $nganh);

            if ($check !== false) {
                echo 'success';
                $_SESSION['add_alert']=true;
                echo '<meta http-equiv=refresh content="0;url=index.php?action=giangvien"/>';
            } else {
                echo '<script>alert("Thêm giảng viên không thành công");</script>';
                include_once "./View/giangvien/addgiangvien.php";
            }
        }
        break;


    case 'delete_giangvien':
        if (isset($_POST['delete_id'])) {
            $delete_id = $_POST['delete_id'];    
            $giangvien = new giangvien();
            $result = $giangvien->deletegiangvien($delete_id);

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

    case 'update_giangvien':
        include_once "./View/giangvien/editgiangvien.php";
        break;

    case "update_action":
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $idgv = $_POST['idgv'];
            $magv = $_POST['magv'];
            $pass=$_POST['magv'];
            $tengv = $_POST['tengv'];
            $email=$_POST['email'];
            $trinhdo = $_POST['trinhdo'];
            $sodienthoai = $_POST['sodienthoai'];
            $khoa = $_POST['khoa'];
            $nganh = $_POST['nganh'];
            $salfF = "G435#";
            $salfL = "T34a!&";
            $password = md5($salfF . $pass . $salfL);
            require_once './Model/giangvien.php';
            $giangvien = new giangvien();
            $check = $giangvien->updateGiangVien($idgv, $magv,$password, $tengv,$email, $trinhdo, $sodienthoai, $khoa, $nganh);

            if ($check !== false) {
                echo 'success';
                $_SESSION['edit_alert']=true;

                echo '<meta http-equiv=refresh content="0;url=index.php?action=giangvien"/>';
            } else {
                echo '<script>alert("Cập nhật dữ liệu không thành công");</script>';
                include_once "./View/giangvien/editgiangvien.php";
            }
        }
        break;
    case 'chitiet':
        if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id'])) {
            $idgv = $_GET['id'];
            require_once './Model/giangvien.php';
            $giangvien_model = new giangvien();
            $giangvien_info = $giangvien_model->getGiangVienById($idgv);

            if ($giangvien_info) {

                include_once "./View/giangvien/chitietgiangvien.php";
            } else {
                echo '<script>alert("Không tìm thấy giảng viên.");</script>';
                echo '<meta http-equiv=refresh content="0;url=index.php?action=giangvien"/>';
            }
        } else {
            echo '<script>alert("Mã giảng viên không được cung cấp.");</script>';
            echo '<meta http-equiv=refresh content="0;url=index.php?action=giangvien"/>';
        }
        break;


}
?>