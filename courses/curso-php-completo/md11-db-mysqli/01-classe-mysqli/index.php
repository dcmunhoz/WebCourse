<?php


$conn = new mysqli("localhost", "root", "", "dbphp7");

if($conn->connect_error){
    echo "Error: " . $conn->connect_error;
}

// --- Inserir no banco

// $login = "user";
// $pass  = "123456";

// $stmt = $conn->prepare("INSERT INTO tb_usuarios(deslogin, dessenha) VALUES(?, ?);");

// $stmt->bind_param("ss", $login, $pass);

// $stmt->execute();

// $login = "root";
// $pass = ")(*&";

// $stmt->execute();

// 

$result = $conn->query("SELECT * FROM tb_usuarios");

$data = array();

while($row = $result->fetch_assoc()){
    array_push($data, $row);
}

echo json_encode($data);

?>