<?php
//Поключение к базе данных производим через PDO
$host = '127.0.0.1';
$db = 'login_db';
$user = 'root';
$pass = '';
$charset = 'utf8';
//Двойные кавычки позволяют втвавлять переменные в строку
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
//Опции
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
//Пытаемся подключиться к базе данных
try {
    $conn = new PDO($dsn, $user, $pass, $opt);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

return $conn;
