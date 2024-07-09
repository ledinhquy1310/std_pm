<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign in</title>
    <link rel="stylesheet" href="View/assets/css/login.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="well bk-light">
                <form method="post" action="index.php?action=login&act=login_action" class="login-form">
                    <h1 class="text-bold">Đăng nhập</h1>
                    <label for="txtemail" class="label-left">Email
                        <span id="emailError" class="error"></span>
                    </label>
                    <input type="text" placeholder="Email" name="txtemail" id="txtemail" class="form-control mb">

                    <br>
                    <label for="txtpassword" class="label-left">Password
                        <span id="passwordError" class="error"></span>
                    </label>
                    <input type="password" placeholder="Password" name="txtpassword" id="txtpassword"
                        class="form-control mb">
                    <span id="loginError" class="error"></span>
                    <br>
                    <button class="btn btn-primary btn-block" name="login" type="submit">Đăng nhập</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="ajax/login_validate.js"></script>
</body>

</html>