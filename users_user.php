<?php
session_start();

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {    
  header("Location: index.php");
  exit;
}
?>


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
      <a href="pets_user.php">Питомцы</a>
      <a href="users.php">Кинологи</a>
      <a href="home.php">Задания</a>
    </div>
    <p class="username"><?php echo $_SESSION['username']; ?></p>
  </header>
  <div class="logout_block" style="display: none; margin-right: 10px; text-align: right;">
        <form method="post">
            <button type="submit" name="logout">Выйти</button>
        </form>
    </div>
    <div class="pets_content">
    <p class="title_content">
    Кинологи
    </p>
    <hr style="border: 1px solid black;">
    <div class="table_pets">
    <?php
    include 'config.php';


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
    <script>
    document.querySelector('.username').addEventListener('click', function() {
        document.querySelector('.logout_block').style.display = 'block';
    });
</script>
  </body>
</html>
<?php
if(isset($_POST['logout'])){
    // Очищаем сессию
    $_SESSION = array();

    // Уничтожаем сессию
    session_destroy();

    // Перенаправляем пользователя на index.php
    header("Location: index.php");
    exit;
}
?>