<?php

include_once '../register_login/verification.php';
include '../layouts/geral.php';

?>

<section class="secNiveis">
    <?php
    for ($i = 0; $i < 6; $i++) :
    ?>
        <a class="linkNivel text-decoration-none">
            <div class="nivel">
                <i class='bi bi-x-diamond-fill'></i>
                <h2> fase <?php echo $i + 1; ?> </h2>
            </div>
        </a>

    <?php
    endfor;
    ?>
</section>

<script>
    const nivel = document.querySelectorAll('.nivel');
    const link = document.querySelectorAll('.linkNivel');
    const t = <?php echo ($dados->nivel); ?>;

    for (let i = 0; i < nivel.length; i++) {
        if (i <= t) {
            nivel[i].classList.add('btnRealist');
            link[i].setAttribute('href', './fase0' + (i + 1) + '.php');
        } else {
            nivel[i].classList.add('nivBlock');
            nivel[i].innerHTML = "<i class='bi bi-lock-fill'></i> <h2> fase " + i + "</h2>";
        }
    }
</script>
</body>

</html>

<?php
include_once '../layouts/footer.php';
?>