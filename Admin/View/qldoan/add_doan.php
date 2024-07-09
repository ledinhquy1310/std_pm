<?php
require_once "./Model/khoa.php";
$khoa_model = new khoa();
$khoa_list = $khoa_model->getkhoa();
require_once "./Model/giangvien.php";
$giangvien_model = new giangvien();
$giangvien_info = $giangvien_model->getGiangVien();
?>
<form id="doan-form" method="post" action="index.php?action=doan&act=insert_action" enctype="multipart/form-data">
    <h2>Thêm mới đồ án</h2>
    <label for="tendoan">Tên đồ án:</label>
    <input type="text" id="tendoan" name="tendoan">
    <span style="color:red" id="tendoanError"></span>
    <br>

    <label for="madoan">Mã đồ án:</label>
    <input type="text" id="madoan" name="madoan">
    <span style="color:red" id="madoanError"></span>
    <br>

    <label for="linkdoan">Link đồ án:</label>
    <input type="text" id="linkdoan" name="linkdoan" class="form-control">
    <span style="color:red" id="linkdoanError"></span>
    <br>

    <label for="hinhanh">Hình ảnh:</label>
    <input type="file" id="hinhanh" name="hinhanh" class="form-control" accept=".jpg, .jpeg, .png, .gif"
        onchange="previewImage(event)">
    <span style="color:red" id="hinhanhError"></span>
    <br>
    <img id="preview" src="#" alt="Ảnh xem trước" style="max-width: 200px; max-height: 200px; display: none;">

    <label for="file">File báo cáo:</label>
    <input type="file" id="file" name="filename" class="form-control" accept=".doc, .docx">
    <span style="color:red" id="fileError"></span>
    <br>

    <label for="khoa">Khoa:</label>
    <select id="khoa" name="khoa">
        <option value="">--Chọn Khoa--</option>
        <?php foreach ($khoa_list as $khoa): ?>
        <option value="<?php echo $khoa['idkhoa']; ?>"><?php echo $khoa['tenkhoa']; ?></option>
        <?php endforeach; ?>
    </select>
    <span style="color:red" id="khoaError"></span>
    <br>

    <label for="nganh">Ngành:</label>
    <select id="nganh" name="nganh">
        <option value="">--Vui lòng chọn khoa--</option>
    </select>
    <span style="color:red" id="nganhError"></span>
    <br>

    <label for="lop">Lớp:</label>
    <select id="lop" name="lop">
        <option value="">--Vui lòng chọn ngành--</option>
    </select>
    <span style="color:red" id="lopError"></span>
    <br>

    <label for="sinhvien">Sinh viên:</label>
    <select id="sinhvien" name="sinhvien">
        <option value="">--Vui lòng chọn lớp--</option>
    </select>
    <span style="color:red" id="sinhvienError"></span>
    <br>

    <label for="gvhd">Giáo viên hướng dẫn:</label>
    <select id="gvhd" name="gvhd">
        <option value="">--Giảng viên--</option>
        <?php foreach ($giangvien_info as $gv): ?>
        <option value="<?php echo $gv['idgv']; ?>"><?php echo $gv['tengv']; ?></option>
        <?php endforeach; ?>
    </select>
    <span style="color:red" id="gvhdError"></span>
    <br>
    <br>

    <input class="btn btn-success" type="submit" value="Thêm mới">
</form>
<script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('preview');
        output.src = reader.result;
        output.style.display = 'block';
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>

<link rel="stylesheet" href="View/assets/css/qldoan/add_doan.css">
<script src="ajax/get_lop.js"></script>
<script src="ajax/get_nganh.js"></script>
<script src="ajax/get_sinhvien.js"></script>
<script src="ajax/add_doan_valid.js"></script>