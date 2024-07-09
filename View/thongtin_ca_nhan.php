<div class="container mt-5 mb-3">
    <h1>Thông tin Cá nhân</h1>
    <br>
    <div class="content">
        <?php if (isset($_SESSION['mssv'])) {
                   ?>
        <table class="table table-bordered">
            <tbody>
                <input type="hidden" id="idsv" value="<?php echo isset($_SESSION['idsv']) ? $_SESSION['idsv'] : ''; ?>">
                <tr>
                    <th>MSSV |</th>
                    <td><?php echo isset($_SESSION['mssv']) ? $_SESSION['mssv'] : ''; ?></td>
                </tr>
                <tr>
                    <th>Tên sinh viên |</th>
                    <td><?php echo isset($_SESSION['tensv']) ? $_SESSION['tensv'] : ''; ?></td>
                </tr>
                <tr>
                    <th>Email |</th>
                    <td><?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?></td>
                </tr>
                <tr>
                    <th>Ngày sinh |</th>
                    <td>
                        <?php  $date = new DateTime($_SESSION['ngaysinh']);
                                echo isset($_SESSION['ngaysinh'])? $date->format('d/m/Y') : ''; ?>
                    </td>
                </tr>
                <tr>
                    <th>Số điện thoại |</th>
                    <td><?php echo isset($_SESSION['sodienthoai']) ? $_SESSION['sodienthoai'] : ''; ?></td>
                </tr>
                <tr>
                    <th>Chuyên ngành |</th>
                    <td><?php echo isset($_SESSION['tennganh']) ? $_SESSION['tennganh'] : ''; ?></td>
                </tr>
                <tr>
                    <th>Hệ Đào Tạo |</th>
                    <td><?php echo isset($_SESSION['tenhdt']) ? $_SESSION['tenhdt'] : ''; ?></td>
                </tr>
                <tr>
                    <th>Lớp |</th>
                    <td><?php echo isset($_SESSION['tenlop']) ? $_SESSION['tenlop'] : ''; ?></td>
                </tr>
                <tr>
                    <th>Địa chỉ |</th>
                    <td><?php if(isset($_SESSION['diachi'])){
                        $diachi = $_SESSION['diachi'];
                        $diachi_parts = explode(',', $diachi);
                        $province_id = $diachi_parts[0];
                        $district_id = $diachi_parts[1];
                        $wards_id = $diachi_parts[2];
                        $diachi_chitiet = $diachi_parts[3];
                        require_once "./Model/diachi.php";
                        $diachi_model = new diachi();
                        $tinh = $diachi_model->getTinhbyId($province_id);
                        $quan= $diachi_model->getQuanbyId($district_id);
                        $xa= $diachi_model->getXabyId($wards_id);
                        echo $diachi_chitiet.','.$xa['name'].','.$quan['name'].','.$tinh['name'];
                    }; ?></td>
                </tr>
            </tbody>
        </table>
        <?php }
        else if (isset($_SESSION['magv'])) {
           ?>
        <table class="table table-bordered">
            <input type="hidden" id="idgv" value="<?php echo isset($_SESSION['idgv']) ? $_SESSION['idgv'] : ''; ?>">
            <tbody>
                <tr>
                    <th>Mã Giảng Viên |</th>
                    <td><?php echo isset($_SESSION['magv']) ? $_SESSION['magv'] : ''; ?></td>
                </tr>
                <tr>
                    <th>Tên Giảng Viên |</th>
                    <td><?php echo isset($_SESSION['tengv']) ? $_SESSION['tengv'] : ''; ?></td>
                </tr>
                <tr>
                    <th>Trình độ |</th>
                    <td><?php echo isset($_SESSION['tentd']) ? $_SESSION['tentd'] : ''; ?></td>
                </tr>
                <tr>
                    <th>Khoa |</th>
                    <td><?php echo isset($_SESSION['tenkhoa']) ? $_SESSION['tenkhoa'] : ''; ?></td>
                </tr>
                <tr>
                    <th>Số điện thoại |</th>
                    <td><?php echo isset($_SESSION['sodienthoai']) ? $_SESSION['sodienthoai'] : ''; ?></td>
                </tr>
                <tr>
                    <th>Chuyên ngành |</th>
                    <td><?php echo isset($_SESSION['tennganh']) ? $_SESSION['tennganh'] : ''; ?></td>
                </tr>
            </tbody>
        </table>
        <?php }?>
    </div>
</div>
<br>
<link rel="stylesheet" href="View/assets/css/home.css">