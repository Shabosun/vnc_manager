<?php
    include 'config.php';


    $sql = "SELECT * FROM configs;";
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
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
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
        a {
            
            text-decoration: none;
        }        
    </style>
</head>
<body>
<nav class="navbar navbar-expand bg-body-tertiary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="../assets/images/logo_monitor_icon.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
      VNC Manager
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="/protected/admin.php">Admin</a>
        </li>
      </ul>
      </div>
    </div>
</nav>
<div class="container mt-5">
    <form method="post" action="">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <th>Дата добавления</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td onclick="open_form_show_details(<?php echo $row['id']?>)"><?php echo $row['id']; ?></td>
                            <td onclick="open_form_show_details(<?php echo $row['id']?>)"><?php echo $row['name']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><a href="<?php echo $row['link']?>" target="_blank">Открыть</a></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Нет данных</td>
                    </tr>
                <?php endif; ?>
        </tbody>
    </table>
   </form> 
</div>

<div class="modal" id="modal">
    <div class="modal-content">
    <form id="form_add_element" action="../update.php" method="POST">
        <svg  id='button_close_form' xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
        </svg>
        <div class="form-group">
                <input type="hidden" class="form-control" name="id" id="id">
            </div>
        <div class="form-group">
                <label for="name">Название</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Введите название" disabled required>
            </div>
            <div class="form-group">
                <label for="comment">Комментарий</label>
                <textarea class="form-control" name="comment" id="comment" rows="3"  placeholder="Введите комментарий" disabled ></textarea>
            </div>
            <div class="form-group">
                <label for="address">IP-адрес</label>
                <input type="text" class="form-control" name="address"id="address" placeholder="Введите IP-адрес" pattern="^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$" disabled required>
            </div>
            <div class="form-group">
                <label for="port">Порт</label>
                <input type="text" class="form-control" name="port" id="port" placeholder="Введите порт" pattern= "^\d{1,5}$" disabled required>
            </div>
            </div>
        </form>
    </div>
</div>
   




<script>

    //открытые формы для редактирования
    function open_form_show_details(el_id){
        $.get('../get_data.php', {id : el_id}, function(data){
            
            
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#comment').val(data.name);
            $('#address').val(data.address);
            $('#port').val(data.port);
            $('#login').val(data.login);
            $('#password').val(data.password);


            document.getElementById('modal').style.display = 'flex';
        }, 'json')

    }

    document.getElementById('button_close_form').onclick = function() {
            document.getElementById('modal').style.display = 'none';


            $('#id').val();
            $('#name').val('');
            $('#comment').val('');
            $('#address').val('');
            $('#port').val('');
            $('#login').val('');
            $('#password').val('');
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

</script>

</body>
</html>