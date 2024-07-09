$(document).ready(function () {
    var initialData = $('#form').serialize();
    var hasError = false;
    $('#form').on('input', function () {
        var currentData = $(this).serialize();
        $('#updateBtn').prop('disabled', currentData === initialData);
        validate();
    });
    $('form').on('submit', function (event) {
        event.preventDefault();
        if (!hasError) {
            validateAndSubmitForm();
        } else {
            window.scrollTo(0, 0);
        }
    });

    function validate() {
        var iddoan = $('#iddoan').val();
        var khoa = $('#khoa').val();
        var nganh = $('#nganh').val();
        var lop = $('#lop').val();
        var sinhvien = $('#sinhvien').val();
        var gvhd = $('#gvhd').val();
        var tendoan = $('#tendoan').val();
        var linkdoan = $('#linkdoan').val();
        var madoan = $('#madoan').val();
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
                    iddoan: iddoan,
                    role: 'edit'
                },
                success: function (response) {
                    if (response === "exists") {
                        $('#madoanError').text('(* Mã đồ án đã tồn tại. *)');
                        hasError = true;
                    } else {
                        $('#madoanError').text('');
                    }
                }
            });
        }

    }

    function validateAndSubmitForm() {
        $.ajax({
            url: 'index.php?action=doan&act=update_action',
            method: 'POST',
            data: $('#form').serialize(),
            success: function (res) {
                console.log(res);
                if (res.indexOf("success") !== -1) {
                    window.location.href = 'index.php?action=doan';
                } else {
                    window.scrollTo(0, 0);
                }
            },
            error: function () {
                alert('Có lỗi xảy ra khi sửa đồ án. Vui lòng thử lại sau.');
            }
        });
    }
});