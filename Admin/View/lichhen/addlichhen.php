<form action="index.php?action=lichhen&act=insert_action" method="POST" id="form">
    <h2>Tạo lịch hẹn</h2>
    <label for="lop">Lớp</label>
    <select id="lop" name="lop">
        <option value="">--Chọn Lớp--</option>
        <?php
        require_once "./Model/lop.php";
        $lop_model = new lop();
        $lop_list = $lop_model->getLop();
        foreach ($lop_list as $lop) {
            echo "<option value='" . $lop['idlop'] . "'>" . $lop['tenlop'] . "</option>";
        }
        ?>
    </select>
    <span id="lop-error" class="error-message"></span>

    <label for="sinhvien">Sinh viên:</label>
    <select id="sinhvien" name="sinhvien">
        <option value="">--Chọn Sinh viên--</option>
    </select>
    <span id="sinhvien-error" class="error-message"></span>

    <label for="giangvien">Giảng viên:</label>
    <select id="giangvien" name="giangvien">
        <option value="">--Chọn Giảng viên--</option>
        <?php
        require_once "./Model/giangvien.php";
        $giangvien_model = new giangvien();
        $giangvien_list = $giangvien_model->getgiangvien();
        foreach ($giangvien_list as $giangvien) {
            echo "<option value='" . $giangvien['idgv'] . "'>" . $giangvien['tengv'] . "</option>";
        }
        ?>
    </select>
    <span id="giangvien-error" class="error-message"></span>

    <label for="ngayhen">Ngày hẹn</label>
    <input type="datetime-local" name="ngayhen" id="ngayhen">
    <span id="ngayhen-error" class="error-message"></span>

    <label for="ghichu">Ghi chú (* nếu có *)</label>
    <input type="text" name="ghichu" id="ghichu">
    <button type="submit">Thêm lịch</button>
</form>
<script>
$(document).ready(function() {
    $('#form').on('submit', function(event) {
        event.preventDefault();
        var lop = $('#lop').val();
        var sinhvien = $('#sinhvien').val();
        var giangvien = $('#giangvien').val();
        var ngayhen = $('#ngayhen').val();
        var hasError = false;

        if (lop === "") {
            $('#lop-error').text('(* Vui lòng chọn lớp *)');
            hasError = true;
        } else {
            $('#lop-error').text('');
        }
        if (sinhvien === "") {
            $('#sinhvien-error').text('(* Vui lòng chọn sinh viên *)');
            hasError = true;
        } else {
            $('#sinhvien-error').text('');
        }
        if (giangvien === "") {
            $('#giangvien-error').text('(* Vui lòng chọn giảng viên *)');
            hasError = true;
        } else {
            $('#giangvien-error').text('');
        }
        if (ngayhen === "") {
            $('#ngayhen-error').text('(* Vui lòng chọn ngày hẹn *)');
            hasError = true;
        } else {
            var selectedDate = new Date(ngayhen);
            var currentDate = new Date();
            currentDate.setDate(currentDate.getDate() + 1);

            if (selectedDate <= currentDate) {
                $('#ngayhen-error').text('(* Ngày hẹn phải sau ngày hôm nay ít nhất 1 ngày *)');
                hasError = true;
            } else {
                $('#ngayhen-error').text('');
            }
        }

        if (hasError) {
            return;
        }
        $.ajax({
            url: 'index.php?action=lichhen&act=insert_action',
            method: 'POST',
            data: $('#form').serialize(),
            success: function(res) {
                console.log(res);
                if (res.indexOf("success") !== -1) {
                    window.location.href = 'index.php?action=lichhen';
                } else {
                    alert('Có lỗi xảy ra. Vui lòng thử lại');
                }
            },
            error: function() {
                alert('Có lỗi xảy ra khi thêm lịch hẹn. Vui lòng thử lại sau.');
            }
        });
    });
});
</script>
<script src="ajax/get_sinhvien.js"></script>
<link rel="stylesheet" href="View/assets/css/lichhen/addlichhen.css">
<style>
.error-message {
    color: red;
    font-size: 14px;
}
</style>