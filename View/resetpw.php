<body>
    <div class="container">
        <h1>Reset Password</h1>
        <form method="post" action="index.php?action=forgetpass&act=resetpass" class="reset-form">
            <div class="form-group">
                <label for="code">Nhập Code:</label>
                <input type="text" id="code" name="code" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu mới:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Xác nhận mật khẩu mới:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" name="submit_password" class="btn btn-primary">Xác nhận</button>
            <a href="index.php?action=login" class="btn btn-danger">Hủy</a>
        </form>
    </div>
</body>
<link rel="stylesheet" href="View/assets/css/resetpw.css">