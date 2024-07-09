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
    <form id="doan_form" method="post" action="index.php?action=doan&act=update_action" enctype="multipart/form-data">
        <h2>Chỉnh sửa đồ án</h2>
        <input type="hidden" name="iddoan" value="<?php echo $iddoan; ?>">
        <br>
        <label for="sinhvien">Sinh viên:</label>
        <select id="sinhvien" name="sinhvien">
            <option value="<?php echo isset($_SESSION['idsv']) ? $_SESSION['idsv'] : ''; ?>">
                <?php echo isset($_SESSION['tensv']) ? $_SESSION['tensv'] : ''; ?>
            </option>
        </select>
        <span id="sinhvien-error" class="error-message"></span>
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
        <span id="gvhd-error" class="error-message"></span>
        <br>
        <label for="tendoan">Tên đồ án:</label>
        <input type="text" id="tendoan" name="tendoan" value="<?php echo $doan_info['tendoan']; ?>">
        <span id="tendoan-error" class="error-message"></span>
        <br>
        <label for="linkdoan">Link đồ án:</label>
        <input type="text" id="linkdoan" name="linkdoan" value="<?php echo $doan_info['linkdoan']; ?>">
        <span id="linkdoan-error" class="error-message"></span><br>

        <label for="hinhanh">Hình ảnh :</label>
        <input type="file" id="hinhanh" name="hinhanh" class="form-control file-input" accept=".jpg, .jpeg, .png, .gif"
            onchange="previewImage(event)">
        <div class="file-container">
            <label for="hinhanh" class="file-label"><i class="fa-solid fa-upload"></i> Đổi hình ảnh</label>
            <img id="preview" src="Admin/View/assets/img/<?php echo $doan_info['hinhanh']; ?>" alt="Ảnh xem trước"
                style="max-width: 200px; max-height: 200px;margin-left:10px; <?php echo $doan_info['hinhanh'] ? 'display: block;' : 'display: none;'; ?>">
        </div>
        <span id="hinhanh-error" class="error-message"></span>
        <br>

        <label for="filename">File báo cáo:</label>
        <input type="file" id="filename" name="filename" class="form-control file-input" accept=".doc, .docx"
            onchange="updateFileName(event)">
        <div class="file-container">
            <label for="filename" class="file-label"><i class="fa-solid fa-upload"></i> Đổi file</label>
            <span id="file-name" class="ms-2"><?php echo $doan_info['baocao']; ?></span>
        </div>
        <span id="file-error" class="error-message"></span>

        <label for=" madoan">Mã đồ án:</label>
        <input type="text" id="madoan" name="madoan" value="<?php echo $doan_info['madoan']; ?>">
        <span id="madoan-error" class="error-message"></span><br>
        <br>
        <input class="btn btn-success" type="submit" value="Cập nhật" id="updateBtn" disabled>
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

$(document).ready(function() {
    var initialData = $('#doan_form').serialize();
    $('#doan_form').on('input', function() {
        var currentData = $(this).serialize();
        $('#updateBtn').prop('disabled', currentData === initialData);
    });
    $('#doan_form').submit(function(e) {
        e.preventDefault();
        var hasError = false;

        var sinhvien = $('#sinhvien').val();
        var gvhd = $('#gvhd').val();
        var tendoan = $('#tendoan').val();
        var linkdoan = $('#linkdoan').val();
        var madoan = $('#madoan').val();
        var hinhanh = $('#hinhanh').prop('files')[0];
        var file = $('#filename').prop('files')[0];

        if (sinhvien === "") {
            $('#sinhvien-error').text('(* Vui lòng chọn sinh viên. *)');
            hasError = true;
        } else {
            $('#sinhvien-error').text('');
        }

        if (gvhd === "") {
            $('#gvhd-error').text('(* Vui lòng chọn giáo viên hướng dẫn. *)');
            hasError = true;
        } else {
            $('#gvhd-error').text('');
        }

        if (tendoan === "") {
            $('#tendoan-error').text('(* Vui lòng nhập tên đồ án. *)');
            hasError = true;
        } else {
            $('#tendoan-error').text('');
        }

        function isValidUrl(url) {
            var urlPattern =
                /^(http[s]?):\/\/[\w\-]+(\.[\w\-]+)+([\w\-\.,@?^=%&:\/~\+#]*[\w\-\@?^=%&\/~\+#])?$/;
            return urlPattern.test(url);
        }

        if (linkdoan === "") {
            $('#linkdoan-error').text('(* Vui lòng nhập đường dẫn. *)');
            hasError = true;
        } else if (!isValidUrl(linkdoan)) {
            $('#linkdoan-error').text(
                '(* Đường dẫn không hợp lệ. Vui lòng nhập đúng định dạng URL. *)');
            hasError = true;
        } else {
            $('#linkdoan-error').text('');
        }

        if (madoan === "") {
            $('#madoan-error').text('(* Vui lòng nhập mã đồ án. *)');
            hasError = true;
        } else {
            $.ajax({
                url: 'Admin/View/ajax-url/check_madoan.php',
                method: 'GET',
                async: false,
                data: {
                    madoan: madoan,
                    iddoan: '<?php echo $iddoan; ?>',
                    role: 'edit'
                },
                success: function(response) {
                    if (response === "exists") {
                        $('#madoan-error').text('(* Mã đồ án đã tồn tại. *)');
                        hasError = true;
                    } else {
                        $('#madoan-error').text('');
                    }
                }
            });
        }

        if (!hasError) {
            var formData = new FormData(this);
            formData.append('hinhanh', hinhanh);
            formData.append('filename', file);

            $.ajax({
                url: 'index.php?action=doan&act=update_action',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    console.log(res);
                    if (res.indexOf("success") !== -1) {
                        window.location.href = 'index.php?action=doan';
                    } else {
                        window.scrollTo(0, 0);
                    }
                },
                error: function() {
                    alert('Có lỗi xảy ra khi sửa đồ án. Vui lòng thử lại sau.');
                }
            });
        } else {
            window.scrollTo(0, 0);
        }
    });
});
</script>

<?php
} else {
    echo '<script>alert("Không tìm thấy đồ án cần chỉnh sửa");</script>';
    echo '<meta http-equiv=refresh content="0;url=index.php?action=doan"/>';
}
?>
<link rel="stylesheet" href="View/assets/css/qldoan/edit_doan.css">