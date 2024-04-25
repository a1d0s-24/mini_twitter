<?php
session_start();

// Подключение к базе данных
$servername = "localhost";
$username = "1234";
$password = "1234";
$dbname = "1234";

// Создаем подключение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем подключение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Проверяем, был ли отправлен твит
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $content = $_POST["content"];

    // Получаем ID пользователя из сессии
    $user_id = $_SESSION["user_id"];

    // Подготавливаем запрос для вставки твита в базу данных
    $sql = "INSERT INTO tweets (user_id, content) VALUES (?, ?)";

    // Подготавливаем запрос
    $stmt = $conn->prepare($sql);

    // Привязываем параметры
    $stmt->bind_param("is", $user_id, $content);

    // Выполняем запрос
    if ($stmt->execute()) {
        // Перенаправляем пользователя на главную страницу
        header("Location: index.php");
        exit(); // Прекращаем выполнение скрипта после перенаправления
    } else {
        // Ошибка при добавлении твита
        echo "Ошибка: " . $stmt->error;
    }

    // Закрываем запрос
    $stmt->close();
} else {
    // Если метод запроса не POST, выводим сообщение об ошибке
    echo "Ошибка: Неправильный метод запроса.";
}

// Закрываем соединение с базой данных
$conn->close();
?>
