<?php
if (isset($_GET['id'])) {
    $idsv = $_GET['id'];
    require_once "./Model/sinhvien.php";
    $sinhvien_model = new sinhvien();
    $sinhvien_info = $sinhvien_model->getSinhVienById($idsv);
   
    require_once "./Model/hedaotao.php";
    $hdt_model = new hedaotao();
    $hdt_list = $hdt_model->getHeDaoTao();
    require_once './Model/connect.php';
    require_once "./Model/nganh.php";
    $nganh_model = new nganh();
    $nganh_list = $nganh_model->getNganh();
    require_once "./Model/diachi.php";
    $diachi_model = new diachi();
    $tinh_list = $diachi_model->getTinh();
    require_once "./Model/lop.php";
    $lop_model = new lop();
    $nganh_id = $sinhvien_info['nganh'];
    $lop_list = $lop_model->getLopByNganh($nganh_id);

} else {
    header("Location: index.php?action=sinhvien");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sinh viên</title>
    <link rel="stylesheet" href="View/assets/css/sinhvien/editsinhvien.css">
</head>

<body>
    <form style="margin-left:200px" action="index.php?action=sinhvien&act=update_action" method="POST" id="form">
        <h2>Chỉnh sửa sinh viên</h2>
        <div class="row">
            <!-- cột trái -->
            <div class="col-6">
                <input type="hidden" name="idsv" id="idsv" value="<?php echo $sinhvien_info['idsv']?>">
                <label for="mssv">MSSV:</label>
                <input type="number" id="mssv" name="mssv" value="<?php echo $sinhvien_info['mssv']; ?>"><br>
                <span id="mssvError" style="color: red;"></span><br>

                <label for="email">Email sinh viên:</label>
                <input type="email" id="email" name="email" value="<?php echo $sinhvien_info['email']; ?>"><br>
                <span id="emailError" style="color: red;"></span><br>

                <label for="sodienthoai">Số điện thoại:</label>
                <input type="text" id="sodienthoai" name="sodienthoai"
                    value="<?php echo $sinhvien_info['sodienthoai']; ?>"><br>
                <span id="sodienthoaiError" style="color: red;"></span><br>

                <label>Giới tính:</label>
                <input type="radio" id="nam" name="gioitinh" value="Nam"
                    <?php if($sinhvien_info['gioitinh']=='Nam'){echo 'checked';};?>>
                Nam
                <input type="radio" id="nu" name="gioitinh" value="Nữ"
                    <?php if($sinhvien_info['gioitinh']=='Nữ'){echo 'checked';};?>>
                Nữ
                <br>
                <span id="gioitinhError" style="color: red;"></span><br>

                <label for="hedaotao">Hệ đào tạo:</label>
                <select id="hedaotao" name="hedaotao">
                    <option value="">--Chọn hệ đào tạo--</option>
                    <?php foreach ($hdt_list as $hdt): ?>
                    <option value="<?php echo $hdt['idhdt']; ?>" <?php if ($sinhvien_info['tenhdt'] == $hdt['tenhdt'])
                       echo 'selected'; ?>>
                        <?php echo $hdt['tenhdt']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <span id="hedaotaoError" style="color: red;"></span><br>

                <label for="nganh">Ngành</label>
                <select id="nganh" name="nganh">
                    <option value="">--Chọn ngành--</option>
                    <?php foreach ($nganh_list as $nganh): ?>
                    <option value="<?php echo $nganh['idnganh']; ?>" <?php if ($sinhvien_info['tennganh'] == $nganh['tennganh'])
                       echo 'selected'; ?>>
                        <?php echo $nganh['tennganh']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <span id="nganhError" style="color: red;"></span><br>

                <label for="lop">Lớp</label>
                <select id="lop" name="lop">
                    <option value="">--Vui lòng chọn ngành và hệ đào tạo--</option>
                    <?php foreach ($lop_list as $lop): ?>
                    <option value="<?php echo $lop['idlop']; ?>" <?php if ($sinhvien_info['tenlop'] == $lop['tenlop'])
                       echo 'selected'; ?>>
                        <?php echo $lop['tenlop']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <br>
                <span id="lopError" style="color: red;"></span><br>
            </div>

            <!-- cột phải -->
            <div class="col-6">

                <label for="tensv">Tên sinh viên:</label>
                <input type="text" id="tensv" name="tensv" value="<?php echo $sinhvien_info['tensv']?>"><br>
                <span id="tensvError" style="color: red;"></span><br>

                <label for="ngaysinh">Ngày sinh:</label>
                <input type="date" id="ngaysinh" name="ngaysinh" value="<?php echo $sinhvien_info['ngaysinh']?>"><br>
                <span id="ngaysinhError" style="color: red;"></span><br>

                <label for="cccd">CCCD:</label>
                <input type="text" id="cccd" name="cccd" value="<?php echo $sinhvien_info['cccd']?>"><br>
                <span id="cccdError" style="color: red;"></span><br>

                <!-- Địa chỉ -->
                <label for="diachi">Địa chỉ:</label>
                <?php 
                $diachi = $sinhvien_info['diachi'];
                $diachi_parts = explode(',', $diachi,4);
                $province_id = $diachi_parts[0];
                $district_id = $diachi_parts[1];
                $wards_id = $diachi_parts[2];
                $diachi_chitiet = $diachi_parts[3];
                $quan_list = $diachi_model->getQuanbyTinh($province_id);
                $xa_list = $diachi_model->getXabyQuan($district_id);
                ?>
                <select id="province" name="province">
                    <option value="">--Chọn Tỉnh/Thành phố--</option>
                    <?php foreach ($tinh_list as $tinh): ?>
                    <option value="<?php echo $tinh['province_id']; ?>" <?php if ($province_id == $tinh['province_id'])
                       echo 'selected'; ?>>
                        <?php echo $tinh['name']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <br>
                <span id="tinhError" style="color: red;"></span><br>

                <select id="district" name="district">
                    <option value="">--Chọn quận/huyện--</option>
                    <?php foreach ($quan_list as $quan): ?>
                    <option value="<?php echo $quan['district_id']; ?>" <?php  if ($district_id == $quan['district_id'])
                       echo 'selected'; ?>>
                        <?php echo $quan['name']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <br>
                <span id="quanError" style="color: red;"></span><br>

                <select id="wards" name="wards">
                    <option value="">--Chọn phường/xã--</option>
                    <?php foreach ($xa_list as $xa): ?>
                    <option value="<?php echo $xa['wards_id']; ?>" <?php if ($wards_id == $xa['wards_id'])
                       echo 'selected'; ?>>
                        <?php echo $xa['name']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <br>
                <span id="xaError" style="color: red;"></span><br>

                <input type="text" name="diachi_chitiet" id="diachi_chitiet" placeholder="Tổ/ấp/đường"
                    value="<?php echo $diachi_chitiet?>">
                <span id="dcchitietError" style="color: red;"></span><br>


            </div>
        </div>
        <br>
        <button type="submit" name="add" id="updateBtn" disabled>Chỉnh sửa sinh viên</button>
        <input type="button" class="btn btn-danger p-2" onclick="window.location.href='index.php?action=sinhvien'"
            value="Hủy">
    </form>
    <script src="ajax/get_lop_by_nganh_hdt.js"></script>
    <script src="ajax/get_diachi.js"></script>
    <script src="ajax/editsv_valid.js"></script>
</body>


</html>