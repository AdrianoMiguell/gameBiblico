<?php
// Inicialize a sessão
session_start();

// Verifique se o usuário já está logado, em caso afirmativo, redirecione-o para a página de boas-vindas
if (isset($_SESSION["email"]) && $_SESSION["email"] != "admin@gmail.com") {
    return header('location: ../../index.php');
}

include "../../bancoSql/config.php";
include "../layouts/geral.php";

$result = $pdo->prepare("SELECT * FROM perg");
$result->execute();

echo "dados mostrados";

// if (isset($result) && $result->rowCount() > 0) {
//     while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
//         echo "texto = " . $row['texto'];
//     }
// } else {
//     echo "<div class='textRealist'> Nenhuma Pergunta feita </div>";
//     echo "<a href='./create_perg.php'> criar Pergunta </a>";
// }

?>

<table class="table text-light my-5">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Texto</th>
            <th scope="col">R1</th>
            <th scope="col">R2</th>
            <th scope="col">R3</th>
            <th scope="col">R4</th>
            <th scope="col">Fase</th>
            <th scope="col">Nivel</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($result) && $result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr> <th scope='row'> " . $row['id'] . "</th>";
                echo "<td> " . $row['texto'] . "</td>";
                echo "<td> " . $row['resp1'] . "</td>";
                echo "<td> " . $row['resp2'] . "</td>";
                echo "<td> " . $row['resp3'] . "</td>";
                echo "<td> " . $row['resp4'] . "</td>";
                echo "<td> " . $row['fase'] . "</td>";
                echo "<td> " . $row['nivel'] . "</td> </tr>";
            }
        }
        ?>
    </tbody>
</table>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newQuest">
        + Questão
</button>

<!-- Modal -->
<div class="modal fade text-dark" id="newQuest" tabindex="-1" aria-labelledby="newQuestLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="newQuestLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>