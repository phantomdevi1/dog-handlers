<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dog_handlers";

// Создаем подключение
$conn = mysqli_connect($host, $user, $pass, $database);

if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}
?>