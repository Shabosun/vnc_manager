<?php
    include 'config.php';

    if(isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["comment"]) && isset($_POST["login"]) && isset($_POST["password"]) && isset($_POST["address"]) && isset($_POST["port"])) {
      
        $id = $conn->real_escape_string($_POST["id"]);
        $name = $conn->real_escape_string($_POST["name"]);
        $login= $conn->real_escape_string($_POST["login"]);
        $comment = $conn->real_escape_string($_POST["comment"]);
        $password = $conn->real_escape_string($_POST["password"]);
        $address = $conn->real_escape_string($_POST["address"]);
        $port = $conn->real_escape_string($_POST["port"]);


        $token_id = (str_replace('.', '',$address)) . $port; //для token.list файла
        // $token_id = $id;
        $link = "http://localhost:6080/vnc.html?path=?token=" . $token_id;

        $sql_exists = "SELECT * FROM configs WHERE id = '$id'";
        $result = $conn->query($sql_exists);
        

        if ($result->num_rows > 0) {
            $addresses[] = '';
            while($row = $result->fetch_assoc()){
                $addresses[] = str_replace('.','', $row['address']) . $row['port'];
               
            }



            if (!empty($addresses)) { //если такая запись есть в бд, то удаляем из файла старую запись и записываем новую
                //удаляем это id с адресом из файла

                $fread = fopen('token.list', 'r') or die("Unable to open file!");
                  $lines = [];
                  while (($line = fgets($fread)) !== false){
                    for ($i = 0; $i < count($addresses); $i++){
                        if (strpos($line, $addresses[$i]) === false){
                            $lines[] = $line;
                        }
                    }
                  }
                  fclose( $fread );

                  $fwrite = fopen('token.list', 'w') or die("Unable to open file!");

                  foreach($lines as $line){
                    fwrite($fwrite, $line);
                  }
                  fclose( $fwrite );
            }

            //обновляем запись в бд
            $sql = "UPDATE configs SET name = '$name', comment = '$comment', login = '$login', password = '$password', address = '$address', port = '$port' WHERE id = '$id'";
            

        } else {

            $sql = "INSERT INTO configs (name, date, comment, link, login, password, address, port) VALUES
          ('$name', NOW(), '$comment', '$link', '$login', '$password', '$address', '$port');";
            
        }

        //после того как обновили или добавили запись в бд, записываем изменненный адрес в файл

        if($conn->query($sql)){

            $fd = fopen('token.list', 'a') or die("Unable to open file!");
            
            $token_element = $token_id . ": " . $address . ":" . $port;
        
            fwrite($fd,$token_element . PHP_EOL);

            fclose( $fd );

            header('Location: /protected/admin.php'); // чтобы форма не перенапрявляла, а возвращала обратно в admin.php
            exit();
        } else{
            echo "Ошибка: " . $conn->error;
        }
        

        
        $conn->close();
   }

?>