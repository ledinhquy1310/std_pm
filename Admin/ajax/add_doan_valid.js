$(document).ready(function () {
    $('#doan-form').on('input', function (e) {
        e.preventDefault();

        var khoa = $('#khoa').val();
        var nganh = $('#nganh').val();
        var lop = $('#lop').val();
        var sinhvien = $('#sinhvien').val();
        var gvhd = $('#gvhd').val();
        var tendoan = $('#tendoan').val();
        var linkdoan = $('#linkdoan').val();
        var madoan = $('#madoan').val();
        var hinhanh = $('#hinhanh').prop('files')[0];
        var file = $('#file').prop('files')[0];
        var hasError = false;

        if (khoa === "") {
            $('#khoaError').text('(* Vui lòng chọn khoa. *)');
            hasError = true;
        } else {
            $('#khoaError').text('');
        }

        if (nganh === "") {
            $('#nganhError').text('(* Vui lòng chọn ngành. *)');
            hasError = true;
        } else {
            $('#nganhError').text('');
        }

        if (lop === "") {
            $('#lopError').text('(* Vui lòng chọn lớp. *)');
            hasError = true;
        } else {
            $('#lopError').text('');
        }

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
            $('#linkdoanError').text('(* Đường dẫn không hợp lệ. Vui lòng nhập đúng định dạng URL. *)');
            hasError = true;
        } else {
            $('#linkdoanError').text('');
        }

        if (madoan === "") {
            $('#madoanError').text('(* Vui lòng nhập mã đồ án. *)');
            hasError = true;
        } else {
            $.ajax({
                url: 'View/ajax-url/check_madoan.php',
                method: 'GET',
                data: {
                    madoan: madoan,
                    role: 'add'
                },
                success: function (response) {
                    if (response === "exists") {
                        $('#madoanError').text('(* Mã đồ án đã tồn tại. *)');
                        hasError = true;
                    } else {
                        $('#madoanError').text('');
                        submitForm();
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
                $('#fileError').text('(* Định dạng file không hợp lệ. Chỉ chấp nhận .doc, .docx. *)');
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

        function submitForm() {
            if (!hasError) {
                $('#doan-form').unbind('submit').submit();
            }
        }

        if (hasError) {
            return false;
        }
    });
});