<?php
session_start();

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {    
    header("Location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Питомцы</title>  
  <link rel="stylesheet" href="style.css" />
  <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon" />
</head>
<body>
  <header class="admin_header">
    <div class="toolbar">
      <a href="pets.php">Питомцы</a>
      <a href="users.php">Кинологи</a>
      <a href="tasks.php">Задания</a>
      <a href="admin_home.php">Дать задание</a>
    </div>
    <img src="img/logo.svg" alt="">
    <p class="username"><?php echo $_SESSION['username']; ?></p>
  </header>
    <div class="pets_content">
    <p class="title_content">
    Питомцы
    </p>
    <hr style="border: 1px solid black;">
    <button class="btn_href-pets" onclick="document.location='new_pet.php'">Добавить</button>
    <div class="table_pets">
    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dog_handlers";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT `id`, `name`, `breed`, `birth`, `training_goals`, `features` FROM `Dogs`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    echo "<table class='table_pets-table' border='0'>";
    echo "<tr class='tr_pets'>
    <th>Имя</th>
    <th>Порода</th>
    <th>Дата рождения</th>
    <th>Возраст</th>
    <th>Цели тренировок</th>
    <th>Особенности</th>
    </tr>";
    while($row = $result->fetch_assoc()) {
        // Рассчитываем возраст питомца
        $birth_date = new DateTime($row["birth"]);
        $current_date = new DateTime();
        $age = $birth_date->diff($current_date);
        $age_str = $age->y . " лет, " . $age->d . " дней";

        echo "<tr>";
        echo "<td class='td_pets'>" . $row["name"] . "</td>";
        echo "<td class='td_pets'>" . $row["breed"] . "</td>";
        echo "<td class='td_pets'>" . $row["birth"] . "</td>";
        echo "<td class='td_pets'>" . $age_str . "</td>";
        echo "<td class='td_pets'>" . $row["training_goals"] . "</td>";
        echo "<td class='td_pets'>" . $row["features"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 результатов";
}
$conn->close();
?>


    </div>
    </div>
  </body>
</html>