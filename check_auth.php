<?php
session_start();

$response = [];

if (isset($_SESSION["user_id"])) {
    // Пользователь авторизован
    $response["authenticated"] = true;
    // Здесь вы можете получить имя пользователя из базы данных или сессии
    $response["username"] = "Пользователь"; // Замените на имя пользователя из базы данных или сессии
} else {
    // Пользователь не авторизован
    $response["authenticated"] = false;
}

header("Content-Type: application/json");
echo json_encode($response);

?>