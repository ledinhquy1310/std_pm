<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    ?>
<?php
    require_once "./Model/khoa.php";
    $khoa_model = new khoa();
    $total_khoa = $khoa_model->countKhoa();
    require_once "./Model/nganh.php";
    $nganh_model = new nganh();
    $total_nganh = $nganh_model->countnganh();
    require_once "./Model/lop.php";
    $lop_model = new lop();
    $total_lop = $lop_model->countlop();
    require_once "./Model/sinhvien.php";
    $sinhvien_model = new sinhvien();
    $total_sinhvien = $sinhvien_model->countSinhvien();
    require_once "./Model/giangvien.php";
    $giangvien_model = new giangvien();
    $total_giangvien = $giangvien_model->countGiangVien();
    require_once "./Model/doan.php";
    $doan_model = new Doan();
    $total_doan = $doan_model->countDoan();
    ?>
<!-- small box -->
<h3><i class="fa-solid fa-file-pen"></i> Bảng số liệu</h3>
<div class="row mt-3">
    <div class="col-lg-3 col-md-4 ">

        <div class="small-box bg-primary">
            <div class="inner">
                <h3><?php echo $total_khoa; ?></h3>
                <p>Khoa</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="index.php?action=khoa" class="small-box-footer">Xem thêm thông tin <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 ">

        <div class="small-box bg-info">
            <div class="inner">
                <h3><?php echo $total_nganh; ?></h3>
                <p>Ngành</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="index.php?action=nganh" class="small-box-footer">Xem thêm thông tin <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-md-4 ">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?php echo $total_lop; ?></h3>

                <p>Lớp</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="index.php?action=lop" class="small-box-footer">Xem thêm thông tin <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-md-4 ">
        <!-- small box -->
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3><?php echo $total_sinhvien; ?></h3>

                <p>Sinh Viên</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="index.php?action=sinhvien" class="small-box-footer">Xem thêm thông tin <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-md-4  mt-3">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?php echo $total_giangvien; ?></h3>

                <p>Giảng viên</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="index.php?action=giangvien" class="small-box-footer">Xem thêm thông tin <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-md-4  mt-3">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?php echo $total_doan; ?></h3>

                <p>Đồ án</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="index.php?action=doan" class="small-box-footer">Xem thêm thông tin <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<br>
<h3><i class="fa-solid fa-chart-simple"></i> Bảng thống kê</h3>
<div class="row">
    <div class="col-lg-6">
        <div id="pie_chart" style="width: 600px; height: 300px;"></div>
    </div>
    <div class="col-lg-6">
        <div id="column_chart" style="width: 500px; height: 400px;"></div>
        <?php
                require_once "./Model/sinhvien.php";
                $tbdiem_model = new sinhvien();
                $tbdiem_list = $tbdiem_model->TrungbinhdiemSV();
                ?>
    </div>
</div>

<?php
    require_once "Model/doan.php";

    function CountScoreAbove($scoreLimit)
    {
        $doan_model = new doan();
        $doan_list = $doan_model->getdoan();
        $count = 0;
        foreach ($doan_list as $doan) {
            if ($doan['diem'] > $scoreLimit) {
                $count++;
            }
        }
        return $count;
    }
    function CountScoreBelow($scoreLimit)
    {
        $doan_model = new doan();
        $doan_list = $doan_model->getdoan();
        $count = 0;
        foreach ($doan_list as $doan) {
            if ($doan['diem'] <= $scoreLimit) {
                $count++;
            }
        }

        return $count;
    }
    $countAbove4 = CountScoreAbove(4);
    $countBelow4 = CountScoreBelow(4);

    ?>
<script type="text/javascript">
google.charts.load('current', {
    'packages': ['corechart']
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    // Pie Chart
    var data_pie = google.visualization.arrayToDataTable([
        ['Task', 'Số lượng'],
        ['Đạt (>=4)', <?php echo $countAbove4; ?>],
        ['Không đạt (<4)', <?php echo $countBelow4; ?>],
    ]);

    var options_pie = {
        title: 'Đồ án đạt / không đạt'
    };

    var chart_pie = new google.visualization.PieChart(document.getElementById('pie_chart'));
    chart_pie.draw(data_pie, options_pie);

    //Column chart
    var data_column = google.visualization.arrayToDataTable([
        ['Nien Khoa', 'Diem Trung Binh'],
        <?php foreach ($tbdiem_list as $tbdiem) { ?>['<?php echo $tbdiem['nienkhoa'] ?>',
            <?php echo $tbdiem['tbd'] ?>],
        <?php } ?>
    ]);

    var options = {
        title: 'Trung bình điểm sinh viên theo từng niên khóa',
        legend: {
            position: 'none'
        },
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('column_chart'));

    chart.draw(data_column, options);
}
</script>
<?php
} else {
    include_once "./View/login.php";
}
?>

<link rel="stylesheet" href="View/assets/css/home.css">