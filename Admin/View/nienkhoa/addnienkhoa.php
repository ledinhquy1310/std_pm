<?php
if (isset($_GET['id'])) {
    $idnk = $_GET['id'];
    require_once "./Model/nienkhoa.php";
    $nienkhoa_model = new nienkhoa();
    $nienkhoa_info = $nienkhoa_model->getNienKhoa();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm niên khóa</title>
    <link rel="stylesheet" href="View/assets/css/nienkhoa/addnienkhoa.css">
</head>

<body>
    <form id="nienkhoa_form" action="index.php?action=nienkhoa&act=insert_action" method="post">
        <h2>Thêm niên khóa</h2>
        <input type="hidden" name="idnk" value="">
        <label for="nienkhoa">Niên Khóa:</label>
        <div>
            <input type="number" id="nienkhoa1" name="nienkhoa1" min="1970" max="2099" placeholder="1970">
            -
            <input type="number" id="nienkhoa2" name="nienkhoa2" min="1971" max="2099" placeholder="1971">
        </div>
        <span style="color:red" id="Error"></span>
        <br>
        <input type="submit" id="addbtn" value="Thêm">
    </form>
</body>
<script>
$(document).ready(function() {
    $('#nienkhoa_form').submit(function(e) {
        e.preventDefault();
        var nienkhoa1 = $('#nienkhoa1').val();
        var nienkhoa2 = $('#nienkhoa2').val();
        var hasError = false;

        if (nienkhoa1 === "" || nienkhoa2 === "") {
            $('#Error').text('(* Vui lòng nhập đầy đủ niên khóa *)');
            hasError = true;
        } else {
            if (nienkhoa2 - nienkhoa1 < 2 || nienkhoa2 - nienkhoa1 > 4) {
                $('#Error').text('(* Niên khóa phải cách nhau ít nhất 2 năm và nhiều nhất 4 năm *)');
                hasError = true;
            } else {
                $('#Error').text('');
            }
        }
        if (hasError) {
            return;
        }
        this.submit();
    });
});
</script>

</html>