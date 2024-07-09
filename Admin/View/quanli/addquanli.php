<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account Creation</title>
    <link rel="stylesheet" href="View/assets/css/quanli/addquanli.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="well mt-5" style="border:1px solid black; border-radius:15px;">
                <form method="post" action="index.php?action=quanli&act=insert_action" class="" name="myForm">
                    <h1 class="text-center text-bold">Tạo tài khoản</h1>
                    <label for="" class="text-uppercase text-sm">Tên tài khoản </label>
                    <input type="text" placeholder="Tên tài khoản" name="username" id="username"
                        class="form-control mb">
                    <span id="usernameError" class="error-text"></span>
                    <br>
                    <label for="" class="text-uppercase text-sm">Email </label>
                    <input type="email" placeholder="Email" name="email" id="email" class="form-control mb">
                    <span id="emailError" class="error-text"></span>
                    <br>
                    <label for="" class="text-uppercase text-sm">Nhập mật khẩu</label>
                    <input type="password" placeholder="Nhập mật khẩu" name="password" id="password"
                        class="form-control mb">
                    <span id="passwordError" class="error-text"></span>
                    <br>
                    <label for="" class="text-uppercase text-sm">Nhập lại mật khẩu</label>
                    <input type="password" placeholder="Nhập lại mật khẩu" id="confirmpassword" name="confirmPassword"
                        class="form-control mb">
                    <span id="confirmPasswordError" class="error-text"></span>
                    <br>
                    <br>
                    <button class="btn btn-primary btn-block" name="login" type="submit">Xác nhận</button>
                </form>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('form').on('submit', function(event) {
            event.preventDefault();
            var hasError = false;
            var username = $('#username').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var confirmpassword = $('#confirmpassword').val();

            // validate ten tai khoan
            var specialCharPattern = /[~!@#$%^&*()_+`\-={}[\]:;"'<>,.?/\\|]/;
            if (username == "") {
                $('#usernameError').text("(* Vui lòng nhập tên tài khoản *)");
                hasError = true;
            } else if (specialCharPattern.test(username)) {
                $('#usernameError').text("(* Tên tài khoản không được chứa kí tự đặc biệt *)");
                hasError = true;
            } else {
                $('#usernameError').text("");
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
                $.ajax({
                    url: 'View/ajax-url/check_email_ql.php',
                    method: 'GET',
                    data: {
                        email: email,
                        role: 'add'
                    },
                    success: function(response) {
                        if (response === "exists") {
                            $('#emailError').text('(* Email đã tồn tại.*)');
                            hasError = true;
                        } else {
                            $('#emailError').text('');
                        }
                    },
                    error: function() {
                        alert('Có lỗi xảy ra khi kiểm tra email. Vui lòng thử lại sau.');
                        hasError = true;
                    }
                });
            }
            // validate mat khau
            if (password == "") {
                $('#passwordError').text("(* Vui lòng nhập mật khẩu *)");
                hasError = true;
            } else if (password.length < 6) {
                $('#passwordError').text("(* Mật khẩu phải có ít nhất 6 kí tự *)");
                hasError = true;
            } else {
                $('#passwordError').text("");
            }
            // validate nhap lai mat khau
            if (confirmpassword == "") {
                $('#confirmPasswordError').text("(* Vui lòng nhập lại mật khẩu *)");
                hasError = true;
            } else if (confirmpassword != password) {
                $('#confirmPasswordError').text("(* Mật khẩu không trùng khớp *)");
                hasError = true;
            } else {
                $('#confirmPasswordError').text("");
            }
            if (hasError) {
                return;
            }
            this.submit();


        })
    })
    </script>
</body>

</html>