<?php
// Запросы к базе данных MySQL при помощи PHP.
require_once 'setting.php';

// Подключение к базе данных через PDO.
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// echo '<pre>';
// print_r($result->fetchAll(PDO::FETCH_ASSOC));
// echo '</pre>';