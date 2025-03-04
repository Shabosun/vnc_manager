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
        <?php include '../fetch_data.php'; ?>
            <!-- <tr>
                <td>1</td>
                <td>Иван</td>
                <td>Иванов</td>
                <td>25</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Петр</td>
                <td>Петров</td>
                <td>30</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Светлана</td>
                <td>Сидорова</td>
                <td>28</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Алексей</td>
                <td>Алексеев</td>
                <td>35</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Мария</td>
                <td>Маркова</td>
                <td>22</td>
            </tr>
            <tr>
                <td>6</td>
                <td>Дмитрий</td>
                <td>Дмитриев</td>
                <td>40</td>
            </tr>
            <tr>
                <td>7</td>
                <td>Елена</td>
                <td>Еленина</td>
                <td>29</td>
            </tr>
            <tr>
                <td>8</td>
                <td>Николай</td>
                <td>Николаев</td>
                <td>33</td>
            </tr>
            <tr>
                <td>9</td>
                <td>Ольга</td>
                <td>Ольгина</td>
                <td>27</td>
            </tr>
            <tr>
                <td>10</td>
                <td>Сергей</td>
                <td>Сергеев</td>
                <td>31</td>
            </tr>
            <tr>
                <td>11</td>
                <td>Сергей</td>
                <td>Сергеев</td>
                <td>31</td>
            </tr>
            <tr>
                <td>12</td>
                <td>Сергей</td>
                <td>Сергеев</td>
                <td>31</td>
            </tr>
            <tr>
                <td>13</td>
                <td>Сергей</td>
                <td>Сергеев</td>
                <td>31</td>
            </tr>
            <tr>
                <td>14</td>
                <td>Сергей</td>
                <td>Сергеев</td>
                <td>31</td>
            </tr>
            <tr>
                <td>15</td>
                <td>Сергей</td>
                <td>Сергеев</td>
                <td>31</td>
            </tr> -->
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
    $(document).ready(function() {
        $('#example').DataTable(); // Инициализация DataTables
    });
</script>

</body>
</html>