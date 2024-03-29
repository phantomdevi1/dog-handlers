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
  <title>Добавить кинолога</title>  
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
  <div class="logout_block" style="display: none; margin-right: 10px; text-align: right;">
        <form method="post">
            <button type="submit" name="logout">Выйти</button>
        </form>
    </div>
  <div class="admin_home-content">
    <p class="title_content">
    Добавить кинолога
    </p>
    <hr style="border: 1px solid black;">
    <div class="new_task">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="new_user-form" enctype="multipart/form-data">
      <p>Имя</p>
      <input type="text" name="name" id="">
      <p>Опыт</p>
      <input type="number" name="experience" id=""  min="0" max="100">
      <p>Фото</p>
      <input type="file" name="photo" id="">
      <p>Дата рождения</p>
      <input type="date" name="birthdate" id="">
      <p>Номер телефона</p>
      <input type="text" name="phone" id="">
      <p>Домашний адрес</p>
      <input type="text" name="address" id="">
      <p>Будет админом?</p>
      <select name="isAdmin" id="">
        <option value="0">Нет</option>
        <option value="1">Да</option>       
      </select>
      <input type="submit" value="Добавить" class="new_task-btn">
      </form>
    </div>
    </div>
    <?php
    include 'config.php';

    // Проверка, была ли отправлена форма
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Проверка заполненности всех полей формы
        if (empty($_POST['name']) || empty($_POST['experience']) || empty($_POST['birthdate']) || empty($_POST['phone']) || empty($_POST['address'])) {
            echo "<script>alert('Пожалуйста, заполните все поля формы.');</script>";
        } else {
            // Генерация пароля
            $password = substr(md5(rand()), 0, 8);
            
            // Загрузка файла фото
            $target_dir = "img/";
            $temp_file = $_FILES["photo"]["tmp_name"];
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION));
            
            // Проверка, является ли файл изображением
            $check = getimagesize($temp_file);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "<script>alert('Файл не является изображением.');</script>";
                $uploadOk = 0;
            }
            
            // Проверка размера файла
            if ($_FILES["photo"]["size"] > 1500000) {
                echo "<script>alert('Файл слишком большой.');</script>";
                $uploadOk = 0;
            }
            
            // Разрешить определенные форматы файлов
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                echo "<script>alert('Допускаются только JPG, JPEG, PNG & GIF файлы.');</script>";
                $uploadOk = 0;
            }
            
            // Проверка, если $uploadOk равно 0, вывод сообщения об ошибке
            if ($uploadOk == 0) {
                echo "<script>alert('Извините, ваш файл не был загружен.');</script>";
            } else {
                $new_file_name = $target_dir . uniqid() . '.' . $imageFileType;
                if (move_uploaded_file($temp_file, $new_file_name)) {
                    // Запись данных в базу данных
                    $name = $_POST['name'];
                    $experience = $_POST['experience'];
                    $birthdate = $_POST['birthdate'];
                    $phone = $_POST['phone'];
                    $address = $_POST['address'];
                    $isAdmin = $_POST['isAdmin'];
                    $login = $phone;
                    $photoPath = $new_file_name;

                    // SQL запрос для добавления кинолога
                    $sql = "INSERT INTO Users (`Name`, DateOfBirth, Experience, PhoneNumber, `Address`, PhotoPath, IsAdmin, `Login`, `Password`)
                    VALUES ('$name', '$birthdate', $experience, '$phone', '$address', '$photoPath', $isAdmin, '$login', '$password')";

                    if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Кинолог успешно добавлен. Пароль: $password');</script>";
                    } else {
                        echo "<script>alert('Ошибка при добавлении кинолога: " . $conn->error . "');</script>";
                    }
                } else {
                    echo "<script>alert('Извините, возникла ошибка при загрузке вашего файла.');</script>";
                }
            }
        }
    }

    // Закрытие подключения к базе данных
    $conn->close();
    ?>
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