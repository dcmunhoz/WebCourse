<?php
    // Verificar se a sessão esta iniciada
    session_start();
    if(!isset($_SESSION['usuario'])){
        header('Location: ../index.php?error=1');
    }

    $id_usuario = $_SESSION['id'];

    // Referenciar o banco de dados e instanciar seu objeto
    require_once('dao/db.php');
    $myObj = new dataBase();
    $myCon = $myObj->conectaDB();

    $query = "SELECT count(*) as qtde_tweets FROM tweets WHERE idusuario = $id_usuario";
    $resultado_query = mysqli_query($myCon, $query);
    if($resultado_query){
        $dados_query = mysqli_fetch_array($resultado_query);
        echo $dados_query['qtde_tweets'];
    }else{
        echo 'Erro ao fazer consulta no banco';
    }

?>