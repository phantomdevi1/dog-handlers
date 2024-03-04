<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dog_handlers";

// Создаем подключение
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}
?>