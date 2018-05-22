<?php 
    
    require_once("dao/db.php");

    $userLogin = $_POST["user-login"];
    $pwdLogin  = $_POST["pwd-login"];
    $objDB     = new dataBase();
    $link      = $objDB->conectaDB();

    
    $query = "select * from usuarios where usuario = '$userLogin' and senha = '$pwdLogin'; ";
    $query2 = "select * from usuarios; ";
    
    $resultado = mysqli_query($link, $query2);
    
    if($resultado){
        $dados_usuario = mysqli_fetch_array($resultado);
        var_dump($dados_usuario);
    }else{
        echo "Erro na execução da consulta, favor contatar o administrador do Site";
    }
    
    
    
    
    
    
    
  

?>