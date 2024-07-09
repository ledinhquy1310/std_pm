<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm giảng viên</title>
    <link rel="stylesheet" href="View/assets/css/giangvien/addgiangvien.css">
</head>

<?php
require_once "./Model/khoa.php";
$khoa_model = new khoa();
$khoa_list = $khoa_model->getKhoa();
?>

<body>
    <form style="margin-left:220px" action="index.php?action=giangvien&act=insert_action" method="POST" id="form">
        <h2>Thêm giảng viên</h2>
        <label for="magv">Mã giảng viên:</label>
        <input type="text" id="magv" name="magv">
        <span id="magvError" class="text-danger error-text"></span>

        <label for="tengv">Tên giảng viên:</label>
        <input type="text" id="tengv" name="tengv">
        <span id="tengvError" class="text-danger error-text"></span>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email">
        <span id="emailError" class="text-danger error-text"></span>

        <label for="trinhdo">Trình độ:</label>
        <select id="trinhdo" name="trinhdo">
            <option value="">--Chọn Trình Độ--</option>
            <?php
            require_once "./Model/giangvien.php";
            $trinhdo_model = new giangvien();
            $trinhdo_list = $trinhdo_model->getTrinhdo();
            foreach ($trinhdo_list as $trinhdo) {
                echo "<option value='" . $trinhdo['idtd'] . "'>" . $trinhdo['tentd'] . "</option>";
            }
            ?>
        </select>
        <span id="trinhdoError" class="text-danger error-text"></span>

        <label for="sodienthoai">Số điện thoại:</label>
        <input type="text" id="sodienthoai" name="sodienthoai">
        <span id="sodienthoaiError" class="text-danger error-text"></span>

        <br>
        <label for="khoa">Khoa:</label>
        <select id="khoa" name="khoa">
            <option value="">--Chọn Khoa--</option>
            <?php foreach ($khoa_list as $khoa): ?>
            <option value="<?php echo $khoa['idkhoa']; ?>">
                <?php echo $khoa['tenkhoa']; ?>
            </option>
            <?php endforeach; ?>
        </select>
        <span id="khoaError" class="text-danger error-text"></span>

        <label for="nganh">Ngành:</label>
        <select id="nganh" name="nganh">
            <option value="">--Chọn Khoa trước khi chọn ngành--</option>
        </select>
        <span id="nganhError" class="text-danger error-text"></span>
        <br>
        <br>
        <button type="submit" value="Thêm" name="add">Thêm</button>
    </form>

    <script src="ajax/addgv_valid.js"></script>
    <script src="ajax/get_nganh.js"></script>
</body>

</html>