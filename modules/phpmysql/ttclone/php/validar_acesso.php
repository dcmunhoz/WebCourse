<?php 
    
    require_once("dao/db.php");

    $userLogin = $_POST["user-login"];
    $pwdLogin  = $_POST["pwd-login"];
    $objDB     = new dataBase();
    $link      = $objDB->conectaDB();

    
    $query = "select * from usuarios where usuario = '$userLogin' and senha = '$pwdLogin'; ";

    
    $resultado = mysqli_query($link, $query);
    
    if($resultado){
        $dados_usuario = mysqli_fetch_array($resultado);
        
        if(isset($dados_usuario['usuario'])){
            echo 'Usuário existe';
        }else{
            header('Location: ../index.html?login_error=1');
        }
         
    }else{
        echo "Erro na execução da consulta, favor contatar o administrador do Site";
    }
    
    
    
    
    
    
    
  

?>