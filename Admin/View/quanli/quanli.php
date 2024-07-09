<?php
require_once "./Model/nhanvien.php";
$quanli_model = new quanli();
$quanli_list = $quanli_model->getQuanLi();
?>
<br>
<div class="nav">
    <p><a href="index.php?action=home"><i class="fa-solid fa-house"></i></a> >
        <a href="index.php?action=quanli">Danh sách quản lí</a> >
        <a href="index.php?action=quanli&act=insert_quanli" class="btn-add"><i class="fa-solid fa-plus"></i> Thêm
            mới</a>
    </p>
</div>
<div>
    <table>
        <tr>
            <th>ID</th>
            <th>Tên quản lí</th>
            <th>Email</th>
            <th></th>
        </tr>
        <?php foreach ($quanli_list as $quanli) { ?>
        <tr>
            <td><?php echo $quanli['idql'] ?></td>
            <td><?php echo $quanli['username'] ?></td>
            <td><?php echo $quanli['email'] ?></td>
            <td>
                <a class="btn btn-info"
                    href="index.php?action=quanli&act=update_quanli&id=<?php echo $quanli['idql']; ?>"><i
                        class="fa-solid fa-pen-to-square"></i></a>
                <a class="btn btn-danger"
                    href="index.php?action=quanli&act=delete_quanli&delete_id=<?php echo $quanli['idql']; ?>"
                    onclick="return confirm('Bạn có chắc muốn xóa sinh viên này không ?')"><i
                        class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
<link rel="stylesheet" href="View/assets/css/quanli/quanli.css">