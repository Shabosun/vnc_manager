<?php
    include '../config.php';


    if(isset($_POST['delete'])){
        $idsToDelete = $_POST['ids'];
        if(!empty($idsToDelete)){
            $ids = implode(',', array_map('intval', $idsToDelete));
            $conn->query("DELETE FROM test_configs WHERE id IN ($ids)");
        }
    }
    $sql = "SELECT * FROM test_configs;";
    $result = $conn->query($sql);

    $conn->close();
?>



<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VNC Manager</title>
    <!-- Подключение Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Подключение DataTables CSS -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
    <!-- style for DataTables-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
    <style>
        .container {
            margin-top: 20px;
        }
        .pagination{
            justify-content: center;
            
        }
    </style>
</head>
<body>
<nav class="navbar bg-body-tertiary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="../assets/images/logo_monitor_icon.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
      VNC Manager
    </a>
  </div>
</nav>
<div class="container mt-5">
    <!-- <h2>Пример таблицы с пагинацией</h2> -->
    <form method="post" action="">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <!-- <th>Комментарий</th> -->
                <th>Дата добавления</th>
                <th><input type="checkbox" id="selectAll"></th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><input type="checkbox" name="ids[]" value="<?php echo $row['id']; ?>"></td>
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

<script>

// const change_settings_form = document.getElementById("change_settings_form");
// const open_form_button = document.getElementById("image_1");
// open_form_button.addEventListener('click', function() {
//     if (change_settings_form.style.display === 'none') {
//             change_settings_form.style.display = 'block'; // Показываем форму
//         } else {
//             change_settings_form.style.display = 'none'; // Скрываем форму
//         }
// });


    $(document).ready(function() {
        $('#example').DataTable({

            language: {
                url: '//cdn.datatables.net/plug-ins/2.2.2/i18n/ru.json'
            }
        }
        ); // Инициализация DataTables
    });
    document.getElementById('selectAll').onclick = function() {
        const checkboxes = document.querySelectorAll('input[name="ids[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    };

</script>

</body>
</html>