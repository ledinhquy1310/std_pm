<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí sinh viên</title>
    <link rel="stylesheet" href="View/assets/css/Header.css">
</head>
<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            $ctrl = "home";
            if (isset($_GET['action'])){
                $ctrl = $_GET['action'];
            }
            
    ?>

<body>
    <header>
        <ul class="top-menu">
            <li>
                <h5 style="margin:0;">
                    <i style="font-size:40px" class="fa-solid fa-graduation-cap"></i>
                </h5>
            </li>
            <li style="margin-top:10px">
                <?php 
                 if (isset($_SESSION['username'])) {
                    echo "<a style='color:red;margin-right:10px;'>" . $_SESSION['username'].'</a>';
                }
                ?>|
                <a href="index.php?action=login&act=logout" style="color:white;margin-left:10px">Đăng xuất</a>
            </li>
        </ul>
    </header>
    <aside>
        <?php
            $nav_items = array(
                'home' => '<i class="fa-solid fa-house"></i> Trang chủ',
                'khoa' => 'Quản lý khoa',
                'nganh' => 'Quản lý chuyên ngành',
                'nienkhoa' => 'Quản lý niên khóa',
                'lop' => 'Quản lý lớp',
                'giangvien' => 'Quản lý giảng viên',
                'sinhvien' => 'Quản lý sinh viên',
                'doan' => 'Danh sách đồ án',
                'quanli' => 'Danh sách quản lý',
            );
        ?>
        <nav>
            <ul class="menu">
                <?php foreach ($nav_items as $action => $label) : ?>
                <li <?php if($ctrl == $action) echo 'class="active"'; ?>>
                    <a href="index.php?action=<?php echo $action; ?>"><?php echo $label; ?></a>
                </li>
                <?php endforeach; ?>
                <li <?php if($ctrl == 'lichhen') echo 'class="active"'; ?>>
                    <a href="index.php?action=lichhen">Lịch hẹn
                        <span class=" top-20 start-50 ms-2 translate-middle badge rounded-pill bg-danger">
                            <?php 
                        require_once "./Model/lichhen.php";
                        $lichhen_model=new lichhen;
                        $countlichhen=$lichhen_model->countlichhen();
                        echo $countlichhen;
                    ?>
                        </span>
                    </a>
                </li>
            </ul>
        </nav>


    </aside>
    <main>
        <?php
}
?>