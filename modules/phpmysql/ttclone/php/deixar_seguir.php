<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header('Location: ../index.php?error=1');
    }

    require_once('dao/db.php');

    $myObj = new dataBase();
    $myCon = $myObj->conectaDB();

    $id_usuario         = $_SESSION['id'];
    $id_deixar_seguir   = $_POST['seguir_id_usuario'];

    $query = "DELETE FROM usuario_seguidores WHERE id_usuario = $id_usuario and seguindo_id_usuario = $id_deixar_seguir;";

    mysqli_query($myCon, $query);

?>