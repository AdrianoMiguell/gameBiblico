<?php
include "../../bancoSql/config.php";

if (isset($_POST)) {
    $id = $_POST['id'];
    try {
        $id = intval($id);
    } catch (\Throwable $th) {
        throw $th;
    }

    var_dump($id);

    $sql = "SELECT id FROM perg WHERE id = '" . $id . "' LIMIT 1";
    $fnExist = $pdo->prepare($sql);

    if ($fnExist->execute()) {
        if ($fnExist->rowCount() != 1) {
            echo "<div class='alert alert-danger'> Algo deu errado, tente novamente! </div>";
            echo "<a href='./dados.php'> Voltar </a>";
            exit;
        }
    }

    try {
        $sql = "DELETE FROM perg WHERE id = '".$id."'";
        $quest = $pdo->prepare($sql);
        $quest->execute();
        header("location: ./dados.php");
        return $msg = "Dados excluidos com sucesso!";
    } catch (\Throwable $th) {
        var_dump($th);
        echo "<div class='alert alert-danger'> Algo deu errado em excluir a pergunta no banco. </div>";
        exit;
    }
}
