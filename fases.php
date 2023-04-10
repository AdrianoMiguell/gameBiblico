<?php

// echo __DIR__;
include_once './pages/register_login/verification.php';

include './pages/layouts/geral.php';

?>

<style>
    .flex-center-all{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
</style>

<section class="secFases">
    <?php
    for ($i = 1; $i <= 7; $i++) :
    ?>
        <?php if ($i == ($dados->fase)) : ?>
            <form method="GET" action="./pages/nivel0<?php echo $i;?>/pergs.php" class="fase">
                <input type="submit" value="<?php echo $i; ?>" id="fase" class="d-none" name="fase"> </input>
                <label for="fase" class="faseLabel flex-center-all">
                    <i class='bi bi-x-diamond-fill'></i>
                    <h2> fase <?php echo $i; ?> </h2>
                </label>
            </form>

        <?php else : ?>
            <div class="fase">
                <i class='bi bi-x-diamond-fill'></i>
                <h2> fase <?php echo $i; ?> </h2>
            </div>
    <?php
        endif;
    endfor;
    ?>
</section>

<script>
    const fase = document.querySelectorAll('.fase');
    const t = <?php echo ($dados->fase); ?>;

    for (let i = 0; i < fase.length; i++) {
        if (i < t) {
            fase[i].classList.add('btnRealist');
        } else {
            fase[i].classList.add('nivBlock');
        }
    }
</script>
</body>

</html>

<?php
include_once './pages/layouts/footer.php';
?>