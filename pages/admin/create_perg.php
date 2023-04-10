<?php
include_once './controller.php';

// $result = $pdo->prepare("SELECT * FROM perg");
// $result->execute();

if (isset($_POST['texto'])) {
    $texto = $_POST['texto'];
    $resp1 = $_POST['resp1'];
    $resp2 = $_POST['resp2'];
    $resp3 = $_POST['resp3'];
    $resp4 = $_POST['resp4'];
    $respTrue = $_POST['respTrue'];
    // $texto = trim($_POST['texto']);
    // $resp1 = trim($_POST['resp1']);
    // $resp2 = trim($_POST['resp2']);
    // $resp3 = trim($_POST['resp3']);
    // $resp4 = trim($_POST['resp4']);
    // $respTrue = trim($_POST['respTrue']);

    // var_dump($resp1);

    if (empty($perg_err) && empty($resp_err)) {

        $result = $pdo->prepare("INSERT INTO perg (texto, resp1, resp2, resp3, resp4, respTrue, dica, fase) VALUES ('$texto', '$resp1', '$resp2', '$resp3', '$resp4', '$respTrue', 'null', '1')");
        $result->execute();

        if ($result->execute()) {
            header("location: ./dados.php");
        } else {
            $perg_err = "Algo deu errado";
        }

        // // Prepare uma declaração de inserção
        // $sql = "INSERT INTO users (texto, resp1, resp2, resp3, resp4, respTrue) VALUES (:texto, :resp1, :resp2, :resp3, :resp4, :respTrue)";

        // if($stmt = $pdo->prepare($sql)){
        //     // Vincule as variáveis à instrução preparada como parâmetros
        //     $stmt->bindParam(":texto", $texto);
        //     $stmt->bindParam(":resp1", $resp1);
        //     $stmt->bindParam(":resp2", $resp2);
        //     $stmt->bindParam(":resp3", $resp3);
        //     $stmt->bindParam(":resp4", $resp4);
        //     $stmt->bindParam(":respTrue", $respTrue);

        //     // // Definir parâmetros
        //     // $param_email = $email;
        //     // $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
        //     var_dump($stmt);
        //     // Tente executar a declaração preparada
        //     if($stmt->execute()){
        //         // Redirecionar para a página de login
        //         header("location: ./dados.php");
        //     } else{
        //         echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
        //     }
        //     // Fechar declaração
        //     unset($stmt);
        // }
    }
} else {
    $perg_err = "Insira os valores";
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title> Perg </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 360px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h2> Pergunta </h2>
        <p> Por favor, preencha os campos para fazer a pergunta. </p>

        <?php
        if (!empty($perg_err)) {
            echo '<div class="alert alert-danger">' . $perg_err . '</div>';
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Pergunta</label>
                <input type="text" name="texto" class="form-control">
                <span class="invalid-feedback"><?php echo $perg_err; ?></span>
            </div>
            <div class="form-group">
                <label>Resposta 1 </label>
                <input type="text" name="resp1" class="form-control">
            </div>
            <div class="form-group">
                <label>Resposta 2 </label>
                <input type="text" name="resp2" class="form-control">
            </div>
            <div class="form-group">
                <label>Resposta 3 </label>
                <input type="text" name="resp3" class="form-control">
            </div>
            <div class="form-group">
                <label>Resposta 4 </label>
                <input type="text" name="resp4" class="form-control">
            </div>
            <select name="respTrue" id="respTrue">
                <option value="1">1°</option>
                <option value="2">2°</option>
                <option value="3">3°</option>
                <option value="4">4°</option>
            </select>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Entrar">
            </div>
            <p>Não tem uma conta? <a href="register.php">Inscreva-se agora</a>.</p>
        </form>
    </div>
</body>

</html>