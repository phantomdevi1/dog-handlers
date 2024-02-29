<?php
session_start();

// Подключение к базе данных
$db_host = 'localhost'; // Хост базы данных
$db_username = 'root'; // Имя пользователя базы данных
$db_password = ''; // Пароль пользователя базы данных
$db_name = 'dog_handlers'; // Имя базы данных

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Защита от SQL инъекций
    $login = mysqli_real_escape_string($conn, $login);
    $password = mysqli_real_escape_string($conn, $password);

    // Хеширование пароля (если используется хеширование)
    // $password = md5($password);

    $sql = "SELECT * FROM Users WHERE Login = '$login' AND Password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Пользователь найден
        $row = $result->fetch_assoc();
        if ($row['IsAdmin'] == 1) {
            // Администратор
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $login;
            header("Location: admin_home.php"); // Перенаправляем на страницу администратора
        } else {
            // Пользователь без прав администратора
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $login;
            header("Location: home.php"); // Перенаправляем на обычную страницу пользователя
        }
    } else {
        echo "Неверный логин или пароль.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Авторизация</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon" />
  </head>
  <body>
    <div class="auth_block">
      <img src="img/logo.svg" alt="" />
      <p>Авторизация</p>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input class="data_input" type="text" name="login" placeholder="Логин" />
        <input class="data_input" type="password" name="password" placeholder="Пароль" />
        <input class="auth_btn" type="submit" value="Войти" />
      </form>
    </div>
  </body>
</html>
