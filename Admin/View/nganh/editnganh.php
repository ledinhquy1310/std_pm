<?php
if (isset($_GET['id'])) {
    $idnganh = $_GET['id'];
    require_once "./Model/nganh.php";
    $nganh_model = new nganh();
    $nganh_info = $nganh_model->getnganhById($idnganh);
} else {

    header("Location: index.php?action=nganh");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin ngành</title>
    <link rel="stylesheet" href="View/assets/css/nganh/editnganh.css">

</head>

<body>
    <form action="index.php?action=nganh&act=update_action" method="post">
        <h2>Chỉnh sửa ngành</h2>
        <input type="hidden" name="idnganh" value="<?php echo $nganh_info['idnganh']; ?>">
        <label for="tennganh">Tên ngành:</label>
        <input type="text" id="tennganh" name="tennganh" value="<?php echo $nganh_info['tennganh']; ?>"><br>
        <span style="color:red" id="tennganhError"></span>
        <label for="manganh">Mã ngành:</label>
        <input type="text" id="manganh" name="manganh" value="<?php echo $nganh_info['manganh']; ?>"><br>
        <span style="color:red" id="manganhError"></span>
        <label for="khoa">Khoa:</label>
        <select id="khoa" name="khoa">
            <option value="">--Chọn Khoa--</option>
            <?php
            require_once "./Model/khoa.php";
            $khoa_model = new khoa();
            $khoa_list = $khoa_model->getKhoa();
            foreach ($khoa_list as $khoa) {
                $selected = ($khoa['idkhoa'] == $nganh_info['khoa']) ? 'selected' : '';
                echo "<option value='" . $khoa['idkhoa'] . "' $selected>" . $khoa['tenkhoa'] . "</option>";
            }
            ?>
        </select>
        <span style="color:red" id="khoaError"></span>
        <br>
        <button type="submit" id="updateBtn" disabled>Cập nhật</button>
        <input type="button" onclick="window.location.href='index.php?action=nganh'" class="btn btn-danger p-2"
            value="Hủy"></input>
    </form>
</body>
<script>
$(document).ready(function() {
    var originalData = $('form').serialize();

    $('form').on('input', function() {
        var currentData = $(this).serialize();
        if (currentData !== originalData) {
            $('#updateBtn').prop('disabled', false);
        } else {
            $('#updateBtn').prop('disabled', true);
        }
    });
    $('form').submit(function(e) {
        e.preventDefault();

        var tennganh = $('#tennganh').val();
        var manganh = $('#manganh').val();
        var khoa = $('#khoa').val();
        var hasError = false;

        if (tennganh === "") {
            $('#tennganhError').text('(* Vui lòng nhập tên ngành. *)');
            hasError = true;
        } else {
            $('#tennganhError').text('');
        }

        if (manganh === "") {
            $('#manganhError').text('(* Vui lòng nhập mã ngành. *)');
            hasError = true;
        } else {
            $.ajax({
                url: 'View/ajax-url/check_manganh.php',
                method: 'GET',
                data: {
                    manganh: manganh
                },
                success: function(response) {
                    if (response === "exists") {
                        $('#manganhError').text('(* Mã ngành đã tồn tại.*)');
                        hasError = true;
                    } else {
                        $('#manganhError').text('');
                    }
                }
            });
        }

        if (khoa === "") {
            $('#khoaError').text('(* Vui lòng chọn khoa. *)');
            hasError = true;
        } else {
            $('#khoaError').text('');
        }

        if (hasError) {
            return;
        }

        this.submit();
    });
});
</script>

</html>