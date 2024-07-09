<style>
.body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.footer {
    background-color: black;
    color: white;
    padding: 20px 0;
    margin: 0;
    text-align: center;
}
</style>
<?php
if (isset($_SESSION['loggedUser']) && $_SESSION['loggedUser'] === true) {
    $ctrl = "home";
    if (isset($_GET['action']))
    {
        $ctrl = $_GET['action'];
    }
    ?>
<footer class="footer">
    <div class="text-center">
        <span class="text-muted">Cao Đẳng Công Nghệ Thông Tin &copy; 2024</span>
        <p class="mt-2">Trang web quản lý đồ án sinh viên Cao Đẳng Công Nghệ Thông Tin </p>
    </div>
</footer><?php
}
?>