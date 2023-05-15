<?php
// Inicialize a sessão
session_start();
 
// Remova todas as variáveis de sessão
$_SESSION = array();
 
// Destrua a sessão.
session_destroy();
 
// Redirecionar para a página de login
// if(getcwd() == 'C:\xampp\htdocs\gameBiblico'){
//     echo"verfsdes";
//     header("location: ./pages/register_login/login.php");
// }
// else{
    header("location: ../../index.php");
// }  

exit;
?>