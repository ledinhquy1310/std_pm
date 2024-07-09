<?php 
    require_once '../../Model/connect.php';
    require_once "../../Model/giangvien.php";
    $giangvien_model = new giangvien();
    $search = $_POST['search'];
    $gv_count=$giangvien_model->countGVByName($search);
    $giangvien_list = $giangvien_model->searchGiangVienByName($search);
?>
<?php if ($gv_count==0) { ?>
<p class="text-center text-danger">Không tìm thấy giảng viên</p>
<?php } else { ?>
<table id="table">
    <tr>
        <th>Mã Giảng Viên</th>
        <th>Tên Giảng Viên</th>
        <th>Trình độ</th>
        <th>Chuyên Ngành</th>
        <th>Khoa</th>
        <th></th>
    </tr>
    <?php foreach ($giangvien_list as $giangvien): ?>
    <tr>
        <td><?php echo $giangvien['magv']; ?></td>
        <td>
            <a style="color: black; cursor: pointer;" data-bs-toggle="modal"
                data-bs-target="#exampleModal<?php echo $giangvien['idgv']; ?>">
                <?php echo $giangvien['tengv']; ?>
            </a>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal<?php echo $giangvien['idgv']; ?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="margin-left:150px">
                    <div class="modal-content" style="width:1000px">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thông tin giảng viên</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table style="width:960px">
                                <tr>
                                    <th colspan="2">
                                        <h2>Thông tin giảng viên</h2>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Mã giảng viên</th>
                                    <td><?php echo $giangvien['magv']; ?></td>
                                </tr>
                                <tr>
                                    <th>Tên giảng viên</th>
                                    <td><?php echo $giangvien['tengv']; ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?php echo $giangvien['email_gv']; ?></td>
                                </tr>
                                <tr>
                                    <th>Trình độ</th>
                                    <td><?php echo $giangvien['tentd']; ?></td>
                                </tr>
                                <tr>
                                    <th>Số điện thoại</th>
                                    <td><?php echo $giangvien['sodienthoai']; ?></td>
                                </tr>
                                <tr>
                                    <th>Khoa</th>
                                    <td><?php echo $giangvien['tenkhoa']; ?></td>
                                </tr>
                                <tr>
                                    <th>Ngành</th>
                                    <td><?php echo $giangvien['tennganh']; ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
        </td>

        <td><?php echo $giangvien['tentd']; ?></td>
        <td><?php echo $giangvien['tennganh']; ?></td>
        <td><?php echo $giangvien['tenkhoa']; ?></td>
        <td>
            <a class="btn btn-info"
                href="index.php?action=giangvien&act=update_giangvien&id=<?php echo $giangvien['idgv']; ?>"><i
                    class="fa-solid fa-pen-to-square"></i></a>
            <a class="btn btn-danger"
                href="index.php?action=giangvien&act=delete_giangvien&delete_id=<?php echo $giangvien['idgv']; ?>"
                onclick="return confirm('Bạn có chắc muốn xóa sinh viên này không ?')"><i
                    class="fa-solid fa-trash"></i></a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php }?>