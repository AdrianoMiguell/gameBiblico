<?php
include './pages/layouts/geral.php';
?>

<style>
    body{
        overflow-y: visible;
        padding-bottom: 5rem !important;
    }
    .secMain{
        height: 100vh !important;
    }
    .mainTitle, .text{
        visibility: hidden;
    }
</style>

<section class="secMain">
    <h1 class="mainTitle textRealist"> <span> Quiz </span> <span> Biblico </span> </h1>
</section>
<section>
    <p class="text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur autem magni, ipsam harum veniam fugit? Excepturi cupiditate expedita recusandae omnis. Soluta explicabo tempora similique facilis voluptates, nesciunt delectus. Quisquam, ex?
    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nobis repudiandae eveniet, aliquid tempora voluptates aspernatur distinctio dolor adipisci aliquam consequatur eius et quas vitae rerum, amet perspiciatis unde. Labore, quos.
    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quae, tempore, cupiditate laborum delectus maxime expedita inventore voluptate placeat vero labore doloremque est iusto natus, minus esse nesciunt cumque eligendi quis.
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, minima dolor. Totam, nesciunt corrupti ipsum vel eius quas sint asperiores suscipit, doloribus quae dicta eveniet, sit sequi quo doloremque debitis.</p>
</section>

<script src="https://unpkg.com/scrollreveal"></script>
<script>
    ScrollReveal({ reset: true });
    ScrollReveal().reveal('.mainTitle', {
        duration: 1000
    })
    ScrollReveal().reveal('.text', {
        duration: 1000
    })
</script>

<?php
include './pages/layouts/footer.php';
?>