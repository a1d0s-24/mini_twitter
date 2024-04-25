<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Twitter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="left-side">
            <h1>Mini Twitter</h1>
            <form action="process_tweet.php" method="post">
                <input type="hidden" name="action" value="tweet">
                <label for="tweetContent">Введите ваш твит:</label>
                <input type="text" id="tweetContent" name="content" required>
                <button type="submit">Твитнуть</button>
            </form>
            <div id="authInfo">
                <!-- Здесь будет отображаться информация об авторизации -->
            </div>
        </div>
        <div class="right-side">
            <h2>Лента твитов:</h2>
            <div id="tweetFeed">
                <!-- Здесь будут отображаться твиты -->
            </div>
        </div>
    </div>
    <script src="scripts.js"></script>
</body>
</html>
