<?php
    include 'config.php';

    if (isset($_POST["name"]) && isset($_POST["login"]) && isset($_POST["password"]) && isset($_POST["address"]) && isset($_POST["port"])) {
      
       
        $name = $conn->real_escape_string($_POST["name"]);
        $login= $conn->real_escape_string($_POST["login"]);
        $password = $conn->real_escape_string($_POST["password"]);
        $address = $conn->real_escape_string($_POST["address"]);
        $port = $conn->real_escape_string($_POST["port"]);
        $token_id = (str_replace('.', '',$address)); //для token.list файла
        $link = "http://localhost:6080/vnc.html?path=?token=" . $token_id; 

        $sql = "INSERT INTO configs (name, date, link, login, password, address, port) VALUES
          ('$name', NOW(), '$link', '$login', '$password', '$address', '$port')";

        if($conn->query($sql)){

            $fd = fopen('token.list', 'w') or die("Unable to open file!");
            $token_element = $token_id . ": " . $address . ":" . $port;
            
            fwrite($fd,$token_element);

            fclose( $fd );
        } else{
            echo "Ошибка: " . $conn->error;
        }
        $conn->close();
    }
///сделать комментарй
?>