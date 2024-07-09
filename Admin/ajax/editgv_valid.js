$(document).ready(function () {
    var initialData = $('#form').serialize();

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
        var idgv = $('#idgv').val();
        var magv = $('#magv').val();
        var tengv = $('#tengv').val();
        var email = $('#email').val();
        var trinhdo = $('#trinhdo').val();
        var sodienthoai = $('#sodienthoai').val();
        var khoa = $('#khoa').val();
        var nganh = $('#nganh').val();
        hasError = false;
        // Validate tengv
        var digitPattern = /\d/;
        var specialCharPattern = /[~!@#$%^&*()_+`\-={}[\]:;"'<>,.?/\\|]/;
        if (tengv === "") {
            $('#tengvError').text("(* Vui lòng nhập tên giảng viên *)");
            hasError = true;
        } else if (digitPattern.test(tengv)) {
            $('#tengvError').text("(* Tên giảng viên không được chứa số *)");
            hasError = true;
        } else if (specialCharPattern.test(tengv)) {
            $('#tengvError').text("(* Tên giảng viên không được chứa kí tự đặc biệt *)");
            hasError = true;
        } else {
            $('#tengvError').text("");
        }

        // Validate email
        var emailRegex = /^[^\s@]+@gmail\.com$/;
        if (email === "") {
            $('#emailError').text("(* Email không được để trống *)");
            hasError = true;
        } else if (!emailRegex.test(email)) {
            $('#emailError').text("(* Email không hợp lệ *)");
            hasError = true;
        } else {
            $('#emailError').text("");
        }

        // Validate trinhdo
        if (trinhdo === "") {
            $('#trinhdoError').text("(* Vui lòng chọn trình độ *)");
            hasError = true;
        } else {
            $('#trinhdoError').text("");
        }

        // Validate sodienthoai
        var phoneRegex = /^(0\d{9,10})$/;
        if (sodienthoai === "") {
            $('#sodienthoaiError').text("(* Vui lòng nhập số điện thoại *)");
            hasError = true;
        } else if (!phoneRegex.test(sodienthoai)) {
            $('#sodienthoaiError').text("(* Số điện thoại không hợp lệ *)");
            hasError = true;
        } else {
            $('#sodienthoaiError').text("");
        }

        // Validate khoa
        if (khoa === "") {
            $('#khoaError').text("(* Vui lòng chọn khoa *)");
            hasError = true;
        } else {
            $('#khoaError').text("");
        }

        // Validate nganh
        if (nganh === "" || nganh === 0) {
            $('#nganhError').text("(* Vui lòng chọn ngành *)");
            hasError = true;
        } else {
            $('#nganhError').text("");
        }
        // validate magv
        if (magv === "") {
            $('#magvError').text("(* Vui lòng nhập mã giảng viên *)");
            hasError = true;
        } else {
            $.ajax({
                url: 'View/ajax-url/check_magv.php',
                method: 'GET',
                data: {
                    magv: magv,
                    idgv: idgv,
                    role: 'edit'
                },
                success: function (response) {
                    if (response === "exists") {
                        $('#magvError').text('(* Mã giảng viên đã tồn tại.*)');
                        hasError = true;
                    } else {
                        $('#magvError').text('');
                    }
                },
                error: function () {
                    alert('Có lỗi xảy ra khi kiểm tra mã giảng viên. Vui lòng thử lại sau.');
                    hasError = true;
                }
            });
        }

    }
    function validateAndSubmitForm() {
        $.ajax({
            url: 'index.php?action=giangvien&act=update_action',
            method: 'POST',
            data: $('#form').serialize(),
            success: function (res) {
                console.log(res);
                if (res.indexOf("success") !== -1) {
                    window.location.href = 'index.php?action=giangvien';
                } else {
                    window.scrollTo(0, 0);
                }
            },
            error: function () {
                alert('Có lỗi xảy ra khi sửa giảng viên. Vui lòng thử lại sau.');
            }
        });
    }
}
);
