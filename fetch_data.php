<?php
// $servername = "172.18.0.2:3306";
// $username = "docker";
// $password = "docker";
// $dbname = "docker";
    include 'config.php';

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Запрос к базе данных
$sql = "SELECT * FROM configs";
$result = $conn->query($sql);

// Проверка наличия результатов
if ($result->num_rows > 0) {
    // Вывод данных в формате HTML
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td><a href='{$row['link']}' targer='_blank'>{$row['name']}</a></td>
                <td>{$row['date']}</td>
                <td><a href='../lamp/docker-compose-lamp/www/form.php' target='_blank'><img src='/assets/images/edit_icon.png' height='24' width='24'></a></td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>Нет данных</td></tr>";
}

$conn->close();
?>
