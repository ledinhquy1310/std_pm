<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php');
spl_autoload_register();
$act = "delete_lichhen";
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}
switch ($act) {
    case 'delete_lichhen':
        if (isset($_POST['delete_id'])) {
            $delete_id = $_POST['delete_id'];    
            $lichhen = new lichhen();
            $result = $lichhen->deletelichhen($delete_id);

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
        case 'delete_lichhen_sended':
            if (isset($_POST['delete_id'])) {
                $delete_id = $_POST['delete_id'];    
                $lichhen = new lichhen();
                $result = $lichhen->deletelichhensended($delete_id);
    
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
}
?>