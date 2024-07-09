<!DOCTYPE html>
<html lang="en">
<?php
if (isset($_GET['id'])) {
    $idql = $_GET['id'];
    require_once "./Model/nhanvien.php";
    $quanli_model = new quanli();
    $quanli_info = $quanli_model->getQuanLiById($idql);
} else {
    header("Location: index.php?action=quanli");
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Quan Li</title>
    <link rel="stylesheet" href="View/assets/css/quanli/editquanli.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="well bk-light">
                <form method="post" action="index.php?action=quanli&act=update_action" id="editForm">
                    <h1 class=" text-center text-bold">Chỉnh sửa tài khoản</h1>
                    <input type="hidden" name="idql" id="idql" value="<?php echo $quanli_info['idql']?>">
                    <label for="" class="text-uppercase text-sm">Tên tài khoản </label>
                    <input type="text" placeholder="Tên tài khoản" name="username" id="username" class="form-control mb"
                        value="<?php echo $quanli_info['username']?>">
                    <span id="usernameError" class="error-text"></span>
                    <br>
                    <label for="" class="text-uppercase text-sm">Email </label>
                    <input type="email" placeholder="Email" name="email" id="email" class="form-control mb"
                        value="<?php echo $quanli_info['email']?>">
                    <span id="emailError" class="error-text"></span>
                    <br>
                    <label for="" class="text-uppercase text-sm">Nhập mật khẩu cũ</label>
                    <input type="password" placeholder="Nhập mật khẩu" name="password" id="password"
                        class="form-control mb">
                    <span id="passwordError" class="error-text"></span>
                    <br>
                    <label for="" class="text-uppercase text-sm">Nhập mật khẩu mới</label>
                    <input type="password" placeholder="Nhập mật khẩu" name="password_new" id="password_new"
                        class="form-control mb">
                    <span id="password_new_Error" class="error-text"></span>
                    <br>
                    <label for="" class="text-uppercase text-sm">Nhập lại mật khẩu</label>
                    <input type="password" placeholder="Nhập lại mật khẩu" id="confirmpassword" name="confirmPassword"
                        class="form-control mb">
                    <span id="confirmPasswordError" class="error-text"></span>
                    <br>
                    <br>
                    <button class="btn btn-primary btn-block" type="submit">Chỉnh sửa</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#editForm').on('submit', function(event) {
            event.preventDefault();

            var hasError = false;
            var username = $('#username').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var password_new = $('#password_new').val();
            var confirmpassword = $('#confirmpassword').val();
            var idql = $('#idql').val();

            var specialCharPattern = /[~!@#$%^&*()_+`\-={}[\]:;"'<>,.?/\\|]/;

            if (username === "") {
                $('#usernameError').text("(* Vui lòng nhập tên tài khoản *)");
                hasError = true;
            } else if (specialCharPattern.test(username)) {
                $('#usernameError').text("(* Tên tài khoản không được chứa kí tự đặc biệt *)");
                hasError = true;
            } else {
                $('#usernameError').text("");
            }

            var emailRegex = /^[^\s@]+@gmail\.com$/;
            var emailPromise = $.Deferred();
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
                    url: 'View/ajax-url/check_email_ql.php',
                    method: 'GET',
                    data: {
                        email: email,
                        id: idql,
                        role: 'edit'
                    },
                    success: function(response) {
                        if (response === "exists") {
                            $('#emailError').text('(* Email đã tồn tại.*)');
                            hasError = true;
                        } else {
                            $('#emailError').text('');
                        }
                        emailPromise.resolve();
                    },
                    error: function() {
                        alert('Có lỗi xảy ra khi kiểm tra email. Vui lòng thử lại sau.');
                        hasError = true;
                        emailPromise.resolve();
                    }
                });
            }

            var passwordPromise = $.Deferred();
            if (password === "") {
                $('#passwordError').text("(* Vui lòng nhập mật khẩu cũ *)");
                hasError = true;
                passwordPromise.resolve();
            } else if (password.length < 6) {
                $('#passwordError').text("(* Mật khẩu phải có ít nhất 6 kí tự *)");
                hasError = true;
                passwordPromise.resolve();
            } else {
                $.ajax({
                    url: 'View/ajax-url/check_pass_ql.php',
                    method: 'GET',
                    data: {
                        password: password,
                        id: idql
                    },
                    success: function(response) {
                        if (response === "not_exists") {
                            $('#passwordError').text('(*Sai mật khẩu, vui lòng nhập lại*)');
                            hasError = true;
                        } else {
                            $('#passwordError').text('');
                        }
                        passwordPromise.resolve();
                    },
                    error: function() {
                        alert('Có lỗi xảy ra khi kiểm tra mật khẩu. Vui lòng thử lại sau.');
                        hasError = true;
                        passwordPromise.resolve();
                    }
                });
            }

            if (password_new === "") {
                $('#password_new_Error').text("(* Vui lòng nhập mật khẩu mới*)");
                hasError = true;
            } else if (password_new.length < 6) {
                $('#password_new_Error').text("(* Mật khẩu phải có ít nhất 6 kí tự *)");
                hasError = true;
            } else if (password_new === password) {
                $('#password_new_Error').text("(* Mật khẩu mới không được trùng với mật khẩu cũ *)");
                hasError = true;
            } else {
                $('#password_new_Error').text("");
            }

            if (confirmpassword === "") {
                $('#confirmPasswordError').text("(* Vui lòng nhập lại mật khẩu *)");
                hasError = true;
            } else if (confirmpassword !== password_new) {
                $('#confirmPasswordError').text("(* Mật khẩu không trùng khớp *)");
                hasError = true;
            } else {
                $('#confirmPasswordError').text("");
            }

            $.when(emailPromise, passwordPromise).done(function() {
                if (!hasError) {
                    $('#editForm')[0].submit();
                }
            });
        });
    });
    </script>
</body>

</html>