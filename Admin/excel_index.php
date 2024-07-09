<?php
include_once "Model/connect.php";
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://kit.fontawesome.com/21deffdec8.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- ajax -->

    <title>Hệ Thống QL Đồ Án Sinh Viên</title>


</head>

<body>
    <div class="container" style="margin-right:20px">
        <div class="">
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            $ctrl = "home";
            if (isset($_GET['action']))
                $ctrl = $_GET['action'];
            include 'Controller/' . $ctrl . '.php';
            }else{
                include 'Controller/login.php';
            }
            ?>
        </div>
    </div>
</body>