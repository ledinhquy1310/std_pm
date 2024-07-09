    <!-- giang vien -->
    <?php
if(isset($_SESSION['idgv'])){
    $id=$_SESSION['idgv'];

require_once "./Model/lichhen.php";
$lichhen_model = new lichhen();
$lichhen_not_send_list = $lichhen_model->getlichhen();
$lichhen_count = $lichhen_model->countlichhenbyid($id);
$lichhen_sended_list = $lichhen_model->getlichhen_sended();
$lichhen_sended_count = $lichhen_model->countlichhen_sended_byid($id);
?>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Danh sách lịch hẹn</title>
        <link rel="stylesheet" href="View/assets/css/lichhen/lichhen.css">

    </head>

    <body>
        <br>
        <div class="nav">
            <p><a href="index.php?action=home"><i class="fa-solid fa-house"></i></a> >
                <a href="index.php?action=lichhen">Tạo lịch hẹn</a> >
                <a href="index.php?action=lichhen&act=insert_lichhen" class="btn-add"><i class="fa-solid fa-plus"></i>
                    Thêm mới</a>
            </p>
        </div>
        <!-- them -->
        <?php if (isset($_SESSION['add_alert']) && $_SESSION['add_alert'] === true) {
        ?>
        <div class="alert alert-success alert-dismissible w-75" style="margin-left:180px" role="alert">
            <b>Thêm lịch hẹn thành công !</b>
            <button type="button" class="btn-close pt-3" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
        unset($_SESSION['add_alert']);
        }
            ?>
        <!-- sua -->
        <?php if (isset($_SESSION['edit_alert']) && $_SESSION['edit_alert'] === true) {
        ?>
        <div class="alert alert-primary alert-dismissible w-75" style="margin-left:180px" role="alert">
            <b>Sửa thông tin lịch hẹn thành công !</b>
            <button type="button" class="btn-close pt-3" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
        unset($_SESSION['edit_alert']);
        }
    ?>
        <h5>Lịch hẹn chưa gửi</h5>
        <?php if($lichhen_count == 0){
        echo "<p class='text-center text-danger'>Không có lịch hẹn chưa gửi</p>";
    } else {?>
        <div class="alert alert-success alert-dismissible" style="width:99%" role="alert">
            <b>Vui lòng đợi nhà trường xét duyệt lịch hẹn !</b>
        </div>
        <table>
            <tr>
                <th>Sinh viên</th>
                <th>Giảng viên</th>
                <th>Ngày Hẹn</th>
                <th>Ghi chú</th>
                <th></th>
            </tr>
            <?php foreach ($lichhen_not_send_list as $lichhen): 
            if ($lichhen['idgv'] == $_SESSION['idgv']) {?>
            <tr>
                <td>
                    <?php echo $lichhen['tensv']; ?>
                </td>
                <td>
                    <?php echo $lichhen['tengv']; ?>
                </td>
                <td>
                    <?php echo $lichhen['ngayhen']; ?>
                </td>
                <td>
                    <?php echo $lichhen['ghichu']; ?>
                </td>
                <td>
                    <a href="index.php?action=lichhen&act=edit&edit_id=<?php echo $lichhen['idlh']; ?>"
                        class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="index.php?action=lichhen&act=delete_lichhen&delete_id=<?php echo $lichhen['idlh']; ?>"
                        class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa lịch hẹn này không ?')">
                        <i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
            <?php } 
    endforeach; ?>

        </table>
        <?php }?>
        <br>
        <h5>Lịch hẹn đã gửi</h5>
        <?php if($lichhen_sended_count == 0){
        echo "<p class='text-center text-danger' style='margin-bottom:240px'>Không có lịch hẹn nào được gửi !</p>";
    } else {?>
        <div class="alert alert-success alert-dismissible" style="width:99%" role="alert">
            <b>Lịch hẹn của bạn với sinh viên đã được nhà trường xét duyệt và gửi đi !</b>
        </div>
        <table class="mb-5">
            <tr>
                <th>Sinh viên</th>
                <th>Giảng viên</th>
                <th>Ngày Hẹn</th>
                <th>Ghi chú</th>
                <th></th>
            </tr>
            <?php foreach ($lichhen_sended_list as $lichhen): 
             if ($lichhen['idgv'] == $_SESSION['idgv']) {?>
            <tr>
                <td>
                    <?php echo $lichhen['tensv']; ?>
                </td>
                <td>
                    <?php echo $lichhen['tengv']; ?>
                </td>
                <td>
                    <?php echo date('d/m/Y H:i:s', strtotime($lichhen['ngayhen'])); ?>
                </td>
                <td>
                    <?php echo $lichhen['ghichu']; ?>
                </td>
                <td>
                    <a href="index.php?action=lichhen&act=delete_lichhen_sended&delete_id=<?php echo $lichhen['idlh']; ?>"
                        class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa lichhen này không ?')">
                        <i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
            <?php } endforeach; ?>
        </table>
        <?php }?>
    </body>
    <!-- sinhvien  -->
    <?php }
    else if(isset($_SESSION['idsv'])){
    $id=$_SESSION['idsv'];
require_once "./Model/lichhen.php";
$lichhen_model = new lichhen();
$lichhen_sended_list = $lichhen_model->getlichhen_sended();
$lichhen_sended_count = $lichhen_model->countlichhen_sended_byidsv($id);
?>
    <link rel="stylesheet" href="View/assets/css/lichhen/lichhen.css">

    <body>
        <br>
        <h5>Lịch hẹn của bạn</h5>
        <?php if($lichhen_sended_count == 0){
        echo "<p class='text-center text-danger' style='margin-bottom:240px'>Bạn không có lịch hẹn nào !</p>";
    } else {?>
        <div class="alert alert-success alert-dismissible" style="width:99%" role="alert">
            <b>Lịch hẹn và ghi chú cụ thể đã được gửi về email, vui lòng kiểm tra email !</b>
        </div>
        <table class="mb-5">
            <tr>
                <th>Sinh viên</th>
                <th>Giảng viên</th>
                <th>Ngày Hẹn</th>
                <th>Ghi chú</th>
            </tr>
            <?php foreach ($lichhen_sended_list as $lichhen): 
             if ($lichhen['idsv'] == $_SESSION['idsv']) {?>
            <tr>
                <td>
                    <?php echo $lichhen['tensv']; ?>
                </td>
                <td>
                    <?php echo $lichhen['tengv']; ?>
                </td>
                <td>
                    <?php echo date('d/m/Y H:i:s', strtotime($lichhen['ngayhen'])); ?>
                </td>
                <td>
                    <?php echo $lichhen['ghichu']; ?>
                </td>
            </tr>
            <?php } endforeach; ?>
        </table>
        <?php }}?>
        <link rel="stylesheet" href="View/assets/css/lichhen/lichhen.css">