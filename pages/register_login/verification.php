<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    if (getcwd() != 'C:\xampp\htdocs\gameBiblico') {
        include "../../bancoSql/config.php";
    } else {
        include "./bancoSql/config.php";
    }

    if (isset($_SESSION["email"]) && $_SESSION["email"] == "admin@gmail.com") {
        return header('location: ../admin/dados.php');
    }
    
    $id = $_SESSION["id"];
    $result = $pdo->prepare("SELECT * FROM users WHERE id = $id ");
    $result->execute();

    if (!isset($result) && $result->rowCount() != 1) {
        echo "\nMais de um usuario. PDO::errorInfo():\n";
        print_r($dbh->errorInfo());
        exit;
    }

    $row = $result->fetch(PDO::FETCH_ASSOC);

    $id = $row['id'];
    $email = $row['email'];
    $fase = $row['fase'];
    $nivel = $row['nivel'];

    $dados = (object) ['id' => $id, 'email' => $email, 'fase' => $fase, 'nivel' => $nivel];
    return [$result, $dados];
} else {
    if (getcwd() != 'C:\xampp\htdocs\gameBiblico') {
        header("location: ../../pages/register_login./login.php");
        exit;
    } else {
        header("location: ./login.php");
        exit;
    }
}
