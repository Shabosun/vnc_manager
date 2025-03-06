<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Адаптивная форма</title>
    <style>
        form {
            margin-top: 10%;
            margin-left: 20%;
            margin-right: 20%;
            margin-bottom: 20%;
            border: 2px solid gray;
            padding: 4%;
            display:block;
 
            border-radius: 4%;
        }
        .bi-x-circle{
           
            float: right;
        }


    </style>
</head>
<body>
    <?php
        
    ?>
    <div class="container mt-5">
        <form id="change_settings_form" action="send_data.php" method="POST">
        <svg  id='close_button' xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
        </svg>
        <div class="form-group">
                <label for="name">Название</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Введите название" required>
            </div>
            <div class="form-group">
                <label for="comment">Комментарий</label>
                <textarea class="form-control" name="comment" id="comment" rows="3" placeholder="Введите комментарий" required></textarea>
            </div>
            <div class="form-group">
                <label for="ipaddress">IP-адрес</label>
                <input type="text" class="form-control" name="address"id="address" placeholder="Введите IP-адрес" required>
            </div>
            <div class="form-group">
                <label for="port">Порт</label>
                <input type="text" class="form-control" name="port" id="port" placeholder="Введите порт" required>
            </div>
            <div class="form-group">
                <label for="login">Имя пользователя</label>
                <input type="text" class="form-control" name="login" id="login" placeholder="Введите имя пользователя" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль" required>
            </div>
            <button  type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    const change_settings_form = document.getElementById("change_settings_form");
    const open_form_button = document.getElementById("close_button");
    open_form_button.addEventListener('click', function() {
    if (change_settings_form.style.display === 'none') {
            change_settings_form.style.display = 'block'; // Показываем форму
        } else {
            change_settings_form.style.display = 'none'; // Скрываем форму
        }
});
    </script>
</body>
</html>
