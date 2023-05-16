
<?php
include "../../bancoSql/config.php";

$id = $_POST['id'];

if (isset($_POST)) {

    if (
        empty($_POST['texto']) ||
        empty($_POST['resp1']) ||
        empty($_POST['resp2']) ||
        empty($_POST['resp3']) ||
        empty($_POST['resp4']) ||
        empty($_POST['respTrue']) ||
        empty($_POST['fase']) ||
        empty($_POST['nivel'])
    ) {
        echo "<div class='alert alert-danger'> Cade os dados?!? </div>";
        echo "<a href='./dados.php'> Voltar </a>";
        exit;
    }

    $perg = $_POST['texto'];
    $r1 = $_POST['resp1'];
    $r2 = $_POST['resp2'];
    $r3 = $_POST['resp3'];
    $r4 = $_POST['resp4'];
    $rTrue = $_POST['respTrue'];
    $fase = $_POST['fase'];
    $nivel = $_POST['nivel'];

    if (!isset($_POST['dica']) || empty($_POST['dica'])) {
        $dica = "";
    } else {
        $dica = $_POST['dica'];
    }

    $sql = "SELECT id, numPerg FROM perg WHERE fase = '" . $fase . "' AND nivel = '" . $nivel . "' ORDER BY id desc LIMIT 1";
    $fnExist = $pdo->prepare($sql);

    if ($fnExist->execute()) {
        if ($fnExist->rowCount() == 0) {
            $sql = "SELECT fase, nivel FROM perg ORDER BY fase desc";
            var_dump($sql);

            $fasEx = $pdo->prepare($sql);
            $fasEx->execute();
            $row = $fasEx->fetch(PDO::FETCH_ASSOC);
            if ($fase > ($row['fase'] + 1)) {
                echo "<div class='alert alert-danger'> Questão deve fazer parte de uma fase menor </div>";
                echo "<a href='./dados.php'> Voltar </a>";
                exit;
            }
        }
    }

    unset($sql, $row);

    $sql = "UPDATE perg SET texto = '" . $perg . "', resp1 = '" . $r1 . "', resp2 = '" . $r2 . "', resp3 = '" . $r3 . "', resp4 = '" . $r4 . "', respTrue = '" . $rTrue . "', fase = '" . $fase . "', nivel = '" . $nivel . "' WHERE id = ".$id;
    // , dica = '". $dica . "',

    $quest = $pdo->prepare($sql);

    try {
        $quest->execute();
        unset($sql, $quest, $_POST);
        header("location: ./dados.php");
        return $msg = "Dados editados com sucesso!";
    } catch (\Throwable $th) {
        var_dump($th);
        echo "<div class='alert alert-danger'> Algo deu errado em editar a pergunta no banco. </div>";
        exit;
    }


    echo "<div class='alert alert-danger'> Algo deu errado em inserir a pergunta no banco. </div>";
    echo "<a href='./dados.php'> Voltar </a>";
    exit;
    // header("location: ./dados.php");
}

?>