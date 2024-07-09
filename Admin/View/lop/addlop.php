<?php
require_once "./Model/khoa.php";
$khoa_model = new khoa();
$khoa_list = $khoa_model->getkhoa();
require_once "./Model/nienkhoa.php";
$nienkhoa_model = new nienkhoa();
$nienkhoa_list = $nienkhoa_model->getNienKhoa();
require_once "./Model/hedaotao.php";
$hdt_model = new hedaotao();
$hdt_list = $hdt_model->getHeDaoTao();
?>

<form id="add_class_form" method="POST">
    <h2>Thêm lớp</h2>

    <label for="tenlop">Tên lớp:</label>
    <input type="text" id="tenlop" name="tenlop" placeholder="Nhập tên lớp">
    <span style="color:red" id="ErrorTenLop"></span>
    <br>
    <label for="malop">Mã lớp:</label>
    <input type="text" id="malop" name="malop">
    <span style="color:red" id="ErrorMaLop"></span>
    <br>
    <label for="hdt">Hệ đào tạo:</label>
    <select id="hdt" name="hdt">
        <option value="">--Chọn hệ đào tạo--</option>
        <?php foreach ($hdt_list as $hdt): ?>
        <option value="<?php echo $hdt['idhdt']; ?>">
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
        <option value="<?php echo $khoa['idkhoa']; ?>"><?php echo $khoa['tenkhoa']; ?></option>
        <?php endforeach; ?>
    </select>
    <span style="color:red" id="ErrorKhoa"></span>
    <br>

    <label for="nganh">Ngành:</label>
    <select id="nganh" name="nganh">
        <option value="">--Vui lòng chọn khoa trước--</option>
    </select>
    <span style="color:red" id="ErrorNganh"></span>
    <br>

    <label for="nienkhoa">Niên khóa:</label>
    <select id="nienkhoa" name="nienkhoa">
        <option value="">--Vui lòng chọn hệ đào tạo trước--</option>
    </select>
    <span style="color:red" id="ErrorNienKhoa"></span>
    <br>

    <button type="submit">Thêm lớp</button>
</form>

<link rel="stylesheet" href="View/assets/css/lop/addlop.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="ajax/get_nganh.js"></script>
<script src="ajax/get_nienkhoa.js"></script>
<script>
$(document).ready(function() {
    $('#add_class_form').on('submit', function(event) {
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
            url: 'index.php?action=lop&act=insert_action',
            method: 'POST',
            data: $('#add_class_form').serialize(),
            success: function(res) {
                console.log(res);
                if (res.indexOf("success") !== -1) {
                    window.location.href = 'index.php?action=lop';
                } else {
                    alert('Có lỗi xảy ra. Vui lòng thử lại');
                }
            },
            error: function() {
                alert('Có lỗi xảy ra khi thêm lớp. Vui lòng thử lại sau.');
            }
        });
    });
});
</script>