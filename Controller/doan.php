<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php');
spl_autoload_register();
$act = "doan";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}

switch ($act) {
    case 'doan':
        include_once "./View/qldoan/qldoan.php";
        break;

    case 'insert_doan':
        include_once "./View/qldoan/add_doan.php";
        break;

    case 'insert_action':
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $tendoan = $_POST['tendoan'];
            $hinhanh = basename($_FILES["hinhanh"]["name"]);
            $linkdoan = $_POST['linkdoan'];
            $madoan = $_POST['madoan'];
            $idsv = $_POST['sinhvien'];
            $gvhd = $_POST['gvhd'];

            $target_img = "Admin/View/assets/img/";
            $target_hinhanh = $target_img . $hinhanh;
            
            $imageFileType = strtolower(pathinfo($target_hinhanh, PATHINFO_EXTENSION));
            $allow_img_ext = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($imageFileType, $allow_img_ext)) {
                echo '<script>alert("Hình ảnh phải là file có định dạng jpg, jpeg, png hoặc gif");</script>';
                include_once "./View/qldoan/add_doan.php";
                exit();
            }
            // Upload hình ảnh
            $upload = move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_hinhanh);
            if ($upload == false) {
                echo "Không upload được hình ảnh";
                echo "Lỗi: " . $_FILES["hinhanh"]["error"];
                include_once "./View/qldoan/add_doan.php";
                exit();
            }
            
            // file báo cáo
            $file = $_FILES["filename"]["name"];
            $size_allow=10;
            $newfile = basename($file); 
             
             // kiểm tra định dạng
             $allow_ext=['docx', 'doc'];
             $ext = pathinfo($newfile, PATHINFO_EXTENSION);
             if(in_array($ext,$allow_ext)){
                $size = $_FILES['filename']['size']/1024/1024;
               if($size<=$size_allow){
               $upload=move_uploaded_file($_FILES['filename']['tmp_name'],'Admin/View/assets/upload/'.$newfile);
               }
             }else {
                echo '<script>alert("File báo cáo phải là file word");</script>';
                include_once "./View/qldoan/add_doan.php";
                exit();
            }
            require_once './Model/doan.php';
            $doan = new Doan();
            $check = $doan->insertDoan($tendoan, $hinhanh,$newfile, $linkdoan, $madoan, $idsv, $gvhd);
            if ($check !== false) {
                $_SESSION['add_alert']=true;
                echo '<meta http-equiv=refresh content="0;url=index.php?action=doan"/>';
            } else {
                echo '<script>alert("Thêm đồ án không thành công");</script>';
                include_once "./View/qldoan/add_doan.php";
            }
        }
        break;

    case 'delete_doan':
        if (isset($_POST['delete_id'])) {
            $iddoan = $_POST['delete_id'];
            $doan = new Doan();
            $result = $doan->deleteDoan($iddoan);

            if ($result !==false) {
                $res=array(
                    "status"=>"success",
                    "message"=>"Xóa thành công"
                );
            }else {
                $res=array(
                    "status"=>"fail",
                    "message"=>"Xóa không thành công"
                );
            }
            echo json_encode($res);
        } 
        break;

    case 'update_doan':
        include_once "./View/qldoan/edit_doan.php";
        break;
    case "update_action":
        require_once './Model/doan.php';
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $iddoan = $_POST['iddoan'];
            $tendoan = $_POST['tendoan'];
            $linkdoan = $_POST['linkdoan'];
            $madoan = $_POST['madoan'];
            $idsv = $_POST['sinhvien'];
            $gvhd = $_POST['gvhd'];

            if (!empty($_FILES["hinhanh"]["name"])) {
                $hinhanh = basename($_FILES["hinhanh"]["name"]);
                $target_dir = "Admin/View/assets/img/";
                $target_file = $target_dir . $hinhanh;
                
                $imageFileType = strtolower(pathinfo($target_hinhanh, PATHINFO_EXTENSION));
                $allow_img_ext = ['jpg', 'jpeg', 'png', 'gif'];
                if (!in_array($imageFileType, $allow_img_ext)) {
                    echo '<script>alert("Hình ảnh phải là file có định dạng jpg, jpeg, png hoặc gif");</script>';
                    include_once "./View/qldoan/add_doan.php";
                    exit();
                }
                // Upload hình ảnh
                $upload = move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_hinhanh);
                if ($upload == false) {
                    echo "Không upload được hình ảnh";
                    echo "Lỗi: " . $_FILES["hinhanh"]["error"];
                    include_once "./View/qldoan/add_doan.php";
                    exit();
                }
            } else {
                $doan_model = new Doan();
                $existing_info = $doan_model->getDoanById($iddoan);
                $hinhanh = $existing_info['hinhanh'];
            }

            if (!empty($_FILES["filename"]["name"])) {
                $file = $_FILES["filename"]["name"];
                $size_allow = 10;
                $newfile = basename($file);
                
                $allow_ext = ['docx', 'doc'];
                $ext = pathinfo($newfile, PATHINFO_EXTENSION);
                
                if (in_array($ext, $allow_ext)) {
                    $size = $_FILES['filename']['size']/1024/1024;
                    if ($size <= $size_allow) {
                        $upload = move_uploaded_file($_FILES['filename']['tmp_name'], 'Admin/View/assets/upload/'.$newfile);
                    }
                }
                else {
                    echo '<script>alert("File báo cáo phải là file word");</script>';
                    include_once "./View/qldoan/add_doan.php";
                    exit();
                }
            } else {
                $doan_model = new Doan();
                $existing_info = $doan_model->getDoanById($iddoan);
                $newfile = $existing_info['baocao'];
            }
            
            $doan = new Doan();
            $check = $doan->updateDoan($iddoan, $tendoan, $hinhanh,$newfile, $linkdoan, $madoan, $idsv, $gvhd);

            if ($check !== false) {
                echo 'success';
                $_SESSION['edit_alert']=true;
                echo '<meta http-equiv=refresh content="0;url=index.php?action=doan"/>';
            } else {
                echo '<script>alert("Cập nhật đồ án không thành công");</s>';
                include_once "./View/qldoan/edit_doan.php";
            }
        }
        break;

    case "update_points_doan":
        include_once "./View/qldoan/points_doan.php";
        break;
    case "update_points_action":
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $iddoan = $_POST['iddoan'];
            $diem = $_POST['diem'];

            require_once './Model/doan.php';
            $doan = new Doan();
            $check = $doan->updatePointsDoan($iddoan, $diem);

            if ($check !== false) {
                $_SESSION['send']=true;
                echo '<meta http-equiv=refresh content="0;url=index.php?action=doan"/>';
            } else {
                echo '<script>alert("Cập nhật điểm không thành công");</script>';
                include_once "./View/qldoan/edit_doan.php";
            }
        }
        break;
        }        
?>