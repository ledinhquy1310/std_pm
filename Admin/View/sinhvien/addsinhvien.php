<?php
require_once "./Model/hedaotao.php";
$hdt_model = new hedaotao();
$hdt_list = $hdt_model->getHeDaoTao();
require_once "./Model/nganh.php";
$nganh_model = new nganh();
$nganh_list = $nganh_model->getNganh();
require_once "./Model/diachi.php";
$diachi_model = new diachi();
$diachi_list = $diachi_model->getTinh();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sinh viên</title>
    <link rel="stylesheet" href="View/assets/css/sinhvien/addsinhvien.css">

</head>

<body>
    <form style="margin-left:200px" action="index.php?action=sinhvien&act=insert_action" method="POST">
        <h2>Thêm sinh viên</h2>
        <div class="row">
            <!-- cột trái -->
            <div class="col-6">

                <label for="mssv">MSSV:</label>
                <input type="number" id="mssv" name="mssv"><br>
                <span id="mssvError" style="color: red;"></span><br>

                <label for="email">Email sinh viên:</label>
                <input type="email" id="email" name="email"><br>
                <span id="emailError" style="color: red;"></span><br>

                <label for="sodienthoai">Số điện thoại:</label>
                <input type="text" id="sodienthoai" name="sodienthoai"><br>
                <span id="sodienthoaiError" style="color: red;"></span><br>

                <label>Giới tính:</label>
                <input type="radio" id="nam" name="gioitinh" value="Nam">
                Nam
                <input type="radio" id="nu" name="gioitinh" value="Nữ">
                Nữ
                <br>
                <span id="gioitinhError" style="color: red;"></span><br>

                <label for="hedaotao">Hệ đào tạo:</label>
                <select id="hedaotao" name="hedaotao">
                    <option value="">--Chọn hệ đào tạo--</option>
                    <?php foreach ($hdt_list as $hdt): ?>
                    <option value="<?php echo $hdt['idhdt']; ?>">
                        <?php echo $hdt['tenhdt']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <span id="hedaotaoError" style="color: red;"></span><br>

                <label for="nganh">Ngành</label>
                <select id="nganh" name="nganh">
                    <option value="">--Chọn ngành--</option>
                    <?php foreach ($nganh_list as $nganh): ?>
                    <option value="<?php echo $nganh['idnganh']; ?>">
                        <?php echo $nganh['tennganh']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <span id="nganhError" style="color: red;"></span><br>

                <label for="lop">Lớp</label>
                <select id="lop" name="lop">
                    <option value="">--Vui lòng chọn ngành và hệ đào tạo--</option>
                </select>
                <br>
                <span id="lopError" style="color: red;"></span><br>
            </div>

            <!-- cột phải -->
            <div class="col-6">

                <label for="tensv">Tên sinh viên:</label>
                <input type="text" id="tensv" name="tensv"><br>
                <span id="tensvError" style="color: red;"></span><br>

                <label for="ngaysinh">Ngày sinh:</label>
                <input type="date" id="ngaysinh" name="ngaysinh"><br>
                <span id="ngaysinhError" style="color: red;"></span><br>

                <label for="cccd">CCCD:</label>
                <input type="text" id="cccd" name="cccd"><br>
                <span id="cccdError" style="color: red;"></span><br>

                <!-- Địa chỉ -->
                <label for="diachi">Địa chỉ:</label>
                <select id="province" name="province">
                    <option value="">--Chọn Tỉnh/Thành phố--</option>
                    <?php foreach ($diachi_list as $diachi): ?>
                    <option value="<?php echo $diachi['province_id']; ?>">
                        <?php echo $diachi['name']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <br>
                <span id="tinhError" style="color: red;"></span><br>

                <select id="district" name="district">
                    <option value="">--Chọn quận/huyện--</option>
                </select>
                <br>

                <span id="quanError" style="color: red;"></span><br>

                <select id="wards" name="wards">
                    <option value="">--Chọn phường/xã--</option>
                </select>
                <br>
                <span id="xaError" style="color: red;"></span><br>

                <input type="text" name="diachi_chitiet" id="diachi_chitiet" placeholder="Tổ/ấp/đường">
                <span id="dcchitietError" style="color: red;"></span><br>
            </div>
        </div>
        <br>
        <button type="submit" name="add" id="submitBtn">Thêm sinh viên</button>
    </form>
    <script src="ajax/get_lop_by_nganh_hdt.js"></script>
    <script src="ajax/get_diachi.js"></script>
    <script src="ajax/addsv_valid.js"></script>
</body>

</html>