<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin Hệ Đào Tạo</title>
    <link rel="stylesheet" href="View/assets/css/hedaotao/edithdt.css">

</head>

<body>
    <?php
    // Lấy thông tin hedaotao từ URL
    $idhdt = $_GET['id'];
    require_once "./Model/hedaotao.php";
    $hedaotao_model = new hedaotao();
    $hedaotao_info = $hedaotao_model->getHeDaoTaoById($idhdt);
    ?>
    <form action="index.php?action=hedaotao&act=update_action" method="POST">
        <h2>Sửa tt Hệ Đào Tạo</h2>
        <input type="hidden" name="idhdt" value="<?php echo $idhdt; ?>">
        <label for="tenhedaotao">Tên Hệ Đào Tạo:</label>
        <input type="text" id="tenhdt" name="tenhdt" value="<?php echo $hedaotao_info['tenhdt']; ?>" required><br>
        <label for="mahdt">Mã Hệ Đào Tạo:</label>
        <input type="text" id="mahdt" name="mahdt" value="<?php echo $hedaotao_info['mahdt']; ?>" required><br>
        <button type="submit" name="submit">Cập nhật</button>
    </form>
</body>

</html>