<?php

include 'config.php';


$id = $_GET['id'];


    // Проверка наличия элемента
if ($result = $conn->query("SELECT * FROM  configs WHERE id = '$id'")){
    foreach($result as $row){

        $id = $row["id"];
        $comment = $row["comment"];
        $name = $row["name"];
        $link = $row["link"];
        $address = $row["address"];
        $port = $row["port"];
        $login = ["login"];
        $password = ["password"];
        

    }

    echo json_encode(
        array(
            'id' => $id, 
            'name' => $name,
            'comment' => $comment, 
            'link' => $link, 
            'address' => $address,
            'port' => $port,
            'login' => $login,
            'password' => $password));
}






$conn->close();

?>