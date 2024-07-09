<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm đồ án</title>
    <link rel="stylesheet" href="View/assets/css/qldoan/add_doan.css">
</head>

<body>
    <?php require_once "./Model/giangvien.php";
    $giangvien_model = new giangvien();
    $giangvien_info = $giangvien_model->getGiangVien();?>
    <div>
        <form method="post" action="index.php?action=doan&act=insert_action" enctype="multipart/form-data"
            id="doan_form">
            <h2>Thêm mới đồ án</h2>
            <label for="sinhvien">Sinh viên:</label>
            <select id="sinhvien" name="sinhvien">
                <option value="<?php echo isset($_SESSION['idsv']) ? $_SESSION['idsv'] : ''; ?>">
                    <?php echo isset($_SESSION['tensv']) ? $_SESSION['tensv'] : ''; ?>
                </option>
            </select>
            <span id="sinhvienError" class="error-message"></span>
            <br>

            <label for="gvhd">Giáo viên hướng dẫn:</label>
            <select id="gvhd" name="gvhd">
                <option value="">--Giảng viên--</option>
                <?php foreach ($giangvien_info as $gv): ?>
                <option value="<?php echo $gv['idgv']; ?>"><?php echo $gv['tengv']; ?></option>
                <?php endforeach; ?>
            </select>
            <span id="gvhdError" class="error-message"></span>
            <br>

            <label for="tendoan">Tên đồ án:</label>
            <input type="text" id="tendoan" name="tendoan">
            <span id="tendoanError" class="error-message"></span>
            <br>

            <label for="hinhanh">Hình ảnh:</label>
            <img id="preview" src="#" alt="Ảnh xem trước" style="max-width: 200px; max-height: 200px; display: none;">
            <br>
            <input type="file" id="hinhanh" name="hinhanh" class="form-control" accept=".jpg, .jpeg, .png, .gif"
                onchange="previewImage(event)">
            <span id="hinhanhError" class="error-message"></span>
            <br>

            <label for="file">File báo cáo:</label>
            <input type="file" id="file" name="filename" class="form-control" accept=".doc, .docx">
            <span id="fileError" class="error-message"></span>
            <br>

            <label for="linkdoan">Link đồ án:</label>
            <input type="text" id="linkdoan" name="linkdoan">
            <span id="linkdoanError" class="error-message"></span>
            <br>

            <label for="madoan">Mã đồ án:</label>
            <input type="text" id="madoan" name="madoan">
            <span id="madoanError" class="error-message"></span>
            <br>
            <br>
            <input class="btn btn-success" type="submit" value="Thêm mới">
        </form>
    </div>

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

    $(document).ready(function() {
        $('#doan_form').submit(function(e) {
            e.preventDefault();

            var sinhvien = $('#sinhvien').val();
            var gvhd = $('#gvhd').val();
            var tendoan = $('#tendoan').val();
            var linkdoan = $('#linkdoan').val();
            var madoan = $('#madoan').val();
            var hinhanh = $('#hinhanh').prop('files')[0];
            var file = $('#file').prop('files')[0];
            var hasError = false;

            if (sinhvien === "") {
                $('#sinhvienError').text('(* Vui lòng chọn sinh viên. *)');
                hasError = true;
            } else {
                $('#sinhvienError').text('');
            }

            if (gvhd === "") {
                $('#gvhdError').text('(* Vui lòng chọn giáo viên hướng dẫn. *)');
                hasError = true;
            } else {
                $('#gvhdError').text('');
            }
            if (tendoan === "") {
                $('#tendoanError').text('(* Vui lòng nhập tên đồ án. *)');
                hasError = true;
            } else {
                $('#tendoanError').text('');
            }

            function isValidUrl(url) {
                var urlPattern =
                    /^(http[s]?):\/\/[\w\-]+(\.[\w\-]+)+([\w\-\.,@?^=%&:\/~\+#]*[\w\-\@?^=%&\/~\+#])?$/;
                return urlPattern.test(url);
            }
            if (linkdoan === "") {
                $('#linkdoanError').text('(* Vui lòng nhập đường dẫn . *)');
                hasError = true;
            } else if (!isValidUrl(linkdoan)) {
                $('#linkdoanError').text(
                    '(* Đường dẫn không hợp lệ. Vui lòng nhập đúng định dạng URL. *)');
                hasError = true;
            } else {
                $('#linkdoanError').text('');
            }

            if (madoan === "") {
                $('#madoanError').text('(* Vui lòng nhập mã đồ án. *)');
                hasError = true;
            } else {
                $.ajax({
                    url: 'Admin/View/ajax-url/check_madoan.php',
                    method: 'GET',
                    data: {
                        madoan: madoan,
                        role: 'add'
                    },
                    success: function(response) {
                        if (response === "exists") {
                            $('#madoanError').text('(* Mã đồ án đã tồn tại. *)');
                            hasError = true;
                        } else {
                            $('#madoanError').text('');
                            if (!hasError) {
                                $('#doan_form').unbind('submit').submit();
                            }
                        }
                    }
                });
            }

            if (hinhanh) {
                var validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if ($.inArray(hinhanh.type, validImageTypes) < 0) {
                    $('#hinhanhError').text(
                        '(* Định dạng ảnh không hợp lệ. Chỉ chấp nhận .jpg, .jpeg, .png, .gif. *)');
                    hasError = true;
                } else if (hinhanh.size > 2 * 1024 * 1024) {
                    $('#hinhanhError').text('(* Kích thước ảnh không được vượt quá 2MB. *)');
                    hasError = true;
                } else {
                    $('#hinhanhError').text('');
                }
            } else {
                $('#hinhanhError').text('(* Vui lòng chọn hình ảnh. *)');
                hasError = true;
            }

            if (file) {
                var validFileTypes = ['application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ];
                if ($.inArray(file.type, validFileTypes) < 0) {
                    $('#fileError').text(
                        '(* Định dạng file không hợp lệ. Chỉ chấp nhận .doc, .docx. *)');
                    hasError = true;
                } else if (file.size > 5 * 1024 * 1024) {
                    $('#fileError').text('(* Kích thước file không được vượt quá 5MB. *)');
                    hasError = true;
                } else {
                    $('#fileError').text('');
                }
            } else {
                $('#fileError').text('(* Vui lòng chọn file báo cáo. *)');
                hasError = true;
            }

            if (hasError) {
                return false;
            }
        });
    });
    </script>

</body>

</html>