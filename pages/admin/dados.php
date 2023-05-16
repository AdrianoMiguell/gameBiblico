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

<div class="container" style="overflow-x: scroll;">
    <table class="table table-dark table-striped text-center my-5 px-5">
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
                <th scope="col">Opções</th>
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
                    echo "<td> " . $row['nivel'] . "</td>";
                    echo "<td>
                    <form action='./edit.php' method='POST'>
                        <button class='btn btn-success m-1' name='id' type='submit' value='" . $row['id'] . "'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                            </svg>
                        </button>
                    </form>
                   
                    <form action='./delete.php' method='POST' onsubmit='return validaForm()'> 
                        <button class='btn btn-danger trash m-1' name='id' type='submit' value='" . $row['id'] . "'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                        <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z'/>
                        <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z'/>
                        </svg>
                    </button>
                </form>";
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
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary my-2 mt-5" data-bs-toggle="modal" data-bs-target="#newQuest">
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
                        <textarea class="form-control" type="text" name="texto" id="perg"> </textarea>
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
                        <button class="btn btn-primary" id="btnEnv"> Enviar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const trash = document.querySelectorAll('.trash');

    function validaForm() {
        if (window.confirm("Você tem certeza que quer apagar esta pergunta?") == true) {
            return true; 
        } else{
            return false;
        }
       
    }

</script>

<?php
include "../layouts/footer.php";
?>

<!-- 
<a href='.' class='btn btn-danger m-1 trash'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                        <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z'/>
                        <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z'/>
                    </a>

                    <form action='./delete.php' method='POST'>
                        <button class='btn btn-danger m-1' name='id' type='submit' value='".$row['id']."'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                            <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z'/>
                            <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z'/>
                            </svg>
                        </button>
                    </form>
 -->