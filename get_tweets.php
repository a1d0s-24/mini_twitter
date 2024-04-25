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
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// Получение твитов из базы данных
$sql = "SELECT content, created_at FROM tweets ORDER BY created_at DESC";
$result = $conn->query($sql);

$tweets = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tweet = [
            "content" => $row["content"],
            "created_at" => $row["created_at"],
        ];
        array_push($tweets, $tweet);
    }
} else {
    echo "Пока что нет твитов.";
}

// Закрываем соединение с базой данных
$conn->close();

// Отправка твитов в формате JSON
header("Content-Type: application/json");
echo json_encode($tweets);
?>
