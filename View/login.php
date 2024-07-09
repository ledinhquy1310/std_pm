<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="View/assets/css/login.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="well bk-light">
                <form method="post" action="index.php?action=login&act=login_action" class="login-form" id="loginForm">
                    <h1 class="text-bold">Đăng nhập</h1>
                    <label for="role" class="label-left">Bạn là: </label>
                    <select name="role" id="role" class="form-control mb">
                        <option value="sv">Sinh viên</option>
                        <option value="gv">Giảng viên</option>
                    </select>
                    <br>
                    <label for="taikhoan" class="label-left">Tài khoản:
                        <span id="taikhoanError" class="error"></span>
                    </label>
                    <input type="text" placeholder="Tài khoản" name="taikhoan" id="taikhoan" class="form-control mb">
                    <br>
                    <label for="password" class="label-left">Mật khẩu:
                        <span id="passwordError" class="error"></span>
                    </label>
                    <input type="password" placeholder="Mật khẩu" name="password" id="password" class="form-control mb">
                    <span id="loginError" class="error"></span>
                    <br>
                    <br>
                    <button class="btn btn-primary btn-block" name="login" type="submit">Đăng nhập</button>
                    <small><a href="index.php?action=forgetpass" class="text-dark">Quên mật khẩu ?</a></small>
                </form>
            </div>
        </div>
    </div>
</body>


</html>
<link rel="stylesheet" href="View/assets/css/login.css">
<script>
$(document).ready(function() {
    $('.login-form').submit(function(e) {
        e.preventDefault();
        var taikhoan = $('input[name="taikhoan"]').val();
        var password = $('input[name="password"]').val();
        var hasError = false;

        if (taikhoan == "") {
            $('#taikhoanError').text('(* Vui lòng nhập tài khoản của bạn !*)');
            hasError = true;
        } else {
            $('#taikhoanError').text('');
        }

        if (password == "") {
            $('#passwordError').text('(* Vui lòng nhập mật khẩu của bạn !*)');
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
            success: function(res) {
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
</script>