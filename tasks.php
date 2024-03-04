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
  <title>Задания</title>  
  <link rel="stylesheet" href="style.css" />
  <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon" />
  <style>
    .td_pets {
      font-weight: bold;
    }
    .not-completed {
      color: red;
    }
    .completed {
      color: green;
    }
  </style>
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
  <div class="logout_block" style="display: none; margin-right: 10px; text-align: right;">
        <form method="post">
            <button type="submit" name="logout">Выйти</button>
        </form>
    </div>
    <div class="pets_content">
    <p class="title_content">
    Задания
    </p>
    <hr style="border: 1px solid black;">
    <button class="btn_href-pets" onclick="document.location='admin_home.php'">Добавить</button>
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


$sql = "SELECT `dog_id`, `handler_id`, `task`, `start_date`, `end_date`, `status` FROM `Training`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    echo "<table class='table_pets-table' border='0'>";
    echo "<tr class='tr_pets'>
    <th>Кинолог</th>
    <th>Питомец</th>
    <th>Задание</th>
    <th>Дата начала</th>
    <th>Дата окончания</th>
    <th>Статус</th>
    </tr>";
    while($row = $result->fetch_assoc()) {
        // Получаем имя кинолога
        $handler_id = $row["handler_id"];
        $sql_handler = "SELECT `Name` FROM `Users` WHERE `UserID` = '$handler_id'";
        $result_handler = $conn->query($sql_handler);
        $handler_name = "";
        if ($result_handler->num_rows > 0) {
            $row_handler = $result_handler->fetch_assoc();
            $handler_name = $row_handler["Name"];
        }

        // Получаем кличку питомца
        $dog_id = $row["dog_id"];
        $sql_dog = "SELECT `name` FROM `Dogs` WHERE `id` = '$dog_id'";
        $result_dog = $conn->query($sql_dog);
        $dog_name = "";
        if ($result_dog->num_rows > 0) {
            $row_dog = $result_dog->fetch_assoc();
            $dog_name = $row_dog["name"];
        }

        // Проверяем статус задания
        $status = $row["status"];
        $status_text = "";
        $status_class = "";
        if ($status == 0) {
          $status_text = "Не выполнено";
          $status_class = "not-completed";
        } else {
          $status_text = "Выполнено";
          $status_class = "completed";
        }

        echo "<tr>";
        echo "<td class='td_pets'>" . $handler_name . "</td>";
        echo "<td class='td_pets'>" . $dog_name . "</td>";
        echo "<td class='td_pets'>" . $row["task"] . "</td>";
        echo "<td class='td_pets'>" . $row["start_date"] . "</td>";
        echo "<td class='td_pets'><input type='date' value='" . $row["end_date"] . "'></td>";
        echo "<td class='td_pets " . $status_class . "'>" . $status_text . "</td>";
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