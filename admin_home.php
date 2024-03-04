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
  <title>Главная</title>  
  <link rel="stylesheet" href="style.css" />
  <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon" />
</head>
<body>
  <header class="admin_header">
    <div class="toolbar">
      <a href="pets.php">Питомцы</a>
      <a href="users.php">Кинологи</a>
      <a href="tasks.php">Задания</a>
      <a href="">Дать задание</a>
    </div>
    <img src="img/logo.svg" alt="">
    <p class="username"><?php echo $_SESSION['username']; ?></p>
  </header>
  <div class="admin_home-content">
    <p class="title_content">
    Дать задание
    </p>
    <hr style="border: 1px solid black;">
    <div class="new_task">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="new_task-form" onsubmit="return validateForm()">
        <p>Кинолог</p>
        <select name="handler_id" id="" class="select_new_task">
          <?php
          // Подключение к базе данных для получения данных кинологов
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "dog_handlers";

          $conn = new mysqli($servername, $username, $password, $dbname);
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          // Запрос для получения данных кинологов
          $sql = "SELECT `UserID`, `Name` FROM `Users`";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // Вывод данных в селект
              while($row = $result->fetch_assoc()) {
                  echo "<option value='" . $row["UserID"] . "'>" . $row["Name"] . "</option>";
              }
          } else {
              echo "0 результатов";
          }
          $conn->close();
          ?>
        </select>
        <p>Питомец</p>
        <select name="dog_id" id="" class="select_new_task">
          <?php
          // Подключение к базе данных для получения данных питомцев
          $conn = new mysqli($servername, $username, $password, $dbname);
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          // Запрос для получения данных питомцев
          $sql = "SELECT `id`, `name` FROM `Dogs`";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // Вывод данных в селект
              while($row = $result->fetch_assoc()) {
                  echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
              }
          } else {
              echo "0 результатов";
          }
          $conn->close();
          ?>
        </select>
        <p>Задание</p>
        <textarea name="task" cols="30" rows="10" class="textarea_new_task"></textarea>
        <div class="date_new_task">
          <div class="startdate_new_task">
            <p>Начать</p>
            <input type="date" name="start_date">
          </div>
          <div class="enddate_new_task">
            <p>Закончить</p>
            <input type="date" name="end_date">
          </div>            
        </div>
        <input type="submit" value="Выдать" class="new_task-btn">
      </form>
    </div>
  </div>

<?php
// Обработка формы после отправки
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Подключение к базе данных для добавления данных в таблицу Training
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Получение и очистка данных из формы
    $handler_id = $_POST["handler_id"];
    $dog_id = $_POST["dog_id"];
    $task = $_POST["task"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    // Проверка на заполненность всех полей
    if(empty($handler_id) || empty($dog_id) || empty($task) || empty($start_date) || empty($end_date)) {
        echo "<script>alert('Пожалуйста, заполните все поля.');</script>";
    } else {
        // SQL-запрос для добавления данных в таблицу Training
        $sql = "INSERT INTO Training (dog_id, handler_id, task, `start_date`, end_date, `status`)
                VALUES ('$dog_id', '$handler_id', '$task', '$start_date', '$end_date', 0)";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Задание успешно добавлено!');</script>";
        } else {
            echo "<script>alert('Ошибка при добавлении задания: " . $conn->error . "');</script>";
        }
    }

    $conn->close();
}
?>

<script>
  function validateForm() {
    var handler_id = document.forms["new_task-form"]["handler_id"].value;
    var dog_id = document.forms["new_task-form"]["dog_id"].value;
    var task = document.forms["new_task-form"]["task"].value;
    var start_date = document.forms["new_task-form"]["start_date"].value;
    var end_date = document.forms["new_task-form"]["end_date"].value;

    if (handler_id == "" || dog_id == "" || task == "" || start_date == "" || end_date == "") {
      alert("Пожалуйста, заполните все поля.");
      return false;
    }
  }
</script>

</body>
</html>
