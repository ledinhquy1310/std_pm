<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Import Form</title>
    <style>
    .form-container {
        margin: 20px auto;
        padding: 20px;
        border: 1px solid black;
        border-radius: 5px;
        max-width: 500px;
        background-color: rgb(249, 246, 224);
    }

    input[type="file"] {
        display: block;
        margin-bottom: 10px;
    }

    button {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 3px;
        padding: 10px 20px;
        cursor: pointer;
    }

    li.warning {
        list-style: inside;
    }

    button:hover {
        background-color: #0056b3;
    }
    </style>
</head>

<body>

    <a href="View/assets/upload/example_file.xlsx" style="color:#0056b3;text-decoration: underline;">Tải mẫu ở đây</a>
    <form class="form-container" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <p class="text-danger">*Lưu Ý*</p>
        <ul>
            <li class="warning">Vui lòng thực hiện điền thông theo tin theo mẫu đã cung cấp, không sử dụng mẫu bên
                ngoài!</li>
            <li class="warning">Nhập và kiểm tra đầy đủ thông tin dữ liệu trước khi upload!</li>
            <li class="warning">Dữ liệu vào không được chứa ký tự đặc biệt!</li>
            <li class="warning">Địa chỉ phải nhập đầy đủ theo định dạng ( Tổ,Ấp, Xã/Thị trấn, Quận/Huyện, Tỉnh )</li>
            <li class="warning">Mã Sinh viên không được phép trống!</li>
        </ul>
        <input type="file" name="excel" accept=".xlsx, .xls" id="file" class="form-control">
        <span id="Error" style="color: red;"></span><br>
        <button type="submit" name="import">Import</button>
    </form>

    <script>
    function validateForm() {
        var fileInput = document.querySelector('input[type="file"]');
        var fileName = fileInput.value;
        var allowedExtensions = /(\.xlsx|\.xls)$/i;
        var file = document.getElementById("file").value;
        if (file === '') {
            document.getElementById("Error").innerText = 'Vui lòng chọn file Excel!';
            return false;
        }
        if (!allowedExtensions.exec(fileName)) {
            document.getElementById("Error").innerText =
                'Chỉ được phép chọn file Excel có phần mở rộng .xlsx hoặc .xls';
            return false;
        }
        return true;
    }
    </script>

    <?php
if (isset($_POST["import"])) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('error_log', 'php_errors.log');

    $fileName = $_FILES["excel"]["name"];
    $fileExtension = explode('.', $fileName);
    $fileExtension = strtolower(end($fileExtension));
    $newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

    $targetDirectory = "View/assets/upload/" . $newFileName;

    if (move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory)) {
        require 'excelReader/excel_reader2.php';
        require 'excelReader/SpreadsheetReader.php';

        try {
            $reader = new SpreadsheetReader($targetDirectory);
            $skippedRows = 3;
            $currentRow = 0;

            foreach ($reader as $key => $row) {
                if ($currentRow < $skippedRows) {
                    $currentRow++;
                    continue;
                }
                if (empty(array_filter($row))) {
                    continue;
                }

                $mssv = $row[1];
                $password = $row[1];
                $tensv = $row[2];
                $email = $row[3];
                $ngaysinh = $row[4];
                $sodienthoai = $row[5];
                $gioitinh = $row[6];

                $diachi_excel = $row[7];
                $diachi_parts = explode(',', $diachi_excel);
                $province = trim(array_pop($diachi_parts));
                $district = trim(array_pop($diachi_parts));
                $wards = trim(array_pop($diachi_parts));
                $diachi_chitiet = trim(implode(',', $diachi_parts));

                require_once "./Model/diachi.php";
                $diachi_model = new diachi();
                $tinh_list = $diachi_model->getTinh();
                foreach ($tinh_list as $tinh) {
                    if (strtolower($province) == strtolower($tinh['name'])) {
                        $province_id = $tinh['province_id'];
                    }
                }
                $quan_list = $diachi_model->getquan();
                foreach ($quan_list as $quan) {
                    if (strtolower($district) == strtolower($quan['name']) && $province_id == $quan['province_id']) {
                        $district_id = $quan['district_id'];
                    }
                }
                $xa_list = $diachi_model->getxa();
                foreach ($xa_list as $xa) {
                    if (strtolower($wards) == strtolower($xa['name']) && $district_id==$xa['district_id']) {
                        $wards_id = $xa['wards_id'];
                    }
                }
                $diachi = $province_id . ',' . $district_id . ',' . $wards_id . ',' . $diachi_chitiet;

                $cccd = $row[8];

                require_once "./Model/lop.php";
                $lop_model = new lop();
                $lop_list = $lop_model->getLop();
                $lop_excel = $row[9];
                foreach ($lop_list as $lop_dtb) {
                    if ($lop_excel == $lop_dtb['tenlop']) {
                        $lop = $lop_dtb['idlop'];
                    }
                }

                require_once "./Model/nganh.php";
                $nganh_model = new nganh();
                $nganh_list = $nganh_model->getnganh();
                $nganh_excel = $row[10];
                foreach ($nganh_list as $nganh_dtb) {
                    if ($nganh_excel == $nganh_dtb['tennganh']) {
                        $nganh = $nganh_dtb['idnganh'];
                    }
                }

                require_once "./Model/hedaotao.php";
                $hedaotao_model = new hedaotao();
                $hedaotao_list = $hedaotao_model->gethedaotao();
                $hedaotao_excel = $row[11];
                foreach ($hedaotao_list as $hedaotao_dtb) {
                    if ($hedaotao_excel == $hedaotao_dtb['tenhdt']) {
                        $hedaotao = $hedaotao_dtb['idhdt'];
                    }
                }

                require_once './Model/sinhvien.php';
                $sinhvien = new sinhvien();
                $check = $sinhvien->insertSinhVien($mssv, $tensv, $email, $password, $ngaysinh, $sodienthoai, $gioitinh, $diachi, $cccd, $lop, $nganh, $hedaotao);
            }

            echo "
            <script>
            alert('Upload Sinh Viên Thành công!');
            document.location.href = '';
            </script>
            ";
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        echo "
        <script>
        alert('Upload Sinh Viên Thất bại!');
        document.location.href = '';
        </script>
        ";
    }
}
?>

</body>

</html>