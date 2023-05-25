<?php

$username = "root";
$password = '';

try {
    $pdo = new Pdo('mysql:host=localhost; dbname=game_quiz;', $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
    exit;
}

return $pdo;
