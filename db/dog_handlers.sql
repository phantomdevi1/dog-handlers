-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Мар 01 2024 г., 17:31
-- Версия сервера: 8.0.30
-- Версия PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dog_handlers`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Dogs`
--

CREATE TABLE `Dogs` (
  `id` int NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `breed` varchar(50) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `training_goals` text,
  `features` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Dogs`
--

INSERT INTO `Dogs` (`id`, `name`, `breed`, `birth`, `training_goals`, `features`) VALUES
(4, 'Барон', 'Немецкая овчарка', '2018-05-15', 'Охрана дома', 'Чёрный окрас, крупный, умный'),
(5, 'Рекс', 'Лабрадор ретривер', '2019-02-20', 'Поиск наркотиков', 'Рыжий окрас, игривый, обучаемый'),
(6, 'Маркиз', 'Французский бульдог', '2017-11-10', 'Компаньон', 'Белый окрас, короткая морда, ленивый'),
(7, 'Шарик', 'Дворняга', '2016-08-10', 'Любимец семьи', 'Белый цвет, крупный размер, добрый характер'),
(8, 'Барбос', 'Сенбернар', '2019-05-25', 'Охрана территории', 'Полосатый окрас, мощное телосложение, умный'),
(9, 'Лорд', 'Пудель', '2017-11-03', 'Участие в собачьих выставках', 'Черный цвет, кудрявая шерсть, игривый'),
(10, 'Бим', 'Бассет-хаунд', '2018-02-15', 'Собачьи виды спорта', 'Коричневый окрас, длинные уши, выносливый'),
(11, 'Дейзи', 'Далматин', '2020-04-30', 'Участие в фильмах', 'Белый окрас с черными пятнами, энергичный'),
(12, 'Рекс', 'Боксер', '2019-10-12', 'Спортивные мероприятия', 'Мускулистый торс, короткая морда, дружелюбный'),
(13, 'Тайсон', 'Ротвейлер', '2017-06-20', 'Охрана объектов', 'Черный с коричневыми отметинами, сильный и ловкий'),
(14, 'Марли', 'Кокер-спаниель', '2018-08-05', 'Участие в собачьих конкурсах', 'Золотистый окрас, пушистая шерсть, игривый'),
(15, 'Хатико', 'Акита-ину', '2016-12-01', 'Верный друг', 'Белый окрас, выносливый, преданный'),
(16, 'Лайка', 'Хаски', '2019-03-18', 'Участие в собачьих упряжках', 'Серо-белый окрас, голубые глаза, энергичный'),
(17, 'Арчи', 'Бордер-колли', '2017-09-10', 'Пастушья работа', 'Черно-белый окрас, умный, быстрый'),
(18, 'Джек', 'Фокс-терьер', '2020-01-07', 'Охота на грызунов', 'Рыжий окрас, короткая шерсть, игривый'),
(19, 'Белла', 'Мопс', '2018-11-22', 'Участие в собачьих выставках', 'Бежевый окрас, короткая морда, ласковая'),
(20, 'Макс', 'Йоркширский терьер', '2019-07-14', 'Полезный помощник', 'Серый с черными отметинами, активный, остроумный'),
(21, 'Люк', 'Русский спаниель', '2018-04-09', 'Собачий охотник', 'Бело-рыжий окрас, курчавая шерсть, ловкий'),
(22, 'Майло', 'Бультерьер', '2017-10-30', 'Участие в дрессировке', 'Серый с белыми отметинами, сильный, преданный'),
(23, 'Хлоя', 'Мальтийская болонка', '2020-02-28', 'Участие в детских мероприятиях', 'Белоснежная шерсть, маленький рост, нежный'),
(24, 'Джесси', 'Джек-рассел-терьер', '2019-11-15', 'Соревнования в малом манеже', 'Бело-коричневый окрас, энергичный, сообразительный'),
(25, 'Тоби', 'Кавалер-кинг-чарльз-спаниель', '2018-06-05', 'Участие в выставках красоты', 'Черно-белый окрас, длинные уши, спокойный'),
(26, 'Дик', 'Ши-тцу', '2017-04-12', 'Сопровождение инвалидов', 'Белый с коричневыми отметинами, пушистая шерсть, спокойный'),
(27, 'Мия', 'Австралийская овчарка', '2018-09-08', 'Пастушья работа', 'Серо-белый окрас, умный, работящий'),
(28, 'Жак', 'Папильон', '2019-08-20', 'Собачьи конкурсы по ловкости', 'Бело-коричневый окрас, длинные уши, подвижный'),
(29, 'Флойд', 'Мастиф', '2016-05-28', 'Охрана территории', 'Черный окрас, массивное телосложение, мощный'),
(30, 'Бен', 'Борзая', '2017-02-04', 'Спортивные соревнования', 'Бело-черный окрас, стройное телосложение, быстрый'),
(31, 'Харли', 'Чихуахуа', '2019-01-10', 'Сопровождение хозяев', 'Коричневый окрас, миниатюрный размер, игривый'),
(32, 'Рекс', 'Немецкая овчарка', '2024-02-26', 'Научить базовым командам', 'Аллергия на курицу');

-- --------------------------------------------------------

--
-- Структура таблицы `Training`
--

CREATE TABLE `Training` (
  `id` int NOT NULL,
  `dog_id` int NOT NULL,
  `handler_id` int NOT NULL,
  `task` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Training`
--

INSERT INTO `Training` (`id`, `dog_id`, `handler_id`, `task`, `start_date`, `end_date`, `status`) VALUES
(14, 4, 1, 'Научить прыгать высоко', '2024-03-02', '2024-03-14', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE `Users` (
  `UserID` int NOT NULL,
  `Name` varchar(100) NOT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Experience` int DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `PhotoPath` varchar(255) DEFAULT NULL,
  `IsAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `Login` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`UserID`, `Name`, `DateOfBirth`, `Experience`, `PhoneNumber`, `Address`, `PhotoPath`, `IsAdmin`, `Login`, `Password`) VALUES
(1, 'Admin', '1990-01-01', 10, '123-456-7890', '123 Admin St, City', NULL, 1, 'admin', 'admin'),
(2, 'Алексей Петров', '1986-07-12', 6, '1234567890', 'г. Москва, ул. Пушкина, д.10', 'img/photo1.jpg', 0, 'aleksey', 'password1'),
(3, 'Елена Иванова', '1989-05-28', 8, '0987654321', 'г. Санкт-Петербург, ул. Ленина, д.5', 'img/photo2.jpg', 0, 'elena', 'password2'),
(4, 'Михаил Сидоров', '1985-10-15', 4, '2345678901', 'г. Новосибирск, ул. Гагарина, д.15', 'img/photo3.jpg', 0, 'mikhail', 'password3'),
(5, 'Ольга Кузнецова', '1991-12-03', 3, '3456789012', 'г. Екатеринбург, ул. Кирова, д.20', 'img/photo4.jpg', 0, 'olga', 'password4'),
(6, 'Андрей Васильев', '1987-04-20', 5, '4567890123', 'г. Казань, ул. Ленина, д.25', 'img/photo5.jpg', 0, 'andrey', 'password5'),
(7, 'Наталья Попова', '1990-09-08', 7, '5678901234', 'г. Челябинск, ул. Красная, д.30', 'img/photo6.jpg', 0, 'natalya', 'password6'),
(8, 'Иван Козлов', '1984-06-17', 9, '6789012345', 'г. Самара, ул. Мира, д.35', 'img/photo7.jpg', 0, 'ivan', 'password7');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Dogs`
--
ALTER TABLE `Dogs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Training`
--
ALTER TABLE `Training`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dog_id` (`dog_id`),
  ADD KEY `handler_id` (`handler_id`);

--
-- Индексы таблицы `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserID` (`UserID`),
  ADD UNIQUE KEY `Login` (`Login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Dogs`
--
ALTER TABLE `Dogs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `Training`
--
ALTER TABLE `Training`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `UserID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Training`
--
ALTER TABLE `Training`
  ADD CONSTRAINT `training_ibfk_1` FOREIGN KEY (`dog_id`) REFERENCES `Dogs` (`id`),
  ADD CONSTRAINT `training_ibfk_2` FOREIGN KEY (`handler_id`) REFERENCES `Users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
