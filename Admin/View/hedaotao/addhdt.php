<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm hệ đào tạo</title>
    <link rel="stylesheet" href="View/assets/css/hedaotao/addhdt.css">
</head>

<body>
    <form action="index.php?action=hedaotao&act=insert_action" method="POST">
        <h2>Thêm hệ đào tạo</h2>
        <label for="tenhdt">Tên hệ đào tạo:</label>
        <input type="text" id="tenhdt" name="tenhdt" required><br>
        <label for="mahdt">Mã hệ đào tạo:</label>
        <input type="text" id="mahdt" name="mahdt" required><br>
        <button type="submit" name="submit">Thêm</button>
    </form>
</body>

</html>