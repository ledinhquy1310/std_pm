<?php
$act = "quanli";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}

switch ($act) {
    case 'quanli':
        include_once "View/quanli/quanli.php";
        break;

    case 'insert_quanli':
        include_once "./View/quanli/addquanli.php";
        break;

    case 'insert_action':
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            require_once './Model/nhanvien.php';
            $quanli = new quanli();
            $email_exists = $quanli->checkEmail($email);
            if ($email_exists) {
                echo '<script>alert("Email đã tồn tại. Vui lòng sử dụng email khác.");</script>';
                include_once "./View/quanli/addquanli.php";
            } else {
                $check = $quanli->insertQuanLi($username, $email, $password);
                if ($check !== false) {
                    echo '<script>alert("Thêm quản lí thành công");</script>';
                    echo '<meta http-equiv=refresh content="0;url=index.php?action=quanli"/>';
                } else {
                    echo '<script>alert("Thêm quản lí không thành công");</script>';
                    include_once "./View/quanli/addquanli.php";
                }
            }
        }
        break;
    case 'update_quanli':
        include_once "./View/quanli/editquanli.php";
        break;
    case 'update_action':
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $idql = $_POST['idql'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password_new'];

            require_once './Model/nhanvien.php';
            $quanli = new quanli();
            $check = $quanli->updateQuanLi($idql, $username, $email, $password);

            if ($check !== false) {
                echo '<script>alert("Cập nhật quản lí thành công");</script>';
                echo '<meta http-equiv=refresh content="0;url=index.php?action=quanli"/>';
            } else {
                echo '<script>alert("Cập nhật quản lí không thành công");</script>';
                include_once "./View/quanli/editquanli.php";
            }
        }
        break;

    case 'delete_quanli':
        if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['delete_id'])) {
            $delete_id = $_GET['delete_id'];
            require_once './Model/nhanvien.php';
            $quanli = new quanli();
            $result = $quanli->deleteQuanLi($delete_id);

            if ($result !== false) {
                echo '<script>alert("Xóa quản lí thành công");</script>';
                echo '<meta http-equiv=refresh content="0;url=index.php?action=quanli"/>';
            } else {
                echo '<script>alert("Xóa quản lí không thành công");</script>';
            }
        }
        break;

}
?>