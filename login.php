<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Вход</h1>
        <form action="process_auth.php" method="post" class="auth-form">
            <input type="hidden" name="action" value="login">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" class="btn">Войти</button>
        </form>
        <p>Еще не зарегистрированы? <a href="register.php" class="link">Зарегистрироваться</a></p>
    </div>
</body>
</html>
