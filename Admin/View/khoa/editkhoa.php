<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin khoa</title>
    <link rel="stylesheet" href="View/assets/css/khoa/editkhoa.css">
</head>

<body>
    <?php
    $idkhoa = $_GET['id'];
    require_once "./Model/khoa.php";
    $khoa_model = new khoa();
    $khoa_info = $khoa_model->getKhoaById($idkhoa);
    ?>

    <form id="editKhoaForm" action="index.php?action=khoa&act=update_action" method="POST">
        <h2>Sửa thông tin khoa</h2>
        <input type="hidden" name="idkhoa" value="<?php echo $idkhoa; ?>">
        <label for="tenkhoa">Tên Khoa:</label>
        <input type="text" id="tenkhoa" name="tenkhoa" value="<?php echo $khoa_info['tenkhoa']; ?>">
        <span id="tenkhoaError" style="color: red;"></span><br>

        <label for="makhoa">Mã Khoa:</label>
        <input type="text" id="makhoa" name="makhoa" value="<?php echo $khoa_info['makhoa']; ?>"
            onblur="checkmakhoa(this.value)">
        <span id="makhoaError" style="color: red;"></span><br>

        <label for="mota">Mô tả:</label>
        <textarea name="mota" id="mota" cols="30" rows="5"><?php echo $khoa_info['mota']; ?></textarea>

        <button type="submit" name="submit" id="updateBtn" disabled>Cập nhật</button>
        <input type="button" onclick="window.location.href='index.php?action=khoa'" class="btn btn-danger p-2"
            value="Hủy"></input>

    </form>

    <script>
    $(document).ready(function() {
        var newdata = $('#editKhoaForm').serialize();
        $('#editKhoaForm').on('input', function() {
            var currentdata = $(this).serialize();
            if (currentdata !== newdata) {
                $('#updateBtn').prop('disabled', false);
            } else {
                $('#updateBtn').prop('disabled', true);
            }
        });
        $('#editKhoaForm').submit(function(e) {
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
                            if (!hasError) {
                                $.ajax({
                                    url: 'index.php?action=khoa&act=update_action',
                                    method: 'POST',
                                    data: $('#editKhoaForm').serialize(),
                                    success: function(res) {
                                        console.log(res);
                                        if (res.indexOf("success") !== -1) {
                                            window.location.href =
                                                'index.php?action=khoa';
                                        } else {
                                            alert(
                                                'Có lỗi xảy ra. Vui lòng thử lại'
                                            );
                                        }
                                    }
                                });
                            }
                        }
                        console.log(response);
                    }
                });
            }

        });
    });
    </script>
</body>

</html>