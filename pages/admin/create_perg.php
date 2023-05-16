
<?php
include "../../bancoSql/config.php";

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

    $sql = "SELECT id FROM perg WHERE texto = '" . $perg . "'";
    $pergExist = $pdo->prepare($sql);

    if ($pergExist->execute()) {
        if ($pergExist->rowCount() > 0) {
            echo "<div class='alert alert-danger'> Essa pergunta já existe! </div>";
            exit;
        } else {
            unset($pergExist, $sql);

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
                if ($fnExist->rowCount() > 0) {
                    $row = $fnExist->fetch(PDO::FETCH_ASSOC);
                    $numP = $row['numPerg'] + 1;
                    var_dump($row);
                } else {
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

                    $numP = 1;
                }
            }

            unset($sql, $row);

            $sql = "INSERT INTO perg(texto, resp1, resp2, resp3, resp4, respTrue, numPerg, dica, fase, nivel) VALUES ('" . $perg . "', '" . $r1 . "', '" . $r2 . "', '" . $r3 . "', '" . $r4 . "', '" . $rTrue . "', '" . $numP . "', '" . $dica . "', '" . $fase . "', '" . $nivel . "')";

            $quest = $pdo->prepare($sql);
            // $quest->execute();

            try {
                $quest->execute();
                unset($sql, $quest, $_POST);
                header("location: ./dados.php");
                return $msg = "Criado com sucesso!";
            } catch (\Throwable $th) {
                var_dump($th);

                echo "<div class='alert alert-danger'> Algo deu errado em inserir a pergunta no banco. </div>";
                exit;
            }
        }
    }
} else {
    echo "<div class='alert alert-danger'> Algo deu errado em inserir a pergunta no banco. </div>";
    echo "<a href='./dados.php'> Voltar </a>";
    exit;
    // header("location: ./dados.php");
}

?>