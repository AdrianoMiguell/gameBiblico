<?php
include_once './controller.php';

$result = $pdo->prepare("SELECT * FROM perg");
$result->execute();

echo "dados mostrados";

if (isset($result) && $result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "texto = " . $row['texto'];
    }
} else {
    echo "<div class='textRealist'> Nenhuma Pergunta feita </div>";
    echo "<a href='./create_perg.php'> criar Pergunta </a>";
}
