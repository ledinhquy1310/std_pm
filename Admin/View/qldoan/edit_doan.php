<?php
require_once "./Model/doan.php";
require_once "./Model/giangvien.php";
require_once "./Model/khoa.php";
$khoa_model = new khoa();
$khoa_list = $khoa_model->getkhoa();
if (isset($_GET['id'])) {
    $iddoan = $_GET['id'];
    $doan_model = new Doan();
    $giangvien_model = new GiangVien();
    $doan_info = $doan_model->getDoanById($iddoan);
    $giangvien_info = $giangvien_model->getGiangVien();
    require_once "./Model/nganh.php";
    $nganh_model = new nganh();
    $khoa_id = $doan_info['idkhoa'];
    $nganh_list = $nganh_model->getnganhbykhoa($khoa_id);

    require_once "./Model/lop.php";
    $lop_model = new lop();
    $nganh_id = $doan_info['idnganh'];
    $lop_list = $lop_model->getLopByNganh($nganh_id);

    require_once "./Model/sinhvien.php";
    $sinhvien_model = new sinhvien();
    $lop_id = $doan_info['idlop'];
    $sinhvien_list = $sinhvien_model->getSinhVienByLop($lop_id);
    ?>
<div>
    <form method="post" action="index.php?action=doan&act=update_action" enctype="multipart/form-data" id="form">
        <h2>Chỉnh sửa đồ án</h2>
        <input type="hidden" name="iddoan" id="iddoan" value="<?php echo $iddoan; ?>">
        <label for="tendoan">Tên đồ án:</label>
        <input type="text" id="tendoan" name="tendoan" value="<?php echo $doan_info['tendoan']; ?>"><br>
        <span style="color:red" id="tendoanError"></span>

        <label for=" madoan">Mã đồ án:</label>
        <input type="text" id="madoan" name="madoan" value="<?php echo $doan_info['madoan']; ?>"><br>
        <span style="color:red" id="madoanError"></span>
        <br>
        <label for="linkdoan">Link đồ án:</label>
        <input type="text" id="linkdoan" name="linkdoan" value="<?php echo $doan_info['linkdoan']; ?>"><br>
        <span style="color:red" id="linkdoanError"></span>

        <label for="hinhanh">Hình ảnh :</label>
        <input type="file" id="hinhanh" name="hinhanh" class="form-control file-input" accept=".jpg, .jpeg, .png, .gif"
            onchange="previewImage(event)">
        <div class="file-container">
            <label for="hinhanh" class="file-label"><i class="fa-solid fa-upload"></i> Đổi hình ảnh</label>
            <img id="preview" src="View/assets/img/<?php echo $doan_info['hinhanh']; ?>" alt="Ảnh xem trước"
                style="max-width: 200px; max-height: 200px;margin-left:10px; <?php echo $doan_info['hinhanh'] ? 'display: block;' : 'display: none;'; ?>">
        </div>
        <span style="color:red" id="hinhanhError"></span>
        <br>

        <label for="filename">File báo cáo:</label>
        <input type="file" id="filename" name="filename" class="form-control file-input" accept=".doc, .docx"
            onchange="updateFileName(event)">
        <div class="file-container">
            <label for="filename" class="file-label"><i class="fa-solid fa-upload"></i> Đổi file</label>
            <span id="file-name" class="ms-2"><?php echo $doan_info['baocao']; ?></span>
        </div>
        <span style="color:red" id="fileError"></span>

        <br>

        <label for="khoa">Khoa:</label>
        <select id="khoa" name="khoa">
            <option value="">--Chọn Khoa--</option>
            <?php foreach ($khoa_list as $khoa): ?>
            <option value="<?php echo $khoa['idkhoa']; ?>" <?php if ($doan_info['tenkhoa'] == $khoa['tenkhoa'])
                           echo 'selected'; ?>><?php echo $khoa['tenkhoa']; ?>
            </option>
            <?php endforeach; ?>
        </select>
        <span style="color:red" id="khoaError"></span>
        <br>
        <label for="nganh">Ngành:</label>
        <select id="nganh" name="nganh">
            <option value="">--Vui lòng chọn ngành--</option>
            <?php foreach ($nganh_list as $nganh): ?>
            <option value="<?php echo $nganh['idnganh']; ?>" <?php if ($doan_info['tennganh'] == $nganh['tennganh'])
                           echo 'selected'; ?>><?php echo $nganh['tennganh']; ?>
            </option>
            <?php endforeach; ?>
        </select>
        <span style="color:red" id="nganhError"></span>
        <br>

        <label for="lop">Lớp:</label>
        <select id="lop" name="lop">
            <option value="">--Vui lòng chọn lớp--</option>
            <?php foreach ($lop_list as $lop): ?>
            <option value="<?php echo $lop['idlop']; ?>" <?php if ($doan_info['tenlop'] == $lop['tenlop'])
                           echo 'selected'; ?>><?php echo $lop['tenlop']; ?>
            </option>
            <?php endforeach; ?>
        </select>
        <span style="color:red" id="lopError"></span>
        <br>
        <label for="sinhvien">Sinh viên:</label>
        <select id="sinhvien" name="sinhvien">
            <option value="">--Vui lòng chọn lớp--</option>
            <?php foreach ($sinhvien_list as $sinhvien): ?>
            <option value="<?php echo $sinhvien['idsv']; ?>" <?php if ($doan_info['tensv'] == $sinhvien['tensv'])
                           echo 'selected'; ?>>
                <?php echo $sinhvien['tensv']; ?>
            </option>
            <?php endforeach; ?>
        </select>
        <span style="color:red" id="sinhvienError"></span>
        <br>
        <label for="gvhd">Giáo viên hướng dẫn:</label>
        <select id="gvhd" name="gvhd">
            <option value="">--Chọn giáo viên--</option>
            <?php foreach ($giangvien_info as $gv): ?>
            <option value="<?php echo $gv['idgv']; ?>" <?php if ($gv['idgv'] == $doan_info['gvhd'])
                           echo "selected"; ?>>
                <?php echo $gv['tengv']; ?>
            </option>
            <?php endforeach; ?>
        </select>
        <span style="color:red" id="gvhdError"></span>

        <input class="btn btn-success" type="submit" id="updateBtn" value="Cập nhật" disabled>
        <button type="button" onclick="window.history.back()" class="btn btn-danger p-1">Hủy</button>

    </form>
</div>
<link rel="stylesheet" href="View/assets/css/qldoan/edit_doan.css">
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

function updateFileName(event) {
    var fileInput = event.target;
    var fileNameSpan = document.getElementById('file-name');
    var fileName = fileInput.files[0] ? fileInput.files[0].name : '<?php echo $doan_info['baocao']; ?>';
    fileNameSpan.textContent = fileName;
}
</script>
<?php
} else {
    echo '<script>alert("Không tìm thấy đồ án cần chỉnh sửa");</script>';
    echo '<meta http-equiv=refresh content="0;url=index.php?action=doan"/>';
}
?>
<script src="ajax/get_lop.js"></script>
<script src="ajax/get_nganh.js"></script>
<script src="ajax/get_sinhvien.js"></script>
<script src="ajax/edit_doan_valid.js"></script>