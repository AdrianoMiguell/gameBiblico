<?php

$username = "root";
$password = '';

try {
    $pdo = new Pdo('mysql:host=localhost; dbname=game_quiz;', $username, $password);
    // $data = $pdo->query('SELECT * FROM users');

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

return $pdo;
