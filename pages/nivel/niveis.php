<?php

include '../register_login/verification.php';
include '../layouts/geral.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    system_error();
} else if (!isset($_POST['fase'])) {
    header("Location: ../../fases.php");
    exit;
} else {
    $fase = intval($_POST['fase']);
}

$i = 1;
$s = true;


while ($s == true) {
    $sql = "SELECT nivel FROM perg WHERE fase = $fase and nivel = $i";
    $existF = $pdo->prepare($sql);

    if ($existF->execute() && isset($existF) && $existF->rowCount() == 0) {
        if ($i == 1) {
                echo "<h2 class='text-white text-center fs-3 msg'> Em breve será concluida a fase $fase ... <br> Agradecemos a sua pasciência! </h2>";
            alertInfo('shortly');
            back();
            include_once '../layouts/footer.php';
            exit;
        }
        $totNivels = $i - 1;
        $s = false;
    } else {
        $i++;
    }
    unset($existF);
}

if ($fase != $_SESSION['fase']) {
    $nivAtual = $totNivels;
} 
 else {
    $nivAtual = $dados->nivel;
}
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
    <?php
    for ($i = 1; $i <= $totNivels; $i++) :
        if ($i <= ($nivAtual)) : ?>
            <form method='POST' action='./perg.php' class='d-flex gap-5'>
                <input type="number" name="fase" value="<?php echo $fase; ?>" class="block">
                <input type="submit" name="nivel" value="<?php echo $i; ?>" id="nivel<?php echo $i; ?>" class="block">
                <label for="nivel<?php echo $i; ?>" class="fase flex-center-all">
                    <i class='bi bi-x-diamond-fill'></i>
                    <h2> nivel <?php echo $i; ?> </h2>
                </label>
            </form>
        <?php
        else : ?>
            <div class="fase">
                <i class='bi bi-x-diamond-fill'></i>
                <h2> nivel <?php echo $i; ?> </h2>
            </div>
    <?php
        endif;
    endfor;
    ?>
</section>

<script>
    const fase = document.querySelectorAll('.fase');
    const t = <?php echo ($nivAtual); ?>;

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
include_once '../layouts/footer.php';
?>