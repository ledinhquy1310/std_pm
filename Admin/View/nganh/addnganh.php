<form action="index.php?action=nganh&act=insert_action" method="POST">
    <h2>Thêm ngành</h2>
    <label for="tennganh">Tên ngành:</label>
    <input type="text" id="tennganh" name="tennganh">
    <span style="color:red" id="tennganhError"></span>
    <label for="manganh">Mã ngành:</label>
    <input type="text" id="manganh" name="manganh">
    <span style="color:red" id="manganhError"></span>
    <label for="khoa">Khoa:</label>
    <select id="khoa" name="khoa">
        <option value="">--Chọn Khoa--</option>
        <?php
        require_once "./Model/khoa.php";
        $khoa_model = new khoa();
        $khoa_list = $khoa_model->getKhoa();
        foreach ($khoa_list as $khoa) {
            echo "<option value='" . $khoa['idkhoa'] . "'>" . $khoa['tenkhoa'] . "</option>";
        }
        ?>
    </select>
    <span style="color:red" id="khoaError"></span>
    <br>
    <button type="submit">Thêm ngành</button>
</form>
<link rel="stylesheet" href="View/assets/css/nganh/addnganh.css">
<script>
$(document).ready(function() {
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
                        submitForm();
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

        function submitForm() {
            if (!hasError) {
                $('form').unbind('submit').submit();
            }
        }
    });
});
</script>