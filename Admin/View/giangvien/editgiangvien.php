<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa giảng viên</title>
    <link rel="stylesheet" href="View/assets/css/giangvien/editgiangvien.css">
</head>

<body>
    <?php
    $idgv = $_GET['id'];
    require_once "./Model/giangvien.php";
    $giangvien_model = new giangvien();
    $giangvien_info = $giangvien_model->getGiangVienById($idgv);

    require_once "./Model/khoa.php";
    $khoa_model = new khoa();
    $khoa_list = $khoa_model->getkhoa();

    require_once "./Model/nganh.php";
    $nganh_model = new nganh();
    $khoa_id = $giangvien_info['idkhoa'];
    $nganh_list = $nganh_model->getnganhbykhoa($khoa_id);
    ?>

    <form action="index.php?action=giangvien&act=update_action" method="POST" id="form">
        <h2>Chỉnh sửa giảng viên</h2>
        <input type="hidden" name="idgv" id="idgv" value="<?php echo $idgv; ?>">
        <label for="magv">Mã giảng viên:</label>
        <input type="text" id="magv" name="magv" value="<?php echo $giangvien_info['magv']; ?>"><br>
        <span id="magvError" class="error-text text-danger"></span><br>

        <label for="tengv">Tên giảng viên:</label>
        <input type="text" id="tengv" name="tengv" value="<?php echo $giangvien_info['tengv']; ?>"><br>
        <span id="tengvError" class="error-text text-danger"></span><br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?php echo $giangvien_info['email_gv']; ?>"><br>
        <span id="emailError" class="error-text text-danger"></span><br>

        <label for="trinhdo">Trình độ:</label>
        <select id="trinhdo" name="trinhdo">
            <?php
            require_once "./Model/giangvien.php";
            $trinhdo_model = new giangvien();
            $trinhdo_list = $trinhdo_model->getTrinhDo();
            foreach ($trinhdo_list as $trinhdo) {
                $selected = ($trinhdo['idtd'] == $giangvien_info['trinhdo']) ? "selected" : "";
                echo "<option value='" . $trinhdo['idtd'] . "' $selected>" . $trinhdo['tentd'] . "</option>";
            }
            ?>
        </select><br>
        <span id="trinhdoError" class="error-text text-danger"></span><br>

        <label for="sodienthoai">Số điện thoại:</label>
        <input type="text" id="sodienthoai" name="sodienthoai"
            value="<?php echo $giangvien_info['sodienthoai']; ?>"><br>
        <span id="sodienthoaiError" class="error-text text-danger"></span><br>

        <label for="khoa">Khoa:</label>
        <select id="khoa" name="khoa">
            <?php foreach ($khoa_list as $khoa): ?>
            <option value="<?php echo $khoa['idkhoa']; ?>" <?php if ($giangvien_info['tenkhoa'] == $khoa['tenkhoa'])
                       echo 'selected'; ?>><?php echo $khoa['tenkhoa']; ?>
            </option>
            <?php endforeach; ?>
        </select><br>
        <span id="khoaError" class="error-text text-danger"></span><br>

        <label for="nganh">Ngành:</label>
        <select id="nganh" name="nganh">
            <?php foreach ($nganh_list as $nganh): ?>
            <option value="<?php echo $nganh['idnganh']; ?>" <?php if ($giangvien_info['tennganh'] == $nganh['tennganh'])
                       echo 'selected'; ?>>
                <?php echo $nganh['tennganh']; ?>
            </option>
            <?php endforeach; ?>
        </select><br>
        <span id="nganhError" class="error-text text-danger"></span><br>

        <button type="submit" id="updateBtn" disabled>Cập nhật</button>
        <input type="button" class="btn btn-danger p-2" onclick="window.location.href='index.php?action=giangvien'"
            value="Hủy">
    </form>
</body>
<script src="ajax/get_nganh.js"></script>
<script src="ajax/editgv_valid.js"></script>

</html>