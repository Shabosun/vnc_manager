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
        .modal {
            display: none; /* Скрываем модальную форму по умолчанию */
            position: fixed;
            z-index: 1000; /* Устанавливаем высокий z-index, чтобы форма была поверх других элементов */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Полупрозрачный фон */
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: white;
            padding: 2%;
            border-radius: 5px;
            width: 600px;
            border-radius: 4%;
        }


        .bi-x-circle{
           
           float: right;
       }
        #table-form {
            z-index: 0;
            position:fixed;
        }
        .show_pass{
            margin: 1%;
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
    <form method="post" action="">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <!-- <th>Комментарий</th> -->
                <th>Дата добавления</th>
                <!-- <th></th> -->
                <th><input type="checkbox" id="selectAll" ></th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><input class='cb' type="checkbox" name="ids[]" value="<?php echo $row['id']; ?>"></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Нет данных</td>
                    </tr>
                <?php endif; ?>
        </tbody>
    </table>
    <button id="button_delete" type="submit" name="delete" disabled='true'class="btn btn-danger">Удалить выбранные</button>
    <button id="button_open_form" type="button" name="open_form" class="btn btn-success">Добавить элемент</button>
   </form> 
</div>
    
<div class="modal" id="modal">
    <div class="modal-content">
    <form id="form_add_element" action="../send_data.php" method="POST">
        <svg  id='button_close_form' xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
        </svg>
        <div class="form-group">
                <label for="name">Название</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Введите название" required>
            </div>
            <div class="form-group">
                <label for="comment">Комментарий</label>
                <textarea class="form-control" name="comment" id="comment" rows="3" placeholder="Введите комментарий"></textarea>
            </div>
            <div class="form-group">
                <label for="address">IP-адрес</label>
                <input type="text" class="form-control" name="address"id="address" placeholder="Введите IP-адрес" pattern="^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$" required>
            </div>
            <div class="form-group">
                <label for="port">Порт</label>
                <input type="text" class="form-control" name="port" id="port" placeholder="Введите порт" pattern= "^\d{1,5}$" required>
            </div>
            <div class="form-group">
                <label for="login">Имя пользователя</label>
                <input type="text" class="form-control" name="login" id="login" placeholder="Введите имя пользователя" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль" required>
                <div class="show_pass">
                    <input type="checkbox" name="cb_pass" id="cb_pass" >
                    <label for="cb_pass">Показать пароль</label>
                </div>
                
            </div>
            <button id="button_add_element" type="submit" class="btn btn-primary">Добавить</button>
        </form>

    </div>
</div>
   




<script>

            //Открытие и закрытие формы для добавления элементов
    document.getElementById('button_open_form').onclick = function() {
        document.getElementById('modal').style.display = 'flex';
            };

    document.getElementById('button_close_form').onclick = function() {
            document.getElementById('modal').style.display = 'none';
        };


        //Инициализация DataTables
    $(document).ready(function() {
        $('#example').DataTable({
            'bInfo': false, //count of elemetns
            columnDefs: [
                {
                    orderable: false, targets: [3] //отключили сортировку столбца с чекбоксами
                }
            ],
            language: {
                // url: '//cdn.datatables.net/plug-ins/2.2.2/i18n/ru.json'
            }
        }); 
    });

    document.getElementById('selectAll').onclick = function() {
        const checkboxes = document.querySelectorAll('input[name="ids[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
           
        });
        toggleButton();

    };


    $(document).ready(function() {
          

            // Отслеживаем изменения состояния чекбоксов
            $('.cb').change(function() {
                toggleButton(); // Вызываем функцию для проверки состояния
            });

            // Инициализируем состояние кнопки при загрузке страницы
            toggleButton();
        });

    //функция проверки чекбокса
    function toggleButton() {
            // Проверяем, есть ли хотя бы один выбранный чекбокс
            if ($('.cb:checked').length > 0) {
                document.getElementById('button_delete').disabled = false; // Активируем кнопку
            } else {
                document.getElementById('button_delete').disabled = true; // Деактивируем кнопку
                }
            }

    //Кнопка для просмотра пароля
    document.getElementById('cb_pass').onclick = function() {
        if (this.checked) {
            document.getElementById('password').type = 'text';
        } else {
            document.getElementById('password').type = 'password';
        }
    };


    //проверка валидации формы добавления нового элемента
    document.getElementById('form_add_element').addEventListener('submit', function(event){
        const form = document.getElementById('form_add_element');
        const ip_address_value= document.getElementById('address').value;
        
        const ip_patterns = ['255.255.255.255', '0.0.0.0'];
        const is_not_valid_ip = ip_patterns.includes(ip_address_value);

        if(is_not_valid_ip){
            event.preventDefault();
            alert("IP-адрес введен неверно");
        }

    });

//     document.getElementById('button_add_element').onclick = function() {

//         const form = document.getElementById('form_add_element');
//         const ip_address_input = document.getElementById('address').value;
        
//         patterns = {"255.255.255.255", "0.0.0.0"};
//         const is_valid = patterns.array.forEach(element => {
//             if(element == ip_address_input){
//                 return false;
//             }
//         });

//         if(!is_valid){
//             even
//         }
        
// }



</script>

</body>
</html>