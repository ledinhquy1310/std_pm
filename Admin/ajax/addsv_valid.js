$(document).ready(function () {
    $('form').on('submit', function (event) {
        event.preventDefault();
        var hasError = false;

        var mssv = $('#mssv').val();
        var tensv = $('#tensv').val();
        var email = $('#email').val();
        var ngaysinh = $('#ngaysinh').val();
        var sodienthoai = $('#sodienthoai').val();
        var gioitinh = document.querySelector('input[name="gioitinh"]:checked');
        var tinh = $('#province').val();
        var quan = $('#district').val();
        var xa = $('#wards').val();
        var dcct = $('#diachi_chitiet').val();
        var cccd = $('#cccd').val();
        var hedaotao = $('#hedaotao').val();
        var nganh = $('#nganh').val();
        var lop = $('#lop').val();


        var mssvPromise = $.Deferred();
        var emailPromise = $.Deferred();

        // Validate MSSV
        if (mssv == "") {
            $('#mssvError').text("(* Vui lòng nhập mã sinh viên *)");
            hasError = true;
            mssvPromise.resolve();
        } else {
            $.ajax({
                url: 'View/ajax-url/check_mssv.php',
                method: 'GET',
                data: {
                    mssv: mssv,
                    role: 'add'
                },
                success: function (response) {
                    if (response === "exists") {
                        $('#mssvError').text('(* Mã sinh viên đã tồn tại.*)');
                        hasError = true;
                    } else {
                        $('#mssvError').text('');
                    }
                    mssvPromise.resolve();
                },
                error: function () {
                    alert('Có lỗi xảy ra khi kiểm tra mã sinh viên. Vui lòng thử lại sau.');
                    hasError = true;
                    mssvPromise.resolve();
                }
            });
        }

        // Validate tensv
        var digitPattern = /\d/;
        var specialCharPattern = /[~!@#$%^&*()_+`\-={}[\]:;"'<>,.?/\\|]/;
        if (tensv == "") {
            $('#tensvError').text("(* Vui lòng nhập tên sinh viên *)");
            hasError = true;
        } else if (digitPattern.test(tensv)) {
            $('#tensvError').text("(* Tên sinh viên không được chứa số *)");
            hasError = true;
        } else if (specialCharPattern.test(tensv)) {
            $('#tensvError').text("(* Tên sinh viên không được chứa kí tự đặc biệt *)");
            hasError = true;
        } else {
            $('#tensvError').text("");
        }

        // Validate email
        var emailRegex = /^[^\s@]+@gmail\.com$/;
        if (email === "") {
            $('#emailError').text("(* Email không được để trống *)");
            hasError = true;
            emailPromise.resolve();
        } else if (!emailRegex.test(email)) {
            $('#emailError').text("(* Email không hợp lệ *)");
            hasError = true;
            emailPromise.resolve();
        } else {
            $.ajax({
                url: 'View/ajax-url/check_email.php',
                method: 'GET',
                data: {
                    email: email,
                    role: 'add'
                },
                success: function (response) {
                    if (response === "exists") {
                        $('#emailError').text('(* Email đã tồn tại.*)');
                        hasError = true;
                    } else {
                        $('#emailError').text('');
                    }
                    emailPromise.resolve();
                },
                error: function () {
                    alert('Có lỗi xảy ra khi kiểm tra email. Vui lòng thử lại sau.');
                    hasError = true;
                    emailPromise.resolve();
                }
            });
        }

        // Validate sodienthoai
        var phoneRegex = /^(0\d{9,10})$/;
        if (sodienthoai == "") {
            $('#sodienthoaiError').text("(* Vui lòng nhập số điện thoại *)");
            hasError = true;
        } else if (!phoneRegex.test(sodienthoai)) {
            $('#sodienthoaiError').html("(* - Số điện thoại phải là số<br> - có 10 đến 11 số<br> - bắt đầu bằng số 0  *)");
            hasError = true;
        } else {
            $('#sodienthoaiError').text("");
        }

        // Validate cccd
        var cccdRegex = /^[0-9]{9,12}$/;
        if (cccd == "") {
            $('#cccdError').text("(* Vui lòng nhập số căng cước công dân *)");
            hasError = true;
        } else if (!cccdRegex.test(cccd)) {
            $('#cccdError').text("Số CCCD không hợp lệ.");
            hasError = true;
        } else {
            $('#cccdError').text("");
        }

        // Validate ngaysinh
        var today = new Date();
        var selectedDate = new Date(ngaysinh);
        if (ngaysinh == "") {
            $('#ngaysinhError').text("(* Vui lòng nhập ngày sinh *)");
            hasError = true;
        } else if (selectedDate >= today) {
            $('#ngaysinhError').text("(* Ngày sinh phải nhỏ hơn ngày hiện tại *)");
            hasError = true;
        } else {
            $('#ngaysinhError').text("");
        }

        // Validate gioitinh
        if (!gioitinh) {
            $('#gioitinhError').text("(* Vui lòng chọn giới tính *)");
            hasError = true;
        } else {
            $('#gioitinhError').text("");
        }

        // Validate hedaotao
        if (hedaotao == "" || hedaotao == 0) {
            $('#hedaotaoError').text("(* Vui lòng chọn hệ đào tạo *)");
            hasError = true;
        } else {
            $('#hedaotaoError').text("");
        }

        // Validate nganh
        if (nganh == "" || nganh == 0) {
            $('#nganhError').text("(* Vui lòng chọn ngành *)");
            hasError = true;
        } else {
            $('#nganhError').text("");
        }

        // Validate lop
        if (lop == "" || lop == 0) {
            $('#lopError').text("(* Vui lòng chọn lớp *)");
            hasError = true;
        } else {
            $('#lopError').text("");
        }

        // Validate tinh
        if (tinh == "" || tinh == 0) {
            $('#tinhError').text("(* Vui lòng chọn tỉnh *)");
            hasError = true;
        } else {
            $('#tinhError').text("");
        }

        // Validate quan
        if (quan == "" || quan == 0) {
            $('#quanError').text("(* Vui lòng chọn quận/huyện *)");
            hasError = true;
        } else {
            $('#quanError').text("");
        }

        // Validate xa
        if (xa == "" || xa == 0) {
            $('#xaError').text("(* Vui lòng chọn phường/xã *)");
            hasError = true;
        } else {
            $('#xaError').text("");
        }
        // Validate dcct
        if (dcct == "" || dcct == 0) {
            $('#dcchitietError').text("(* Vui lòng điền tổ/ấp/đường... *)");
            hasError = true;
        } else {
            $('#dcchitietError').text("");
        }

        $.when(mssvPromise, emailPromise).done(function () {
            if (hasError) {
                window.scrollTo(0, 0);
                return;
            }

            $.ajax({
                url: 'index.php?action=sinhvien&act=insert_action',
                method: 'POST',
                data: $('form').serialize(),
                success: function (res) {
                    console.log(res);
                    if (res.indexOf("success") !== -1) {
                        window.location.href = 'index.php?action=sinhvien';
                    } else {
                        alert('Có lỗi xảy ra. Vui lòng thử lại');
                    }
                },
                error: function () {
                    alert('Có lỗi xảy ra khi thêm sinh viên. Vui lòng thử lại sau.');
                }
            });
        });
    });
});
