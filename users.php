<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Кинологи</title>  
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
    <p class="username">Андрей</p>
  </header>
    <div class="pets_content">
    <p class="title_content">
    Кинологи
    </p>
    <hr style="border: 1px solid black;">
    <button class="btn_href-pets" onclick="document.location='new_user.php'">Добавить</button>
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


$sql = "SELECT `Name`, `DateOfBirth`, `Experience`, `PhoneNumber`, `Address`, `PhotoPath`, `IsAdmin`, `Login`, `Password` FROM `Users`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    echo "<table class='table_pets-table' border='0'>";
    echo "<tr class='tr_pets'>
    <th>Фото</th>
    <th>Имя</th>
    <th>Дата рождения</th>
    <th>Опыт</th>
    <th>Номер телефона</th>
    <th>Адрес</th>
    </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        // Проверяем наличие фотографии
        $photo_path = empty($row["PhotoPath"]) ? "img/default_photo.jpg" : $row["PhotoPath"];
        echo "<td class='td_pets'><img src='" . $photo_path . "' alt='Фото кинолога' class='user_photo' style='width: 100px; height: 100px;'></td>";
        echo "<td class='td_pets'>" . $row["Name"] . "</td>";
        echo "<td class='td_pets'>" . $row["DateOfBirth"] . "</td>";
        echo "<td class='td_pets'>" . $row["Experience"] .' лет' . "</td>";
        echo "<td class='td_pets'>" . $row["PhoneNumber"] . "</td>";
        echo "<td class='td_pets'>" . $row["Address"] . "</td>";
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
