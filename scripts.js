window.onload = function () {
    loadTweets(); // Загрузка твитов при загрузке страницы
    checkAuthStatus(); // Проверка статуса авторизации при загрузке страницы
  };
  
  // Функция для загрузки твитов на правую сторону страницы
  function loadTweets() {
    var tweetFeed = document.getElementById("tweetFeed");
    tweetFeed.innerHTML = "Загрузка твитов...";
  
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "get_tweets.php", true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          var tweets = JSON.parse(xhr.responseText);
          if (tweets.length > 0) {
            tweetFeed.innerHTML = ""; // Очищаем контейнер перед добавлением новых твитов
            tweets.forEach(function (tweet) {
              var tweetDiv = document.createElement("div");
              tweetDiv.className = "tweet";
              tweetDiv.innerHTML =
                "<p>" +
                tweet.content +
                "</p><span class='tweetTime'>" +
                tweet.created_at +
                "</span>";
              tweetFeed.appendChild(tweetDiv);
            });
          } else {
            tweetFeed.innerHTML = "Пока что нет твитов.";
          }
        } else {
          tweetFeed.innerHTML = "Ошибка загрузки твитов.";
        }
      }
    };
    xhr.send();
  }
  
  // Функция для проверки статуса авторизации
  function checkAuthStatus() {
    var authInfoDiv = document.getElementById("authInfo");
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "check_auth.php", true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          if (response.authenticated) {
            authInfoDiv.innerHTML =
              "Вы вошли как: " +
              response.username +
              "<br><button onclick='logout()'>Выход</button>";
          } else {
            authInfoDiv.innerHTML =
              "<h2>Войти или зарегистрироваться:</h2><ul><li><a href='login.php'>Вход</a></li><li><a href='register.html'>Регистрация</a></li></ul>";
          }
        } else {
          console.log("Ошибка проверки статуса авторизации: " + xhr.status);
        }
      }
    };
    xhr.send();
  }
  
  // Функция для выхода из аккаунта
  function logout() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "logout.php", true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          window.location.reload(); // Перезагрузка страницы после выхода
        } else {
          console.log("Ошибка при выходе из аккаунта: " + xhr.status);
        }
      }
    };
    xhr.send();
  }
  