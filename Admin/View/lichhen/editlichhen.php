<?php
    $id = $_GET['edit_id'];
    require_once "./Model/lichhen.php";
    $lichhen_model = new lichhen();
    $lichhen_info = $lichhen_model->getlichhenbyId($id);
    ?>

<form action="index.php?action=lichhen&act=edit_action" method="POST" id="form">
    <h2>Sửa lịch hẹn</h2>
    <input type="hidden" name="id" value="<?php echo $lichhen_info['idlh']; ?>">
    <label for="lop">Lớp</label>
    <select id="lop" name="lop">
        <option value="">--Chọn Lớp--</option>
        <?php
        require_once "./Model/lop.php";
        $lop_model = new lop();
        $lop_list = $lop_model->getLop();
        foreach ($lop_list as $lop){ ?>
        <option value="<?php echo $lop['idlop']?>"
            <?php echo ($lichhen_info['idlop'] == $lop['idlop']) ? 'selected' : ''; ?>>
            <?php echo $lop['tenlop'] ?></option>;
        <?php }?>
    </select>
    <span id="lop-error" class="error-message"></span>

    <label for="sinhvien">Sinh viên:</label>
    <select id="sinhvien" name="sinhvien">
        <option value="">--Chọn sinh viên--</option>
        <option value="<?php echo $lichhen_info['idsv']?>" <?php echo ($lichhen_info['idsv']) ? 'selected' : ''; ?>>
            <?php echo $lichhen_info['tensv'] ?></option>;
    </select>
    <span id="sinhvien-error" class="error-message"></span>

    <label for="giangvien">Giảng viên:</label>
    <select id="giangvien" name="giangvien">
        <?php
        require_once "./Model/giangvien.php";
        $giangvien_model = new giangvien();
        $giangvien_list = $giangvien_model->getgiangvien();
        foreach ($giangvien_list as $giangvien){ ?>
        <option value="<?php echo $giangvien['idgv']?>"
            <?php echo ($lichhen_info['idgv'] == $giangvien['idgv']) ? 'selected' : ''; ?>>
            <?php echo $giangvien['tengv'] ?></option>;
        <?php }?>
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
    <input type="datetime-local" name="ngayhen" id="ngayhen" value="<?php echo $lichhen_info['ngayhen']?>">
    <span id="ngayhen-error" class="error-message"></span>

    <label for="ghichu">Ghi chú</label>
    <input type="text" name="ghichu" id="ghichu" value="<?php echo $lichhen_info['ghichu'] ?>">
    <button type="submit" id="updateBtn" disabled>Cập nhật lịch hẹn</button>
    <input type="button" class="btn btn-danger p-2" onclick="window.location.href='index.php?action=lichhen'"
        value="Hủy">
</form>
<script>
$(document).ready(function() {
    var newdata = $('#form').serialize();
    $('#form').on('input', function() {
        var currentdata = $(this).serialize();
        if (currentdata !== newdata) {
            $('#updateBtn').prop('disabled', false);
        } else {
            $('#updateBtn').prop('disabled', true);
        }
    });

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
        if (sinhvien === "" || sinhvien === 0) {
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
            url: 'index.php?action=lichhen&act=edit_action',
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
                alert('Có lỗi xảy ra khi sửa lịch hẹn. Vui lòng thử lại sau.');
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