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
            $email = $_POST['txtemail'];
            $pass = $_POST['txtpassword'];
            $salfF = "G435#";
            $salfL = "T34a!&";
            $password = md5($salfF . $pass . $salfL);
            include_once './Model/nhanvien.php';
            $nv = new quanli();
            $check = $nv->getAdmin($email, $pass);
            if ($check !== false) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $check['username'];
                echo "success";
                exit;
            } else {
                echo "error";
                exit;
            }
        }
        break;
    case 'logout':
        session_destroy();
        echo '<script>window.location.href="index.php?action=login";</script>';
        break;

}

?>