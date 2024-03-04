<?php
session_start();

include 'config.php';

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {    
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id']; 
$sql = "SELECT t.*, d.name AS dog_name, d.features, d.breed FROM Training t
        INNER JOIN Dogs d ON t.dog_id = d.id
        WHERE t.status = 0 AND t.handler_id = '$user_id'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Главная</title>
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
<div class="admin_home-content">
    <p class="title_content">
    Задания
    </p>
    <hr style="border: 1px solid black; width: 100%;">
    
      <?php
      // Проверяем, есть ли задания
      if ($result->num_rows > 0) {
          // Выводим задания
          while($row = $result->fetch_assoc()) {
              ?>
              <div class="task_container-home">
              <div class="date_namepet">
                  <p class="date_start-home"><?php echo $row["start_date"]; ?></p>
                  <p class="name_pet-home"><?php echo $row["dog_name"]; ?></p>
                  <p class="date_end-home"><?php echo $row["end_date"]; ?></p>
              </div>
              <p class="task-task_container">Порода: <?php echo $row["breed"]; ?></p>
              <p class="task-task_container"><?php echo $row["task"]; ?></p>
              <p class="pet_features-task">Особенности: <?php echo $row["features"]; ?></p>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                  <input type="hidden" name="task_id" value="<?php echo $row["id"]; ?>">
                  <button class="btn_href-pets" type="submit" name="complete_task">Выполнено</button>
              </form>
              </div>
              <?php
          }
      } else {
          // Если заданий нет
          echo '<p class="non_work">Нет заданий</p>';
      }
      ?>
    
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

if(isset($_POST['complete_task'])){
    // Получаем и очищаем ID задания
    $task_id = mysqli_real_escape_string($conn, $_POST['task_id']);

    // Обновляем статус задания на 1
    $sql = "UPDATE Training SET status = 1 WHERE id = '$task_id'";
    if ($conn->query($sql) === TRUE) {
        // Если обновление прошло успешно, обновляем страницу
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        echo "Ошибка при обновлении статуса задания: " . $conn->error;
    }
}
$conn->close();
?>
