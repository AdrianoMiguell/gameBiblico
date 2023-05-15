<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true) {
    system_error();
}

if (getcwd() == 'C:\xampp\htdocs\gameBiblico') {
    include "./bancoSql/config.php";
} else {
    include "../../bancoSql/config.php";
}

if (isset($_SESSION["email"]) && $_SESSION["email"] == "admin@gmail.com") {
    return header('location: ./pages/admin/dados.php');
}

if (isset($_SESSION["id"]) && $_SESSION["email"]) {
    $id = $_SESSION["id"];
    $email = $_SESSION["email"];
    $fase = $_SESSION["fase"];
    $nivel = $_SESSION["nivel"];

    $dados = (object) ['id' => $id, 'email' => $email, 'fase' => $fase, 'nivel' => $nivel];
} else {
    system_error();
}


function system_error()
{
    if (getcwd() == 'C:\xampp\htdocs\gameBiblico') {
        header("location: ./pages/register_login/login.php");
    } else {
        header("location: ../../pages/register_login./login.php");
    }
    session_destroy();
    exit;
}
