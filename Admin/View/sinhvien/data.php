<table border=1 width="100%">
    <caption>
        <h3 align="center">Danh sách sinh viên</h3>
    </caption>
    <tr align="center">
        <th style="border: 1px solid black;">STT</th>
        <th style="border: 1px solid black;">MSSV</th>
        <th style="border: 1px solid black;">Tên Sinh Viên</th>
        <th style="border: 1px solid black;">Email</th>
        <th style="border: 1px solid black;">Ngày sinh</th>
        <th style="border: 1px solid black;">Số điện thoại</th>
        <th style="border: 1px solid black;">Giới tính</th>
        <th style="border: 1px solid black;">Địa chỉ</th>
        <th style="border: 1px solid black;">CCCD</th>
        <th style="border: 1px solid black;">Lớp</th>
        <th style="border: 1px solid black;">Chuyên Ngành</th>
        <th style="border: 1px solid black;">Khoa</th>
        <th style="border: 1px solid black;">Hệ Đào Tạo</th>
    </tr>
    <?php
    $i=1;
  require_once "./Model/sinhvien.php";
  $sinhvien_model=new sinhvien();
  $sinhvien_list=$sinhvien_model->getSinhVienList();
  foreach($sinhvien_list as $row) :
    $diachi = $row['diachi'];
    $diachi_parts = explode(',', $diachi,4);
    $province_id = $diachi_parts[0];
    $district_id = $diachi_parts[1];
    $wards_id = $diachi_parts[2];
    $diachi_chitiet = $diachi_parts[3];

    require_once "./Model/diachi.php";
    $diachi_model = new diachi();
    $tinh = $diachi_model->getTinhbyId($province_id);
    $quan= $diachi_model->getQuanbyId($district_id);
    $xa= $diachi_model->getXabyId($wards_id);
  ?>
    <tr align="center">
        <td style="border: 1px solid black;"> <?php echo $i++; ?> </td>
        <td style="border: 1px solid black;"> <?php echo $row["mssv"]; ?> </td>
        <td style="border: 1px solid black;"> <?php echo $row["tensv"]; ?> </td>
        <td style="border: 1px solid black;"> <?php echo $row["email"]; ?> </td>
        <td style="border: 1px solid black;"> <?php echo $row["ngaysinh"]; ?> </td>
        <td style="border: 1px solid black;"> <?php echo '&nbsp;' .$row["sodienthoai"]; ?> </td>
        <td style="border: 1px solid black;"> <?php echo $row["gioitinh"]; ?> </td>
        <td style="border: 1px solid black;">
            <?php echo $diachi_chitiet.', '.$xa['name'].', '.$quan['name'].', '.$tinh['name']; ?>
        </td>
        <td style="border: 1px solid black;"> <?php echo '&nbsp;' .$row["cccd"]; ?> </td>
        <td style="border: 1px solid black;"> <?php echo $row["tenlop"]; ?> </td>
        <td style="border: 1px solid black;"> <?php echo $row["tennganh"]; ?> </td>
        <td style="border: 1px solid black;"> <?php echo $row["tenkhoa"]; ?> </td>
        <td style="border: 1px solid black;"> <?php echo $row["tenhdt"]; ?> </td>


    </tr>
    <?php endforeach; ?>
</table>