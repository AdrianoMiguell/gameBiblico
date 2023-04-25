<?php
include './pages/layouts/geral.php';
?>

<!-- <style>
    .mainTitle {
    display: grid; 
    translate: 0 -1em;
    text-align: center;
    text-decoration: double;
}
</style> -->

<section class="secMain">
    <h1 class="mainTitle textRealist"> <span> Quiz </span> <span> Biblico </span> </h1>
    <div class="d-flex flex-column justify-content-between align-items-center gap-5">
        <a href="./pages/register_login/login.php"><button class="btnG btnRealist widthBtnStart"> Start </button></a>
        <a href=""><button class="btnG btnRealist widthBtnStart"> <span>Informations</span> </button></a>
        <a href=""><button class="btnG btnRealist widthBtnStart"> <span>Aboult</span> </button></a>
    </div>
</section>

<?php
include './pages/layouts/footer.php';
?>