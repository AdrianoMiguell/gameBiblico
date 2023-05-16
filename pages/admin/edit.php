<?php
session_start();

if (isset($_SESSION["email"]) && $_SESSION["email"] != "admin@gmail.com") {
    return header('location: ../../index.php');
}

include "../../bancoSql/config.php";
include "../layouts/geral.php";

if (isset($_POST)) {

    $id = $_POST['id'];

    $editP = $pdo->prepare("SELECT * FROM perg WHERE id = '" . $id . "'");
    $editP->execute();

    if ($editP->execute()) {
        if ($editP->rowCount() > 0 && $editP->rowCount() == 1) {
            $row = $editP->fetch(PDO::FETCH_ASSOC);
        }
    }
}

?>

<div class="container w-75 p-4">
    <h1 class="text-center fs-2">Editar Questão</h1>
    <form action="./edit_perg.php" method="post" class="d-grid gap-5 p-4">
        <div>
            <label class="form-label" for="perg"> Questão </label>
            <textarea class="form-control" type="text" name="texto" id="perg"> <?php echo $row['texto']; ?> </textarea>
        </div>
        <div>
            <label class="form-label" for="r1"> Alternativa 1 </label>
            <?php
            echo "<input class='form-control' type='text' name='resp1' id='r1' value='" . $row['resp1'] . "'> ";
            ?>
        </div>
        <div>
            <label class="form-label" for="r2"> Alternativa 2 </label>
            <?php
            echo "<input class='form-control' type='text' name='resp2' id='r2' value='" . $row['resp2'] . "'> ";
            ?>
        </div>
        <div>
            <label class="form-label" for="r3"> Alternativa 3 </label>
            <?php
            echo "<input class='form-control' type='text' name='resp3' id='r3' value='" . $row['resp3'] . "'> ";
            ?>
        </div>
        <div>
            <label class="form-label" for="r4"> Alternativa 4 </label>
            <?php
            echo "<input class='form-control' type='text' name='resp4' id='r4' value='" . $row['resp4'] . "'> ";
            ?>
        </div>
        <div class="d-flex justify-content-between gap-2">
            <div>
                <select class="btn btn-warning" name="respTrue" id="rTrue">
                    <?php
                    for ($i = 1; $i <= 4; $i++) {
                        echo "<option value='" . $i . "'";
                        echo $i == $row['respTrue'] ? " selected> Alt " . $i . " </option>" : "> Alt " . $i . " </option>";
                    }
                    ?>
                </select>
            </div>
            <div>
                <select class="btn btn-warning" name="fase" id="fase">
                    <?php
                    for ($i = 1; $i <= 7; $i++) {
                        echo "<option value='" . $i . "'";
                        echo $i == $row['fase'] ? " selected> Fase " . $i . " </option>" : "> Fase " . $i . " </option>";
                    }
                    ?>
                </select>
            </div>
            <div>
                <select class="btn btn-warning" name="nivel" id="nivel">
                    <?php
                    for ($i = 1; $i <= 7; $i++) {
                        echo "<option value='" . $i . "'";
                        echo $i == $row['nivel'] ? "selected> Nivel " . $i . " </option>" : "> nivel " . $i . " </option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div>
            <?php
            echo "<input class='d-none' type='number' name='id' value='" . $row['id'] . "'> ";
            ?> <button class="btn btn-primary" id="btnEnv" type="submit"> Enviar </button>
        </div>
    </form>
</div>