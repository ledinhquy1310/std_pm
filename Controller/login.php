<?php
$act = "login";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}
switch ($act) {
    case 'login':
        include_once "./View/login.php";
        break;
    case 'login_action':
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $mssv = $_POST['taikhoan'];
            $magv=$_POST['taikhoan'];
            $pass = $_POST['password'];
            $role = $_POST['role'];
            $salfF = "G435#";
            $salfL = "T34a!&";
            $password = md5($salfF . $pass . $salfL);
            if ($role == 'sv') {
            include_once './Model/sinhvien.php';
            $sv = new sinhvien();
            $check = $sv->getSinhVien($mssv, $password);
            if ($check !== false) {
                $_SESSION['loggedUser'] = true;
                $_SESSION['alert'] = true;
                $_SESSION['tensv'] = $check['tensv'];
                $_SESSION['idsv'] = $check['idsv'];
                $_SESSION['mssv'] = $check['mssv'];
                $_SESSION['email'] = $check['email'];
                $_SESSION['sodienthoai'] = $check['sodienthoai'];
                $_SESSION['ngaysinh'] = $check['ngaysinh'];
                $_SESSION['diachi'] = $check['diachi'];
                $_SESSION['tenlop'] = $check['tenlop'];
                $_SESSION['tennganh'] = $check['tennganh'];
                $_SESSION['tenhdt'] = $check['tenhdt'];
                echo "success";
                exit;
            } else {
                echo "error";
                exit;
            }
        }
        else if($role=='gv'){
            include_once './Model/giangvien.php';
            $gv = new giangvien();
            $checkgv = $gv->getGiangVienAcc($magv, $password);
            if ($checkgv !== false) {
                $_SESSION['loggedUser'] = true;
                $_SESSION['alert'] = true;
                $_SESSION['idgv'] = $checkgv['idgv'];
                $_SESSION['magv'] = $checkgv['magv'];
                $_SESSION['tengv'] = $checkgv['tengv'];
                $_SESSION['email_gv'] = $checkgv['email_gv'];
                $_SESSION['sodienthoai'] = $checkgv['sodienthoai'];
                $_SESSION['tennganh'] = $checkgv['tennganh'];
                $_SESSION['tenkhoa'] = $checkgv['tenkhoa'];
                $_SESSION['tentd'] = $checkgv['tentd'];
                echo "success";
                exit;
            } else {
                echo "error";
                exit;
            }
        }
        }
        break;
        
        case 'logout':
        session_destroy();
        echo '<script>window.location.href="index.php?action=login";</script>';
        break;

        case 'changepassword':
            $old_password = $_POST['old_password'];
            $pass= $_POST['new_password'];
            $salfF = "G435#";
            $salfL = "T34a!&";
            $new_password = md5($salfF . $pass . $salfL);
            $confirm_password = $_POST['confirm_password'];
            if (isset($_SESSION['mssv'])) {
                include_once './Model/sinhvien.php';
                $sv = new sinhvien();
                $mssv = $_SESSION['mssv'];
                if ($sv->checkPassword($mssv, $old_password)) {
                    if ($sv->changePassSV($mssv, $new_password)) {
                        echo "<script>alert('Thay đổi mật khẩu thành công.');</script>";
                        echo '<meta http-equiv="refresh" content="0;url=./index.php?action=home"/>';
                    } else {
                        echo "<script>alert('Thay đổi mật khẩu thất bại.');</script>";
                        echo '<meta http-equiv="refresh" content="0;url=./index.php?action=home"/>';
                    }
                } else {
                    echo "<script>alert('Mật khẩu cũ không đúng.');</script>";
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=home"/>';
                }
            } elseif (isset($_SESSION['magv'])) {
                include_once './Model/giangvien.php';
                $gv = new giangvien();
                $magv = $_SESSION['magv'];
                if ($gv->checkPassword($magv, $old_password)) {
                    if ($gv->changePassGV($magv, $new_password)) {
                        echo "<script>alert('Thay đổi mật khẩu thành công.');</script>";
                        echo '<meta http-equiv="refresh" content="0;url=./index.php?action=home"/>';
                    } else {
                        echo "<script>alert('Thay đổi mật khẩu thất bại.');</script>";
                        echo '<meta http-equiv="refresh" content="0;url=./index.php?action=home"/>';
                    }
                } else {
                    echo "<script>alert('Mật khẩu cũ không đúng.');</script>";
                    echo '<meta http-equiv="refresh" content="0;url=./index.php?action=home"/>';
                }
        }
            break;
        
}

?>