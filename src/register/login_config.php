<?php
// Inicialize a sessão
session_start();
 
// Verifique se o usuário já está logado, em caso afirmativo, redirecione-o para a página de boas-vindas
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../../fases.php");
    exit;
}
 
// Incluir arquivo de configuração
require_once '../../bancoSql/config.php';
 
// Defina variáveis e inicialize com valores vazios
$email = $password = "";
$email_err = $password_err = $login_err = "";
 
// Processando dados do formulário quando o formulário é enviado
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Verifique se o nome de usuário está vazio
    if(empty(trim($_POST["email"]))){
        $email_err = "Por favor, insira o nome de usuário.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Verifique se a senha está vazia
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor, insira sua senha.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validar credenciais
    if(empty($email_err) && empty($password_err)){
        // Prepare uma declaração selecionada
        $sql = "SELECT id, email, password, fase, nivel FROM users WHERE email = :email";
        
        if($stmt = $pdo->prepare($sql)){
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            
            // Definir parâmetros
            $param_email = trim($_POST["email"]);
            
            // Tente executar a declaração preparada
            if($stmt->execute()){
                // Verifique se o nome de usuário existe, se sim, verifique a senha
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        
                        $id = $row["id"];
                        $email = $row["email"];
                        $hashed_password = $row["password"];
                        $fase = $row["fase"];
                        $nivel = $row["nivel"];

                        if(password_verify($password, $hashed_password)){
                            // A senha está correta, então inicie uma nova sessão
                            session_start();
                            
                            // Armazene dados em variáveis de sessão
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;                            
                            $_SESSION["fase"] = $fase;  
                            $_SESSION["nivel"] = $nivel;                      
                            // Redirecionar o usuário para a página de boas-vindas
                            header("location: ../../fases.php");
                        } else if($password === $hashed_password){
                             session_start();
                            
                             $_SESSION["loggedin"] = true;
                             $_SESSION["id"] = $id;
                             $_SESSION["email"] = $email;                            
                             $_SESSION["fase"] = $fase;
                             $_SESSION["nivel"] = $nivel;                           
                             
                             header("location: ../../fases.php");
                            }
                        else{
                            // A senha não é válida, exibe uma mensagem de erro genérica
                            $login_err = "Nome de usuário ou senha inválidos.";
                        }
                    }
                } else{
                    // O nome de usuário não existe, exibe uma mensagem de erro genérica
                    $login_err = "Nome de usuário ou senha inválidos.";
                }
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechar declaração
            unset($stmt);
        }
    }
    
    // Fechar conexão
    unset($pdo);
}
?>
 