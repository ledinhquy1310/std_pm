$(document).ready(function () {
    $('.login-form').submit(function (e) {
        e.preventDefault();
        var email = $('input[name="txtemail"]').val();
        var password = $('input[name="txtpassword"]').val();
        var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        var hasError = false;

        if (email == "") {
            $('#emailError').text('(* Vui lòng nhập email của bạn. *)');
            hasError = true;
        } else {
            if (!emailPattern.test(email)) {
                $('#emailError').text('(* Địa chỉ email không hợp lệ. *)');
                hasError = true;
            } else {
                $('#emailError').text('');
            }
        }

        if (password == "") {
            $('#passwordError').text('(* Vui lòng nhập mật khẩu của bạn. *)');
            hasError = true;
        } else {
            $('#passwordError').text('');
        }

        if (hasError) {
            $('#loginError').text('');
            return;
        }

        $.ajax({
            url: 'index.php?action=login&act=login_action',
            method: 'post',
            data: $('.login-form').serialize(),
            success: function (res) {
                console.log(res);
                if (res.indexOf("success") !== -1) {
                    location.reload(true);
                    window.location.href = 'index.php?action=home';
                } else {
                    $('#loginError').text('Sai mật khẩu hoặc tài khoản không tồn tại');
                }
            }
        });
    });
});
