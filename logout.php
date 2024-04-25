// logout.php
<?php
session_start();

// Удаляем все данные сессии
$_SESSION = [];

// Уничтожаем сессию
session_destroy();

// Перенаправляем пользователя на страницу входа или другую страницу
header("Location: login.php");
exit();


?>
