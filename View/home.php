<body>
    <?php 
      require_once './Model/tintuc.php';
      $tintuc_model = new tintuc();
      $tintuc_list=$tintuc_model->getTT();
      $thongbao_list=$tintuc_model->getTB();
      
     if (isset($_SESSION['alert']) && $_SESSION['alert'] === true) {
    ?>
    <br>
    <div class="alert alert-success alert-dismissible" role="alert">
        <b>Đăng nhập thành công !</b>
        <button type="button" class="btn-close pt-3" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
         unset($_SESSION['alert']);
        }


        if (isset($_SESSION['add_lienhe_alert']) && $_SESSION['add_lienhe_alert'] === true) {
            ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <b>Gửi thông tin phản hồi thành công !</b>
        <button type="button" class="btn-close pt-3" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
    unset($_SESSION['add_lienhe_alert']);
}
?>


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        TIN TỨC MỚI CẬP NHẬT
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <?php 
                            foreach($tintuc_list as $tintuc){?>
                            <li>
                                <a href="<?php echo $tintuc['link']?>"><?php echo $tintuc['tentt']?></a>
                            </li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        THÔNG BÁO CHUNG
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <?php 
                            foreach($thongbao_list as $thongbao){?>
                            <li>
                                <a href="<?php echo $thongbao['link']?>"><?php echo $thongbao['tentb']?></a>
                            </li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
</body>
<style>
.card {
    border: 2px solid #007bff;
    border-radius: 10px;
}

.card-header {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.list-unstyled li {
    list-style: inside;
}
</style>