<?php
require_once "./Model/doan.php";
$doan_model = new Doan();
require_once "./Model/page.php";
$trang = new page();
$limit = 4;
if (isset($_SESSION['idsv'])) {
$count = $doan_model->getDoanbySV($_SESSION['idsv'])->rowCount();
$pages = $trang->findPage($count, $limit);
$start = $trang->findStart($limit);
$showPagination = true;
$doan_list = $doan_model->getDoanPagebySV($_SESSION['idsv'],$start, $limit);
}
elseif(isset($_SESSION['idgv'])){
    $count = $doan_model->getDoanbyGV($_SESSION['idgv'])->rowCount();
    $pages = $trang->findPage($count, $limit);
    $start = $trang->findStart($limit);
    $showPagination = true;
    $doan_list = $doan_model->getDoanPagebygv($_SESSION['idgv'],$start, $limit);
}

?>
<div>
    <br>
    <div class="nav">
        <p><a href="index.php?action=home"><i class="fa-solid fa-house"></i></a> > <a href="index.php?action=doan">
                Danh sách đồ án</a>
            <?php if (isset($_SESSION['idsv'])) { ?>
            > <a href="index.php?action=doan&act=insert_doan" class="btn-add"><i class="fa-solid fa-plus"></i> Thêm
                mới</a>
            <?php }?>
        <p>
    </div>
    <!-- them -->
    <?php if (isset($_SESSION['add_alert']) && $_SESSION['add_alert'] === true) {
        ?>
    <div class="alert alert-success alert-dismissible w-75" style="margin-left:180px" role="alert">
        <b>Thêm đồ án thành công !</b>
        <button type="button" class="btn-close pt-3" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
        unset($_SESSION['add_alert']);
        }
            ?>
    <!-- sua -->
    <?php if (isset($_SESSION['edit_alert']) && $_SESSION['edit_alert'] === true) {
        ?>
    <div class="alert alert-primary alert-dismissible w-75" style="margin-left:180px" role="alert">
        <b>Sửa đồ án thành công !</b>
        <button type="button" class="btn-close pt-3" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
        unset($_SESSION['edit_alert']);
        }
            ?>
    <!-- xóa -->
    <?php if (isset($_SESSION['delete_alert']) && $_SESSION['delete_alert'] === true) {
        ?>
    <div class="alert alert-danger alert-dismissible w-75" style="margin-left:180px" role="alert">
        <b>Xóa đồ án thành công !</b>
        <button type="button" class="btn-close pt-3" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
        unset($_SESSION['delete_alert']);
        }
        ?>
    <h5 class="text-center"><?php echo isset($_SESSION['idsv'])?"Đồ án cá nhân ":" Đồ án sinh viên" ?></h5>
    <?php if($count==0){ 
         echo "<p class='text-center text-danger' style='margin-top:50px;margin-bottom:300px'>Bạn không có đồ án nào!</p>";
    }else{?>
    <table>
        <tr>
            <th>Hình Ảnh</th>
            <th>Tên đồ án</th>
            <th>Người thực hiện</th>
            <th>Thông tin</th>
            <th></th>
        </tr>
        <!-- hiển thị đối vs sv -->
        <?php foreach ($doan_list as $doan) {
            if (isset($_SESSION['idsv']) && $doan['idsv'] == $_SESSION['idsv']) {
            ?>
        <?php $file_img = "Admin/View/assets/img/" . $doan['hinhanh'] ?>

        <tr>
            <td>
                <div data-id="<?php echo $doan['iddoan']?>" id="id"><img src="<?php echo $file_img ?>" alt=""></div>
            </td>
            <td>
                <?php echo $doan['tendoan'] ?><br>
                <a style="color:blue" href="<?php echo $doan['linkdoan'] ?>">- Link Online</a>
                <br>
                <a style="color:blue" href="Admin/View/assets/upload/<?php echo $doan['baocao'] ?>">- Tải báo cáo</a>
            </td>
            <td><?php echo $doan['tensv'] ?></td>
            <td>
                <ul>
                    <li>Niên khóa:<?php echo $doan['nienkhoa'] ?> </li>
                    <li>Lớp:<?php echo $doan['tenlop'] ?> </li>
                    <li>Chuyên ngành: <?php echo $doan['tennganh'] ?> </li>
                    <li>Khoa: <?php echo $doan['tenkhoa'] ?> </li>
                    <li>Gv hướng dẫn: <?php echo $doan['tengv'] ?> </li>
                    <li>Điểm: <?php 
                        if ($doan['diem'] == 0) {
                            echo "Chưa chấm điểm !";
                        } else {
                            echo $doan['diem'];
                        } ?>
                    </li>

                </ul>
            </td>
            <td>
                <a class="btn btn-info"
                    href="index.php?action=doan&act=update_doan&id=<?php echo $doan['iddoan']; ?>"><i
                        class="fa-solid fa-pen-to-square"></i></a>
                <a class="btn btn-danger" id="del-btn">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </td>
        </tr>

        <!-- hiển thị đối vs gv -->
        <?php }
        if (isset($_SESSION['idgv']) && $doan['gvhd'] == $_SESSION['idgv']) {
            ?>

        <?php $file_img = "Admin/View/assets/img/" . $doan['hinhanh'] ?>

        <tr>
            <td><img src="<?php echo $file_img ?>" alt=""></td>
            <td>
                <?php echo $doan['tendoan'] ?><br>
                <a style="color:blue" href="<?php echo $doan['linkdoan'] ?>">- Link Online</a>
                <br>
                <a style="color:blue" href="Admin/View/assets/upload/<?php echo $doan['baocao'] ?>">- Tải báo cáo</a>
            </td>
            <td><?php echo $doan['tensv'] ?></td>
            <td>
                <ul>
                    <li>Niên khóa:<?php echo $doan['nienkhoa'] ?> </li>
                    <li>Lớp:<?php echo $doan['tenlop'] ?> </li>
                    <li>Chuyên ngành: <?php echo $doan['tennganh'] ?> </li>
                    <li>Khoa: <?php echo $doan['tenkhoa'] ?> </li>
                    <li>Gv hướng dẫn: <?php echo $doan['tengv'] ?> </li>
                    <li>Điểm: <?php
                if ($doan['diem'] == 0) {
                    echo "Chưa chấm điểm !";
                } else {
                    echo $doan['diem'];
                } ?>
                    </li>
                </ul>
            </td>
            <td>
                <?php
                    if ($doan['diem'] == 0) {
                        ?>
                <a class="btn btn-success"
                    href="index.php?action=doan&act=update_points_doan&id=<?php echo $doan['iddoan']; ?>">
                    Chấm điểm <i class="fa-solid fa-pencil"></i> </a>
                <?php
                    } else {
                        ?>
                <a class="btn btn-success"
                    href="index.php?action=doan&act=update_points_doan&id=<?php echo $doan['iddoan']; ?>">
                    Sửa điểm <i class="fa-solid fa-pencil"></i> </a>
                <?php
                    }
                    ?>
            </td>
        </tr>
        <?php } }?>
        <tr>
            <td colspan="7" style="border:none; text-align:center">
                <?php if ($showPagination): ?>
                <div class="">
                    <ul class="pagination">
                        <?php
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            if ($current_page > 1 && $pages > 1) {
                echo '<li><a href="index.php?action=doan&page=1"><<</a></li>';
            }
            for ($i = 1; $i <= $pages; $i++) {
                ?>
                        <li <?php if ($i == $current_page) echo 'class="active" '?>>
                            <a href="index.php?action=doan&page=<?php echo $i; ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                        <?php
            }
            if ($current_page < $pages && $pages > 1) {
                echo '<li><a href="index.php?action=doan&page=' . $pages . '">>></a></li>';
            }
            ?>
                    </ul>
                </div>
                <?php endif; ?>
            </td>
        </tr>
    </table>
    <?php }?>
