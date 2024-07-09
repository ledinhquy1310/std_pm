<?php
require_once "./Model/doan.php";
require_once "./Model/sinhvien.php";
require_once "./Model/giangvien.php";

if (isset($_GET['id'])) {
    $iddoan = $_GET['id'];
    $doan_model = new Doan();

    $doan_info = $doan_model->getDoanById($iddoan);
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chấm điểm đồ án</title>
</head>

<body>
    <form method="post" action="index.php?action=doan&act=update_points_action">
        <h5>Đồ án: <?php echo $doan_info['tendoan']; ?> </h5>
        <input type="hidden" name="iddoan" value="<?php echo $doan_info['iddoan'] ?>">
        <label for="">Sinh viên thực hiện: <?php echo $doan_info['tensv']; ?> </label>
        <label for="">Lớp: <?php echo $doan_info['tenlop']; ?> </label>
        <label for="">Chuyên ngành: <?php echo $doan_info['tennganh']; ?> </label>
        <label for="">Khoa: <?php echo $doan_info['tenkhoa']; ?> </label>
        <label for="">GV hướng dẫn: <?php echo $doan_info['tengv']; ?> </label>
        <label for="diem">Điểm:</label>
        <input type="number" id="diem" name="diem" min="1" max="10" step="0.1" value="<?php echo $doan_info['diem']; ?>"
            required>
        <button type="submit">Xác nhận</button>
    </form>
</body>
<?php
} else {
    echo '<script>alert("Không tìm thấy đồ án cần chỉnh sửa");</script>';
    echo '<meta http-equiv=refresh content="0;url=index.php?action=doan"/>';
}
?>
<link rel="stylesheet" href="View/assets/css/qldoan/points_doan.css">


</html>