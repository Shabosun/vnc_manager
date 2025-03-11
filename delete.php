<?php
$servername = "localhost"; // Замените на ваши данные
$username = "docker"; // Замените на ваши данные
$password = "docker"; // Замените на ваши данные
$dbname = "docker"; // Замените на имя вашей базы данных

// Создаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Удаление записей
if (isset($_POST['delete'])) {
    $idsToDelete = $_POST['ids'];
    if (!empty($idsToDelete)) {
        $ids = implode(',', array_map('intval', $idsToDelete));
        $conn->query("DELETE FROM users WHERE id IN ($ids)");
    }
}

// Получаем данные пользователей
$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Удаление записей</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Список пользователей</h2>
    <form method="POST" action="">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll"></th>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Возраст</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="<?php echo $row['id']; ?>"></td>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['age']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Нет данных</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <button type="submit" name="delete" class="btn btn-danger">Удалить выбранные</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Выбор всех чекбоксов
    document.getElementById('selectAll').onclick = function() {
        const checkboxes = document.querySelectorAll('input[name="ids[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    };
</script>

</body>
</html>

<?php
$conn->close();
?>