</div>
<link rel="stylesheet" href="View/assets/css/qldoan/qldoan.css">
<script>
$(document).ready(function() {
    //Xoá (soft delete)
    $(document).on('click', "#del-btn", function() {
        let delete_id = $(this).closest('tr').find('#id').data("id");
        Swal.fire({
            title: "Xoá đồ án này?",
            text: "Sau khi xoá đồ án sẽ mất vĩnh viễn !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "Controller/doan.php?act=delete_doan",
                    method: "POST",
                    data: {
                        delete_id: delete_id
                    },
                    dataType: "JSON",
                    success: function(res) {
                        console.log(res);
                        if (res.status === 'success') {
                            Swal.fire({
                                title: "Xoá đồ án thành công!",
                                text: res.message,
                                icon: "success",
                                timer: 900,
                                timerProgressBar: true
                            }).then(() => {
                                window.location.reload();
                            })
                        } else {
                            Swal.fire({
                                title: "Xoá đồ án thất bại!",
                                text: res.message,
                                icon: "error",
                                timer: 3200,
                                timerProgressBar: true
                            });
                        }
                    },
                    error: function(error) {
                        console.log("Error: ", error);
                        Swal.fire({
                            title: "Lỗi!",
                            text: "Có lỗi xảy ra!",
                            icon: "error",
                            timer: 3200,
                            timerProgressBar: true
                        });
                    }
                })
            }
        });
    })
})
<?php
        if (isset($_SESSION['send']) && $_SESSION['send'] === true) {
            unset($_SESSION['send']);
            echo '
            Swal.fire({
                title: "Cập nhật điểm thành công!",
                text: "Đã cập nhật điểm thành công!",
                icon: "success",
                timer: 3200,
                timerProgressBar: true
            });
            ';
        }
        ?>
</script>