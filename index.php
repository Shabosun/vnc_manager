<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Таблица с пагинацией на Bootstrap</title>
    <!-- Подключение Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Подключение DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>

.pagination {
            justify-content: center;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2>Пример таблицы с пагинацией</h2>
    <table id="example" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <!-- <th>Комментарий</th> -->
                <th>Дата добавления</th>
            </tr>
        </thead>
        <tbody>
        <?php include 'fetch_data.php'; ?>
         
        </tbody>
    </table>
</div>



<!-- Подключение jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Подключение DataTables JS -->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<!-- Подключение Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>

const change_settings_form = document.getElementById("change_settings_form");
const open_form_button = document.getElementById("image_1");
open_form_button.addEventListener('click', function() {
    if (change_settings_form.style.display === 'none') {
            change_settings_form.style.display = 'block'; // Показываем форму
        } else {
            change_settings_form.style.display = 'none'; // Скрываем форму
        }
});


    $(document).ready(function() {
        $('#example').DataTable(); // Инициализация DataTables
    });


</script>

</body>
</html>