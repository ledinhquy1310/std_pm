<?php
if (isset($_GET['send_id'])) {
    $idlh = $_GET['send_id'];
    require_once "./Model/lichhen.php";
    $lichhen_model = new lichhen();
    $lichhen_list = $lichhen_model->getlichhenbyid($idlh);
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gửi lịch hẹn</title>
    <link rel="stylesheet" href="View/assets/css/lichhen/sendlichhen.css">

</head>

<body>

    <table>
        <tr>
            <th colspan="2">
                <h2>Thông tin lịch hẹn</h2>
            </th>
        </tr>
        <tr>
            <th>Tên sinh viên</th>
            <td><?php echo $lichhen_list['tensv']; ?></td>
        </tr>
        <tr>
            <th>Email sinh viên</th>
            <td><?php echo $lichhen_list['email']; ?></td>
        </tr>
        <tr>
            <th>Tên giảng viên</th>
            <td><?php echo $lichhen_list['tengv']; ?></td>
        </tr>
        <tr>
            <th>Email giảng viên</th>
            <td><?php echo $lichhen_list['email_gv']; ?></td>
        </tr>
        <tr>
            <th>Ngày hẹn</th>
            <td><?php echo $lichhen_list['ngayhen']; ?></td>
        </tr>
        <tr>
            <th>Ghi chú</th>
            <td><?php echo $lichhen_list['ghichu']; ?></td>
        </tr>
        <tr>
            <td colspan="2" style="border:none;text-align:right">
                <input type="button" class="btn btn-success p-2"
                    onclick="window.location.href='index.php?action=lichhen'" value="Trở về">
                <a class="btn btn-info p-2"
                    href="index.php?action=lichhen&act=send_action&id=<?php echo $lichhen_list['idlh']; ?>">Gửi</a>
            </td>
        </tr>
    </table>

</body>

</html>
<?php
} else {
    echo "Không tìm thấy.";
}
?>