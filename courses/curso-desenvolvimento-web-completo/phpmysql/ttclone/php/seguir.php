<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header('Location: ../index.php?error=1');
    }
    
    require_once('dao/db.php');

    $myObj = new dataBase();
    $myCon = $myObj->conectaDB();

    $id_usuario = $_SESSION['id'];
    $id_seguir  = $_POST['seguir_id_usuario'];

    $query = "INSERT INTO usuario_seguidores(id_usuario, seguindo_id_usuario) VALUES($id_usuario, $id_seguir);";

    mysqli_query($myCon, $query);




?>