<?php
include './pages/layouts/geral.php';
?>

<style>
    .mainTitle, .btns{
        visibility: hidden;
    }
</style>

<section class="secMain">
    <h1 class="mainTitle textRealist"> <span> Quiz </span> <span> Biblico </span> </h1>
    <div class="d-flex flex-column justify-content-between align-items-center gap-5 btns">
        <a href="./pages/register_login/login.php"><button class="btnG btnRealist widthBtnStart"> Start </button></a>
        <a href="./inform.php"><button class="btnG btnRealist widthBtnStart"> <span>Informations</span> </button></a>
        <a href=""><button class="btnG btnRealist widthBtnStart"> <span>About</span> </button></a>
    </div>
</section>

<script src="https://unpkg.com/scrollreveal"></script>
<script>
    ScrollReveal({ reset: true });
    ScrollReveal().reveal('.mainTitle', {
        duration: 1000
    })
    ScrollReveal().reveal('.btns', {
        delay: 500,
        duration: 1000
    })
</script>

<?php
include './pages/layouts/footer.php';
?>