<?php
if (isset($_SESSION['loggedUser']) && $_SESSION['loggedUser'] === true) {
    $ctrl = "home";
    if (isset($_GET['action'])) {
        $ctrl = $_GET['action'];
    }
    ?>
<header class="shadow-sm border-bottom">
    <img class="banner" src="Admin/View/assets/img/banner2.png" alt="">
    <br>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container mb-0">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-5">

                    <li id="menu_child" <?php if ($ctrl == 'home') {
                            echo "class='active'";
                        } ?>>
                        <a class="nav-link" href="index.php?action=home">Trang chủ</a>
                    </li>
                    <!-- ke hoach hoc tap -->
                    <?php if (isset($_SESSION['tensv'])) { ?>

                    <li id="menu_child" <?php if ($ctrl == 'doan' || $ctrl == 'lichhen') {
                                echo "class='active'";
                            } ?>>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Kế hoạch học tập
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="index.php?action=doan">Đồ án cá nhân</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="index.php?action=lichhen">Xem lịch hẹn</a>
                                </li>
                            </ul>
                            </a>
                        </div>
                    </li>
                    <?php } ?>

                    <!-- thong tin ca nhan -->
                    <li id="menu_child" <?php if ($ctrl == 'thong_tin_ca_nhan' || $ctrl == 'doi_mat_khau') {
                            echo "class='active'";
                        } ?>>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Thông tin cá nhân
                            </a>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="index.php?action=thong_tin_ca_nhan">Thông tin cá
                                        nhân</a></li>
                                <li><a class="dropdown-item" href="index.php?action=doi_mat_khau">Đổi mật khẩu</a>
                                </li>
                            </ul>
                            </a>
                        </div>
                    </li>
                    <?php if (isset($_SESSION['tengv'])) { ?>
                    <!-- kế hoạch giảng dạy -->
                    <li id="menu_child" <?php if ($ctrl == 'lichhen' || $ctrl == 'doan') {
                                echo "class='active'";
                            } ?>>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Kế hoạch giảng dạy
                                <span class="top-20 start-50 translate-middle badge rounded-pill bg-danger">
                                    <?php
                                            require_once "./Model/doan.php";
                                            $doan_model = new doan;
                                            $countdoan = $doan_model->countDoanChuaChamDiem($_SESSION['idgv']);
                                            echo $countdoan;
                                            ?>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="index.php?action=lichhen">Tạo lịch hẹn</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="index.php?action=doan">Chấm Đồ Án</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li style="margin-top:8px">
                        <?php
                            if (isset($_SESSION['tensv'])) {
                                echo "<a style='color:red;margin-right:10px'>" . $_SESSION['tensv'] . '</a>';
                            } else if (isset($_SESSION['tengv'])) {
                                echo "<a style='color:red;margin-right:10px'>" . $_SESSION['tengv'] . '</a>';
                            }
                            ?>|
                    </li>
                    <li>
                        <a class="nav-link" href="index.php?action=login&act=logout">Đăng xuất</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
</body>
<?php
}
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="View/assets/css/header.css">