<?php
// Inicialize a sessão
session_start();

// Verifique se o usuário já está logado, em caso afirmativo, redirecione-o para a página de boas-vindas
if (isset($_SESSION["email"]) && $_SESSION["email"] != "admin@gmail.com") {
    return header('location: ../../index.php');
}

include "../../bancoSql/config.php";
include "../layouts/geral.php";

$result = $pdo->prepare("SELECT * FROM perg ORDER BY fase, nivel ASC");
$result->execute();

echo "<h1 class='text-center'>Questões do Quiz</h1>";

// if (isset($result) && $result->rowCount() > 0) {
//     while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
//         echo "texto = " . $row['texto'];
//     }
// } else {
//     echo "<div class='textRealist'> Nenhuma Pergunta feita </div>";
//     echo "<a href='./create_perg.php'> criar Pergunta </a>";
// }

?>

<table class="table table-dark table-striped text-center my-5">
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
                echo "<td class='text-start'> " . $row['texto'] . "</td>";
                echo "<td> " . $row['resp1'] . "</td>"; 
                echo "<td> " . $row['resp2'] . "</td>";
                echo "<td> " . $row['resp3'] . "</td>";
                echo "<td> " . $row['resp4'] . "</td>";
                echo "<td> " . $row['fase'] . "</td>";
                echo "<td> " . $row['nivel'] . "</td> </tr>";
                $fase = $row['fase'];
                $nivel = $row['nivel'];
                $num = $row['numPerg'];
            }

            if ($num >= 7) {
                $nivel++;
            }
            if ($nivel >= 7) {
                $fase++;
            }

            // echo "<td".$row['resp1'] == $row['respTrue'] ? "class='text-bold'>".$row['resp1']."</td>" : "> " . $row['resp1'] . "</td>";
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
                <h1 class="modal-title fs-5" id="newQuestLabel"> Criar Pergunta </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="./create_perg.php" method="post" class="d-grid gap-5 p-4">
                    <div>
                        <label class="form-label" for="perg"> Questão </label>
                        <input class="form-control" type="text" name="texto" placeholder="Digite a pergunta" id="perg">
                    </div>
                    <div>
                        <label class="form-label" for="r1"> Alternativa 1 </label>
                        <input class="form-control" type="text" name="resp1" placeholder="Primeira alternativa" id="r1">
                    </div>
                    <div>
                        <label class="form-label" for="r2"> Alternativa 2 </label>
                        <input class="form-control" type="text" name="resp2" placeholder="Segunda alternativa" id="r2">
                    </div>
                    <div>
                        <label class="form-label" for="r3"> Alternativa 3 </label>
                        <input class="form-control" type="text" name="resp3" placeholder="Terceira alternativa" id="r3">
                    </div>
                    <div>
                        <label class="form-label" for="r4"> Alternativa 4 </label>
                        <input class="form-control" type="text" name="resp4" placeholder="Quarta alternativa" id="r4">
                    </div>
                    <div class="d-flex justify-content-between gap-2">
                        <div>
                            <select class="btn btn-warning" name="respTrue" id="rTrue">
                                <option value="1" selected> Alt 1 </option>
                                <option value="2">Alt 2 </option>
                                <option value="3"> Alt 3 </option>
                                <option value="4"> Alt 4 </option>
                            </select>
                        </div>
                        <div>
                            <select class="btn btn-warning" name="fase" id="fase">
                                <?php
                                for ($i = 1; $i <= 7; $i++) {
                                    echo "<option value='" . $i . "'";
                                    echo $i == $fase ? "selected> Fase " . $i . " </option>" : "> Fase " . $i . " </option>";
                                }
                                ?>
                                <!-- <option value="1"> Fase 1 </option>
                                <option value="2"> Fase 2 </option>
                                <option value="3"> Fase 3 </option>
                                <option value="4"> Fase 4 </option>
                                <option value="5"> Fase 5 </option>
                                <option value="6"> Fase 6 </option>
                                <option value="7"> Fase 7 </option> -->
                            </select>
                        </div>
                        <div>
                            <select class="btn btn-warning" name="nivel" id="nivel">
                                <?php
                                for ($i = 1; $i <= 7; $i++) {
                                    echo "<option value='" . $i . "'";
                                    echo $i == $nivel ? "selected> Nivel " . $i . " </option>" : "> nivel " . $i . " </option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary"> Enviar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include "../layouts/footer.php";
?>