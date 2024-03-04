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
  <title>Добавить питомца</title>  
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
    <div class="new_pet_content">
    <p class="title_content">
    Добавить питомца
    </p>
    <hr style="border: 1px solid black;">
    <div class="new_task">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="new_task-form" onsubmit="return validateForm()">
      <p>Кличка</p>
      <input type="text" class="select_new_task" name="name" id="name">
      <p>Порода</p>
      <input type="text" class="select_new_task" name="breed" id="breed">
      <p>Дата рождения</p>
      <input type="date" class="select_new_task" name="birth" id="birth">
      <p>Цели</p>
      <textarea name="training_goals" cols="30" rows="10" class="textarea_new_task" id="training_goals"></textarea>
      <p>Особенности</p>
      <textarea name="features" cols="30" rows="10" class="textarea_new_task" id="features"></textarea>
      <input type="submit" value="Добавить" class="new_task-btn">
      </form>
    </div>
    </div>

<?php
// Обработка формы после отправки
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Подключение к базе данных
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dog_handlers";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Получение и очистка данных из формы
    $name = $_POST["name"];
    $breed = $_POST["breed"];
    $birth = $_POST["birth"];
    $training_goals = $_POST["training_goals"];
    $features = $_POST["features"];

    // Проверка на заполненность всех полей
    if (empty($name) || empty($breed) || empty($birth) || empty($training_goals) || empty($features)) {
        echo "<script>alert('Пожалуйста, заполните все поля!');</script>";
    } else {
        // SQL-запрос для добавления нового питомца
        $sql = "INSERT INTO Dogs (name, breed, birth, training_goals, features)
                VALUES ('$name', '$breed', '$birth', '$training_goals', '$features')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Питомец успешно добавлен!');</script>";
        } else {
            echo "<script>alert('Ошибка при добавлении питомца: " . $conn->error . "');</script>";
        }
    }

    $conn->close(); // Закрываем соединение с базой данных
}
?>

<script>
  function validateForm() {
    var name = document.getElementById("name").value;
    var breed = document.getElementById("breed").value;
    var birth = document.getElementById("birth").value;
    var training_goals = document.getElementById("training_goals").value;
    var features = document.getElementById("features").value;
    
    if (name == "" || breed == "" || birth == "" || training_goals == "" || features == "") {
      alert("Пожалуйста, заполните все поля!");
      return false;
    }
    return true;
  }
</script>

</body>
</html>
