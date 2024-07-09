<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php');
spl_autoload_register();
$act = "sinhvien";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}

switch ($act) {
    case 'sinhvien':
        include_once "View/sinhvien/sinhvien.php";
        break;

    case 'insert_sinhvien':
        include_once "./View/sinhvien/addsinhvien.php";
        break;

    case 'insert_action':
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $mssv = $_POST['mssv'];
            $tensv = $_POST['tensv'];
            $email = $_POST['email'];
            $pass = $_POST['mssv'];
            $salfF = "G435#";
            $salfL = "T34a!&";
            $password = md5($salfF . $pass . $salfL);
            $ngaysinh = $_POST['ngaysinh'];
            $sodienthoai = $_POST['sodienthoai'];
            $gioitinh = $_POST['gioitinh'];

            $diachi_province = $_POST['province'];
            $diachi_district = $_POST['district'];
            $diachi_wards = $_POST['wards'];
            $diachi_chitiet = $_POST['diachi_chitiet'];
            $diachi = $diachi_province . ',' . $diachi_district . ',' . $diachi_wards . ',' . $diachi_chitiet;

            $cccd = $_POST['cccd'];
            $lop = $_POST['lop'];
            $nganh = $_POST['nganh'];
            $hedaotao = $_POST['hedaotao'];
            require_once './Model/sinhvien.php';
            $sinhvien = new sinhvien();
            $check = $sinhvien->insertSinhVien($mssv, $tensv,$email,$password, $ngaysinh, $sodienthoai, $gioitinh, $diachi, $cccd, $lop, $nganh, $hedaotao); 
            if ($check !== false) {
                echo 'success';
                $_SESSION['add_alert']=true;
                echo '<meta http-equiv=refresh content="0; url=index.php?action=sinhvien"/>';
            } else {
                echo 'error';
                include_once "./View/sinhvien/addsinhvien.php";
            }            
        }
        break;

    case 'delete_sinhvien':
        if (isset($_POST['delete_id'])) {
            $idsv = $_POST['delete_id'];    
            $sinhvien = new sinhvien();
            $result = $sinhvien->deleteSinhVien($idsv);

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

    case 'update_sinhvien':
        include_once "./View/sinhvien/editsinhvien.php";
        break;

    case "update_action":
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $idsv = $_POST['idsv'];
            $mssv = $_POST['mssv'];
            $tensv = $_POST['tensv'];
            $email = $_POST['email'];
            $pass = $_POST['mssv'];
            $salfF = "G435#";
            $salfL = "T34a!&";
            $password = md5($salfF . $pass . $salfL);
            $ngaysinh = $_POST['ngaysinh'];
            $sodienthoai = $_POST['sodienthoai'];
            $gioitinh = $_POST['gioitinh'];
            $diachi = $_POST['province'].','.$_POST['district'].','.$_POST['wards'].','.$_POST['diachi_chitiet'];
            $cccd = $_POST['cccd'];
            $lop = $_POST['lop'];
            $nganh = $_POST['nganh'];
            $hedaotao = $_POST['hedaotao'];

            require_once './Model/sinhvien.php';
            $sinhvien = new sinhvien();
            $check = $sinhvien->updateSinhVien($idsv, $mssv, $tensv, $email,$password, $ngaysinh, $sodienthoai, $gioitinh, $diachi, $cccd, $lop, $nganh, $hedaotao);
            if ($check !== false) {
                echo 'success';
                $_SESSION['edit_alert']=true;
                echo '<meta http-equiv=refresh content="0;url=index.php?action=sinhvien"/>';
            } else {
                echo '<script>alert("Cập nhật dữ liệu không thành công");</>';
                include_once "./View/sinhvien/editsinhvien.php";
            }
        }
        break;
    case 'upload_sinhvien':
        include_once "View/sinhvien/uploadsinhvien.php";
        break;
    case 'export':
        include_once "View/sinhvien/export.php";
        break;     
        case 'data':
            include_once "View/sinhvien/data.php";
            break;  
}

?>