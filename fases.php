<?php
include_once './pages/register_login/verification.php';
include './pages/layouts/geral.php';
?>

<style>
    .flex-center-all {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
</style>

<section class="secFases">

    <form method='POST' action='./pages/nivel/niveis.php' class='d-flex gap-5'>
        <?php
        for ($i = 1; $i <= 7; $i++) :
            if ($i <= ($dados->fase)) : ?>
                <input type="submit" name="fase" value="<?php echo $i; ?>" id="fase<?php echo $i; ?>" class="block">
                <label for="fase<?php echo $i; ?>" class="fase flex-center-all">
                    <i class='bi bi-x-diamond-fill'></i>
                    <h2> fase <?php echo $i; ?> </h2>
                </label>
            <?php
                echo $i == $dados->fase ? "</form>" : " ";
            else : ?>
                <div class="fase">
                    <i class='bi bi-x-diamond-fill'></i>
                    <h2> fase <?php // echo $i; 
                                ?> </h2>
                </div>
        <?php
            endif;
        endfor;
        ?>
    </form>
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