<div class="container mt-5 mb-3">
    <h1>Đổi mật khẩu</h1>
    <form action="index.php?action=login&act=changepassword" method="post" id="passwordForm">
        <div>
            <label for="old_password">Mật khẩu cũ:</label>
            <input type="password" id="old_password" name="old_password">
            <span id="old_passwordError" class="text-danger"></span>
        </div>
        <div>
            <label for="new_password">Mật khẩu mới:</label>
            <input type="password" id="new_password" name="new_password">
            <span id="new_passwordError" class="text-danger"></span>

        </div>
        <div>
            <label for="confirm_password">Xác nhận mật khẩu mới:</label>
            <input type="password" id="confirm_password" name="confirm_password">
            <span id="confirm_passwordError" class="text-danger"></span>

        </div>
        <br>
        <button type="submit">Thay đổi mật khẩu</button>
    </form>
</div>
<script>
$(document).ready(function() {
    $('#passwordForm').on('submit', function(event) {
        event.preventDefault();
        var hasError = false;
        var old_password = $('#old_password').val();
        var new_password = $('#new_password').val();
        var confirm_password = $('#confirm_password').val();
        var id = '';
        if ($('#idsv').length) {
            id = $('#idsv').val();
        } else if ($('#idgv').length) {
            id = $('#idgv').val();
        }
        var type = '';
        if ($('#idsv').length) {
            type = 'sinhvien';
        } else if ($('#idgv').length) {
            type = 'giangvien';
        }
        //  old password 
        if (old_password === "") {
            $('#old_passwordError').text("(* Vui lòng nhập mật khẩu cũ *)");
            hasError = true;
        } else {
            $.ajax({
                url: 'View/ajax-url/check_pass.php',
                method: 'GET',
                data: {
                    old_password: old_password,
                    id: id,
                    type: type,
                },
                success: function(response) {
                    if (response === "not_exists") {
                        $('#old_passwordError').text(
                            '(*Sai mật khẩu, vui lòng nhập lại*)');
                    } else {
                        $('#old_passwordError').text('');
                    }
                },
                error: function() {
                    alert('Có lỗi xảy ra khi kiểm tra mật khẩu. Vui lòng thử lại sau.');
                }
            });
        }

        //  new password
        if (new_password === "") {
            $('#new_passwordError').text("(* Vui lòng nhập mật khẩu mới*)");
            hasError = true;
        } else if (new_password.length < 6) {
            $('#new_passwordError').text("(* Mật khẩu phải có ít nhất 6 kí tự *)");
            hasError = true;
        } else if (new_password === old_password) {
            $('#new_passwordError').text("(* Mật khẩu mới không được trùng với mật khẩu cũ *)");
            hasError = true;
        } else {
            $('#new_passwordError').text("");
        }

        if (confirm_password === "") {
            $('#confirm_passwordError').text("(* Vui lòng nhập lại mật khẩu *)");
            hasError = true;
        } else if (confirm_password !== new_password) {
            $('#confirm_passwordError').text("(* Mật khẩu không trùng khớp *)");
            hasError = true;
        } else {
            $('#confirm_passwordError').text("");
        }
        if (!hasError) {
            $('#passwordForm')[0].submit();
        }
    });
});
</script>
<link rel="stylesheet" href="View/assets/css/home.css">