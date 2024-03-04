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
  <title>Питомцы</title>  
  <link rel="stylesheet" href="style.css" />
  <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon" />
</head>
<body>
  <header class="admin_header">
  <div class="toolbar">
      <a href="pets_user.php">Питомцы</a>
      <a href="users_user.php">Кинологи</a>
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
    Питомцы
    </p>
    <hr style="border: 1px solid black;">
    <div class="table_pets">
    <?php
    include 'config.php';


$sql = "SELECT `id`, `name`, `breed`, `birth`, `training_goals`, `features` FROM `Dogs`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    echo "<table class='table_pets-table' border='0'>";
    echo "<tr class='tr_pets'>
    <th>Имя</th>
    <th class='breed_pets'>Порода</th>
    <th class='birthsday_pets'>Дата рождения</th>
    <th class='age_pets'>Возраст</th>
    <th>Цели тренировок</th>
    <th class='features_pets'>Особенности</th>
    </tr>";
    while($row = $result->fetch_assoc()) {
        // Рассчитываем возраст питомца
        $birth_date = new DateTime($row["birth"]);
        $current_date = new DateTime();
        $age = $birth_date->diff($current_date);
        $age_str = $age->y . " лет, " . $age->d . " дней";

        echo "<tr>";
        echo "<td class='td_pets'>" . $row["name"] . "</td>";
        echo "<td class='td_pets breed_pets'>" . $row["breed"] . "</td>";
        echo "<td class='td_pets birthsday_pets'>" . $row["birth"] . "</td>";
        echo "<td class='td_pets age_pets'>" . $age_str . "</td>";
        echo "<td class='td_pets'>" . $row["training_goals"] . "</td>";
        echo "<td class='td_pets features_pets'>" . $row["features"] . "</td>";
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