<?php

include_once '../register_login/verification.php';
include '../layouts/geral.php';

if (isset($_POST['fase']) && isset($_POST['nivel'])) {
    $fase = $_POST['fase'];
    $nivel = $_POST['nivel'];
} else if (isset($_POST['fase']) && !isset($nivel) || $nivel > $dados->nivel) {
    $fase = $_POST['fase'];
    $nivel = 1;
} else {
    return header('location: ../../index.php');
}

$pergs = $pdo->prepare("SELECT * FROM perg WHERE fase = $fase && nivel = $nivel");
$pergs->execute();
unset($dados);

if (!isset($pergs) || $pergs->rowCount() <= 0) {
    echo "ind";
    alertInfo("Fase em breve");
    back();
    unset($dados, $result, $pergs, $fase, $nivel);
    exit;
}

?>

<section class="niveis">
    <div class="d-flex justify-content-around align-items-center my-1 mb-4 rounded-1">
        <span class="fs-2">Fase <?php echo $fase; ?></span>
        <span class="fs-3">
            Nivel <?php echo $nivel; ?>
        </span>
    </div>

    <?php if (isset($pergs) && $pergs->rowCount() > 0) : ?>
        <form action="./control.php" method="POST" id="divPerg">
            <?php
            $i = 0;
            $n = 0;
            while ($row = $pergs->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='pergs block'> <h2 class='order'> Pergunta </h2>";
                echo "<legend class='perg'> {$row['numPerg']} - {$row['texto']} </legend>";
                echo "<div> <input required type='radio' id='perg{$i}' name='resp{$n}' value='1' class='d-none'/> <label class='labelP btnSimple' onclick='np($n)' for='perg{$i}'>{$row['resp1']}</label> </div>";
                $i++;
                echo "<div> <input required type='radio' id='perg{$i}' name='resp{$n}' value='2' class='d-none'/> <label class='labelP btnSimple' onclick='np($n)' for='perg{$i}'>{$row['resp2']}</label> </div>";
                $i++;
                echo "<div> <input required type='radio' id='perg{$i}' name='resp{$n}' value='3' class='d-none'/> <label class='labelP btnSimple' onclick='np($n)' for='perg{$i}'>{$row['resp3']}</label> </div>";
                $i++;
                echo "<div> <input required type='radio' id='perg{$i}' name='resp{$n}' value='4' class='d-none'/> <label class='labelP btnSimple' onclick='np($n)' for='perg{$i}'>{$row['resp4']}</label> </div>";
                echo "</div>";
                $i++;
                $n++;
            }

            echo "<div id='divPreview'>";
            for ($n = 0; $n < $pergs->rowCount(); $n++) {
                echo "<span class='btnP btnRealist block' onclick='cp($n)'> " . ($n + 1) . " </span> ";
            }
            ?>
            <button type='submit' class='btnP btnRealist px-1 rounded-1 block'> Enviar </button> </div>
            <input class="d-none" name="fase" value="<?php echo $fase; ?>" />
            <input class="d-none" name="nivel" value="<?php echo $nivel; ?>" />
        </form>
    <?php else : ?>
        <div class="msg"> Em breve será concluida a fase <?php echo $fase; ?>, e lançado o nivel  <?php echo $nivel; ?> ... </div>
    <?php endif; ?>
</section>

<script>
    const divPerg = document.querySelector("#divPerg");
    const pergs = document.querySelectorAll(".pergs");
    const labelP = document.querySelectorAll(".labelP");

    let atual = 0;

    const btnP = document.querySelectorAll(".btnP");
    pergs[0].classList.remove("block");
    btnP[0].classList.remove("block");

    // function next-previous
    function np(n) {
        if (pergs.length != 1 && n < pergs.length - 1) {
            pergs[n].classList.add("block");
            pergs[n + 1].classList.remove("block");
            btnP[n + 1].classList.remove("block");
            if (n == pergs.length - 2) {
                btnP[n + 2].classList.remove("block");
            }
            atual = n + 1;
        } else {
            btnP[n + 1].classList.remove("block");
        }
    }

    // function create preivours
    function cp(n) {
        pergs[atual].classList.add("block");
        pergs[n].classList.remove("block");
        atual = n;
    }
</script>

<?php
include_once '../layouts/footer.php';
unset($pergs);
?>