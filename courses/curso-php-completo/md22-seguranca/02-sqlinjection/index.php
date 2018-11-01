<?php

    $id = (isset($_GET["id"])) ? $_GET["id"] : 5;

    if(!is_numeric($id)){
        exit("pegamos você");
    }

    if(!$conn = mysqli_connect("127.0.0.1", 'root', '', 'dbphp7')){
        echo mysqli_connect_error();
    }

    $query = "SELECT * FROM tb_usuarios WHERE idusuario = $id;";

    $data = mysqli_query($conn, $query);

    while($resultado = mysqli_fetch_object($data)){

        var_dump($resultado);
    }
    
?>