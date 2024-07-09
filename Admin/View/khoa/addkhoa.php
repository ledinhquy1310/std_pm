<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Khoa</title>
    <link rel="stylesheet" href="View/assets/css/khoa/addkhoa.css">
</head>

<body>
    <form id="addKhoaForm">
        <h2>Thêm khoa</h2>
        <label for="tenkhoa">Tên Khoa:</label>
        <input type="text" id="tenkhoa" name="tenkhoa">
        <span id="tenkhoaError" style="color: red;"></span><br>

        <label for="makhoa">Mã Khoa:</label>
        <input type="text" id="makhoa" name="makhoa">
        <span id="makhoaError" style="color: red;"></span><br>

        <label for="mota">Mô tả:</label>
        <textarea name="mota" id="mota" cols="30" rows="10"></textarea><br>

        <button type="submit" name="submit">Thêm</button>
    </form>
    <script>
    $(document).ready(function() {
        $('#addKhoaForm').submit(function(e) {
            e.preventDefault();

            var tenkhoa = $('#tenkhoa').val();
            var makhoa = $('#makhoa').val();
            var hasError = false;

            if (tenkhoa == "") {
                $('#tenkhoaError').text('(* Vui lòng nhập tên khoa. *)');
                hasError = true;
            } else {
                $('#tenkhoaError').text('');
            }

            if (makhoa == "") {
                $('#makhoaError').text('(* Vui lòng nhập mã khoa. *)');
                hasError = true;
            } else {
                $.ajax({
                    url: 'View/ajax-url/check_makhoa.php',
                    method: 'GET',
                    data: {
                        makhoa: makhoa
                    },
                    success: function(response) {
                        if (response === "exists") {
                            $('#makhoaError').text('(* Mã Khoa đã tồn tại.*)');
                            hasError = true;
                        } else {
                            $('#makhoaError').text('');
                            submitForm();
                        }
                        console.log(response);
                    }
                });
            }

            function submitForm() {
                if (!hasError) {
                    $.ajax({
                        url: 'index.php?action=khoa&act=insert_action',
                        method: 'POST',
                        data: $('#addKhoaForm').serialize(),
                        success: function(res) {
                            console.log(res);
                            if (res.indexOf("success") !== -1) {
                                window.location.href = 'index.php?action=khoa';
                            } else {
                                alert('Có lỗi xảy ra. Vui lòng thử lại');
                            }
                        }
                    });
                }
            }
        });
    });
    </script>

</body>

</html>