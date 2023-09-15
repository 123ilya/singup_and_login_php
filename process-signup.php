<?php
// Проводим проверку введённой в форму информации на стороне сервера.
if (empty($_POST['name'])) {
    die("Name is required!");
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    die("Email is required!");
}
//Проверяем длинну введённого пароля
if (strlen($_POST['password']) < 8) {
    die("Password mast be at least 8 characters!");
}
//Проверяем введённый пароль на наличие обязательных символов.
if (!preg_match("/[a-z]/i", $_POST['password'])) {
    die("Password mast contain at least one letter!");
}
if (!preg_match("/[0-9]/i", $_POST['password'])) {
    die("Password mast contain at least one number!");
}
if ($_POST['password'] !== $_POST['password_confirmation']) {
    die("Passwords mast match! ");
}
//Шифруем пароль
$password_hash =  password_hash($_POST['password'], PASSWORD_DEFAULT);
$name = $_POST['name'];
$email = $_POST['email'];

//Подключаем скрипт с данными для подключения к базе данных. Используем "волшебную" константу __DIR__
//Данная константа возвращает строку (путь к текущей дирректории).
//Так как подключаемый скрипт возвращает значение, то мы присваиваем это значение переменной $mysqli
//для того, чтобы в последствии была возможность его использовать.
$conn = require __DIR__ . "/database.php";

$stmt = $conn->prepare("INSERT INTO user (name, email, password_hash)
  VALUES (:name, :email, :password_hash)");
$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password_hash', $password_hash);
$stmt->execute();

print_r($_POST);
var_dump($password_hash);
