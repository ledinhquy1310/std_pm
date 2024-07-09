<?php
require './Model/class.phpmailer.php';
$act = 'forget';
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}
switch ($act) {
    case 'forget':
        include_once "./View/forgetpassword.php";
        break;
    case 'forget_action':
        if (isset($_POST['submit_email'])) {
            $email = $_POST['email'];
            $_SESSION['email'] = array();
            require_once "./Model/sinhvien.php";
            $sv = new sinhvien();
            $checksv = $sv->checkEmail($email)->rowCount();
            if ($checksv > 0) {
                $code = random_int(1000, 1000000);
                $item = array(
                    'id' => $code,
                    'email' => $email,
                );
                $_SESSION['email'][] = $item; 
                $mail = new PHPMailer(true);
                $mail->CharSet = "utf-8";

                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'dinhquyle1055@gmail.com';
                    $mail->Password = 'erah vebi pzfr rimf';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;

                    $mail->setFrom('dinhquyle1055@gmail.com', 'Nhà Trường');
                    $mail->addAddress($email);

                    $mail->isHTML(true);
                    $mail->Subject = 'Reset Password';
                    $mail->Body ='Cấp lại mã code ' . $code;
                    $mail->send();
                    echo '<script>alert("Đã gửi code thành công.");</script>';
                    include_once "./View/resetpw.php";

                } catch (Exception $e) {
                    echo "Không gửi được: {$mail->ErrorInfo}";
                }
            } else {
                echo '<script> alert("Địa chỉ email ko tồn tại");</script>';
                include "./View/forgetpassword.php";
            }
        }
        break;
        case 'resetpass':
            if (isset($_POST['submit_password'])) {
                $pass = $_POST['password'];
                $code = $_POST['code'];
                $found = false;
                foreach ($_SESSION['email'] as $key => $item) {
                    if ($item['id'] == $code) {
                        $emailold = $item['email'];
                        require_once "./Model/sinhvien.php";
                        $sv = new sinhvien();
                        $sv->updatePass($emailold, $pass);
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    echo '<script> alert("Mã code không hợp lệ.");</script>';
                    include "./View/resetpw.php";
                    exit; 
                }
            } else {
                echo '<script> alert("Lỗi: Không có dữ liệu gửi đi.");</script>';
                include "./View/resetpw.php";
                exit; 
            }
            echo '<script> alert("Cập nhật mật khẩu mới thành công");</script>';
            echo '<meta http-equiv="refresh" content="0;url=index.php?action=login">';
            break;
        
}

?>