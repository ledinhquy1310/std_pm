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
            
    case 'send':
        if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['send_id'])) {
            $idlh = $_GET['send_id'];
            require_once './Model/lichhen.php';
            $lichhen_model = new lichhen();
            $lichhen_info = $lichhen_model->getlichhenbyid($idlh);
            include_once "./View/lichhen/sendlichhen.php";
        } else {
            echo '<script>alert("Mã lịch hẹn không được cung cấp.");</script>';
            echo '<meta http-equiv=refresh content="0;url=index.php?action=lichhen"/>';
        }
        break;
    case 'send_action':

        if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id'])) {
            $idlh = $_GET['id'];
            require_once './Model/lichhen.php';
            $lichhen_model = new lichhen();
            $lichhen_info = $lichhen_model->getlichhenbyid($idlh);

            // Kiểm tra xem thông tin lịch hẹn có tồn tại không
            if ($lichhen_info) {
                // Lấy thông tin sinh viên
                $email = $lichhen_info['email'];
                $email_gv=$lichhen_info['email_gv'];
                $ngayhen = $lichhen_info['ngayhen'];
                $sinhvien = $lichhen_info['tensv'];
                $giangvien = $lichhen_info['tengv'];
                $ghichu = $lichhen_info['ghichu'];

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
                    $mail->Subject = 'Thư báo lịch hẹn';
                    $mail->Body =
                        'Thông báo!' . '<br>'
                        . 'Gửi sinh viên ' . $sinhvien . '<br>'
                        . 'Lịch hẹn nộp đồ án của bạn với giảng viên ' . $giangvien . ' vào lúc ' . $ngayhen . ' đã được xác nhận! <br>'
                        . 'Vui lòng chuẩn bị đầy đủ ( laptop cá nhân, báo cáo,... ) và đi đúng thời gian quy định ! <br>'
                        . 'Đây là email tự động, vui lòng không trả lời email này ! <br>'
                        . 'Ghi chú: ' . $ghichu;
                    $mail->send();
                    
                    $mail->clearAddresses();
                    $mail->addAddress($email_gv);
                    $mail->Body = 'Thông báo!' . '<br>'
                    . 'Kính gửi giảng viên ' . $giangvien . '<br>'
                    . 'Lịch hẹn với sinh viên ' . $sinhvien . ' vào lúc ' . $ngayhen . ' đã được xác nhận! <br>'
                    . 'Vui lòng thu xếp công việc để có thể đến đúng giờ <br>'
                    . 'Đây là email tự động, vui lòng không trả lời email này ! <br>'
                    . 'Ghi chú: ' . $ghichu;
                    $mail->send();

                    $lichhen_model->moveToSended($idlh);
                    $_SESSION['send']=true;
                    echo '<meta http-equiv=refresh content="0;url=index.php?action=lichhen"/>';

                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                echo '<script>alert("Không tìm thấy thông tin lịch hẹn.");</script>';
                echo '<meta http-equiv=refresh content="0;url=index.php?action=lichhen"/>';
            }
        } else {
            echo '<script>alert("Mã lịch hẹn không được cung cấp.");</script>';
            echo '<meta http-equiv=refresh content="0;url=index.php?action=lichhen"/>';
        }
        break;
}
?>