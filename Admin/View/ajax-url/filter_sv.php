<?php 
require_once '../../Model/connect.php';
require_once '../../Model/sinhvien.php';
$request=$_POST['request'];
$sinhvien_model = new sinhvien();
$sinhvien_list = $sinhvien_model->filterSinhVienByLop($request);
$sinhvien_count=$sinhvien_model->countStudents($request);
?>
<?php if ($sinhvien_count==0) { ?>
<p class="text-center text-danger">Không có sinh viên trong lớp này.</p>
<?php } else { ?>
<table id="table">
    <tr>
        <th>MSSV</th>
        <th>Tên sinh viên</th>
        <th>Thông tin</th>
        <th>Thông tin khác</th>
        <th></th>
    </tr>
    <?php
        foreach ($sinhvien_list as $sinhvien):
                $diachi = $sinhvien['diachi'];
                $diachi_parts = explode(',', $diachi);
                $province_id = $diachi_parts[0];
                $district_id = $diachi_parts[1];
                $wards_id = $diachi_parts[2];
                $diachi_chitiet = $diachi_parts[3];
                require_once "../../Model/diachi.php";
                $diachi_model = new diachi();
                $tinh = $diachi_model->getTinhbyId($province_id);
                $quan= $diachi_model->getQuanbyId($district_id);
                $xa= $diachi_model->getXabyId($wards_id);

        ?>
    <tr>
        <td><?php echo $sinhvien['mssv']; ?></td>
        <td><a style="color: black; cursor: pointer;" data-bs-toggle="modal"
                data-bs-target="#exampleModal<?php echo $sinhvien['idsv']; ?>">
                <?php echo $sinhvien['tensv']; ?>
            </a>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal<?php echo $sinhvien['idsv']; ?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="margin-left:150px">
                    <div class="modal-content" style="width:1000px">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thông tin sinh viên</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table style="width:960px">
                                <tr>
                                    <th colspan="2">
                                        <h2>Thông tin sinh viên</h2>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Mã số sinh viên</th>
                                    <td><?php echo $sinhvien['mssv']; ?></td>
                                </tr>
                                <tr>
                                    <th>Họ và tên</th>
                                    <td><?php echo $sinhvien['tensv']; ?></td>
                                </tr>
                                <tr>
                                    <th>Ngày sinh</th>
                                    <td><?php echo $sinhvien['ngaysinh']; ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?php echo $sinhvien['email']; ?></td>
                                </tr>
                                <tr>
                                    <th>Giới tính</th>
                                    <td><?php echo $sinhvien['gioitinh']; ?></td>
                                </tr>
                                <tr>
                                    <th>Số điện thoại</th>
                                    <td><?php echo $sinhvien['sodienthoai']; ?></td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ</th>
                                    <td><?php echo $diachi_chitiet.','.$xa['name'].','.$quan['name'].','.$tinh['name']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>CCCD</th>
                                    <td><?php echo $sinhvien['cccd']; ?></td>
                                </tr>
                                <tr>
                                    <th>Ngành</th>
                                    <td><?php echo $sinhvien['tennganh']; ?></td>
                                </tr>
                                <tr>
                                    <th>Lớp</th>
                                    <td><?php echo $sinhvien['tenlop']; ?></td>
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
        <td>
            <ul>
                <li>- Ngày sinh: <?php echo $sinhvien['ngaysinh']; ?></li>
                <li>- Số điện thoại: <?php echo $sinhvien['sodienthoai']; ?></li>
                <li>- Địa chỉ: <br>
                    <?php echo $diachi_chitiet.', '.$xa['name'].', <br>'.$quan['name'].','.$tinh['name']; ?>
                </li>
            </ul>
        </td>
        <td>
            <ul>
                <li>- Hệ đào tạo: <?php echo $sinhvien['tenhdt']; ?> </li>
                <li>- Ngành: <?php echo $sinhvien['tennganh']; ?> </li>
                <li>- Khoa: <?php echo $sinhvien['tenkhoa']; ?> </li>
                <li>- Lớp: <?php echo $sinhvien['tenlop']; ?> </li>
            </ul>
        </td>
        <td>
            <a class="btn btn-info"
                href="index.php?action=sinhvien&act=update_sinhvien&id=<?php echo $sinhvien['idsv']; ?>"><i
                    class="fa-solid fa-pen-to-square"></i></a>
            <a class="btn btn-danger"
                href="index.php?action=sinhvien&act=delete_sinhvien&delete_id=<?php echo $sinhvien['idsv']; ?>"
                onclick="return confirm('Bạn có chắc muốn xóa sinh viên này không ?')"><i
                    class="fa-solid fa-trash"></i></a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php }?>