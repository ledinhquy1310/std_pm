<?php 
require_once '../../Model/connect.php';
require_once '../../Model/nganh.php';
$request=$_POST['request'];
$nganh_model = new nganh();
$nganh_list = $nganh_model->getnganhByKhoa($request);
$count=$nganh_model->countnganhbykhoa($request);
?>
<table>
    <?php if($count>=1){?>
    <tr>
        <th>Tên Chuyên Ngành</th>
        <th>Mã Ngành</th>
        <th>Khoa</th>
        <th></th>
    </tr>
    <?php foreach ($nganh_list as $nganh): ?>
    <tr>
        <td>
            <?php echo $nganh['tennganh']; ?>
        </td>
        <td>
            <?php echo $nganh['manganh']; ?>
        </td>
        <td>
            <?php echo $nganh['tenkhoa']; ?>
        </td>
        <td>
            <a href="index.php?action=nganh&act=update_nganh&id=<?php echo $nganh['idnganh']; ?>"
                class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
            <a href="index.php?action=nganh&act=delete_nganh&delete_id=<?php echo $nganh['idnganh']; ?>"
                class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa nganh này không ?')">
                <i class="fa-solid fa-trash"></i></a>
        </td>
    </tr>
    <?php endforeach;  
    }else{
        echo "<p class='text-center text-danger'>Không tìm thấy ngành</p>";

    }?>
</table>