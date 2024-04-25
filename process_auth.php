<?php
session_start();
// Подключение к базе данных
$servername = "localhost";
$username = "1234";
$password = "1234";
$dbname = "1234";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// Регистрация пользователя
if ($_POST["action"] == "register") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Хеширование пароля перед сохранением в базу данных
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
    if ($conn->query($sql) === true) {
        echo "Регистрация успешна.";
    } else {
        echo "Ошибка регистрации: " . $conn->error;
    }
}
// Вход пользователя
elseif ($_POST["action"] == "login") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Проверка соответствия пароля хешу в базе данных
        if (password_verify($password, $row["password"])) {
            $_SESSION["user_id"] = $row["id"];
            echo "Вход выполнен успешно.";
            header("Location: index.php"); // Перенаправляем пользователя на главную страницу
        } else {
            echo "Неверный пароль.";
        }
    } else {
        echo "Пользователь не найден.";
    }
}

$conn->close();
?>
