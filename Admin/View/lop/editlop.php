<?php
if (isset($_GET['id'])) {
    $idlop = $_GET['id'];
    require_once "./Model/lop.php";
    $lop_model = new lop();
    $lop_info = $lop_model->getLopById($idlop);
    require_once "./Model/nganh.php";
    $nganh_model = new nganh();
    $nganh_list = $nganh_model->getnganh();
    require_once "./Model/khoa.php";
    $khoa_model = new khoa();
    $khoa_list = $khoa_model->getkhoa();
    require_once "./Model/nienkhoa.php";
    $nienkhoa_model = new nienkhoa();
    $nienkhoa_list = $nienkhoa_model->getNienKhoa();
    require_once "./Model/hedaotao.php";
    $hdt_model = new hedaotao();
    $hdt_list = $hdt_model->getHeDaoTao();
} else {
    header("Location: index.php?action=lop");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin lớp</title>
    <link rel="stylesheet" href="View/assets/css/lop/editlop.css">

</head>

<body>
    <form id="edit_class_form" method="post">
        <h2>Chỉnh sửa thông tin lớp</h2>
        <input type="hidden" name="idlop" value="<?php echo $lop_info['idlop']; ?>">
        <label for="tenlop">Tên lớp:</label><br>
        <input type="text" id="tenlop" name="tenlop" value="<?php echo $lop_info['tenlop']; ?>">
        <span style="color:red" id="ErrorTenLop"></span>
        <br>
        <label for="malop">Mã lớp:</label>
        <input type="text" id="malop" name="malop" value="<?php echo $lop_info['malop']; ?>">
        <span style="color:red" id="ErrorMaLop"></span>
        <br>
        <label for="hdt">Hệ đào tạo:</label>
        <select id="hdt" name="hdt">
            <option value="">--Chọn hệ đào tạo--</option>
            <?php foreach ($hdt_list as $hdt): ?>
            <?php $selected = ($hdt['idhdt'] == $lop_info['hdt']) ? 'selected' : ''; ?>
            <option value="<?php echo $hdt['idhdt']; ?> " <?php echo $selected; ?>>
                <?php echo $hdt['tenhdt']; ?>
            </option>
            <?php endforeach; ?>
        </select>
        <span style="color:red" id="ErrorHDT"></span>
        <br>

        <label for="khoa">Khoa:</label>
        <select id="khoa" name="khoa">
            <option value="">Chọn Khoa</option>
            <?php foreach ($khoa_list as $khoa): ?>
            <?php $selected = ($khoa['idkhoa'] == $lop_info['idkhoa']) ? 'selected' : ''; ?>
            <option value="<?php echo $khoa['idkhoa']; ?>" <?php echo $selected; ?>><?php echo $khoa['tenkhoa']; ?>
            </option>
            <?php endforeach; ?>
        </select>
        <span style="color:red" id="ErrorKhoa"></span>
        <br>
        <label for="tenlop">Ngành:</label>
        <select id="nganh" name="nganh">
            <option value="">--Chọn ngành--</option>
            <?php foreach ($nganh_list as $nganh): ?>
            <?php $selected = ($nganh['idnganh'] == $lop_info['nganh']) ? 'selected' : ''; ?>
            <option value="<?php echo $nganh['idnganh']; ?>" <?php echo $selected; ?>><?php echo $nganh['tennganh']; ?>
            </option>
            <?php endforeach; ?>
        </select>
        <span style="color:red" id="ErrorNganh"></span>
        <br>

        <label for="tenlop">Niên khóa:</label>
        <select id="nienkhoa" name="nienkhoa">
            <option value="">--Niên Khóa--</option>
            <?php foreach ($nienkhoa_list as $nienkhoa): ?>
            <?php $selected = ($nienkhoa['idnk'] == $lop_info['idnk']) ? 'selected' : ''; ?>
            <option value="<?php echo $nienkhoa['idnk']; ?>" <?php echo $selected; ?>>
                <?php echo $nienkhoa['nienkhoa']; ?>
            </option>
            <?php endforeach; ?>
        </select><br>
        <span style="color:red" id="ErrorNienKhoa"></span>
        <br>
        <input type="submit" id="updateBtn" value="Cập nhật" disabled>
        <input type="button" class="btn btn-danger p-2" onclick="window.location.href='index.php?action=lop'"
            value="Hủy">
    </form>
</body>
<script>
$(document).ready(function() {
    var newdata = $('#edit_class_form').serialize();
    $('#edit_class_form').on('input', function() {
        var currentdata = $(this).serialize();
        if (currentdata !== newdata) {
            $('#updateBtn').prop('disabled', false);
        } else {
            $('#updateBtn').prop('disabled', true);
        }
    });

    $('#edit_class_form').on('submit', function(event) {
        event.preventDefault();

        var tenlop = $('#tenlop').val();
        var hdt = $('#hdt').val();
        var khoa = $('#khoa').val();
        var nganh = $('#nganh').val();
        var nienkhoa = $('#nienkhoa').val();
        var malop = $('#malop').val();
        var hasError = false;
        if (tenlop === "") {
            $('#ErrorTenLop').text('(* Vui lòng nhập tên lớp *)');
            hasError = true;
        } else {
            $('#ErrorTenLop').text('');
        }

        if (hdt === "") {
            $('#ErrorHDT').text('(* Vui lòng chọn hệ đào tạo *)');
            hasError = true;
        } else {
            $('#ErrorHDT').text('');
        }

        if (khoa === "") {
            $('#ErrorKhoa').text('(* Vui lòng chọn khoa *)');
            hasError = true;
        } else {
            $('#ErrorKhoa').text('');
        }

        if (nganh === "") {
            $('#ErrorNganh').text('(* Vui lòng chọn ngành *)');
            hasError = true;
        } else {
            $('#ErrorNganh').text('');
        }

        if (nienkhoa === "") {
            $('#ErrorNienKhoa').text('(* Vui lòng chọn niên khóa *)');
            hasError = true;
        } else {
            $('#ErrorNienKhoa').text('');
        }

        if (malop === "") {
            $('#ErrorMaLop').text('(* Vui lòng nhập mã lớp *)');
            hasError = true;
        } else {
            $.ajax({
                url: 'View/ajax-url/check_malop.php',
                method: 'GET',
                data: {
                    malop: malop
                },
                success: function(response) {
                    if (response === "exists") {
                        $('#ErrorMaLop').text('(* Mã lớp đã tồn tại.*)');
                        hasError = true;
                    } else {
                        $('#ErrorMaLop').text('');
                    }
                },
                error: function() {
                    alert('Có lỗi xảy ra khi kiểm tra mã lớp. Vui lòng thử lại sau.');
                    hasError = true;
                }
            });
        }

        if (hasError) {
            return;
        }
        $.ajax({
            url: 'index.php?action=lop&act=update_action',
            method: 'POST',
            data: $('#edit_class_form').serialize(),
            success: function(res) {
                console.log(res);
                if (res.indexOf("success") !== -1) {
                    window.location.href = 'index.php?action=lop';
                } else {
                    alert('Có lỗi xảy ra. Vui lòng thử lại');
                }
            },
            error: function() {
                alert('Có lỗi xảy ra khi sửa lớp. Vui lòng thử lại sau.');
            }
        });
    });
});
</script>

</html>