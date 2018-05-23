<?php 

    session_start();
    
    require_once("dao/db.php");

    $userLogin = $_POST["user-login"];
    $pwdLogin  = md5($_POST["pwd-login"]);
    $objDB     = new dataBase();
    $link      = $objDB->conectaDB();

    
    $query = "select * from usuarios where usuario = '$userLogin' and senha = '$pwdLogin'; ";

    
    $resultado = mysqli_query($link, $query);
    
    if($resultado){
        $dados_usuario = mysqli_fetch_array($resultado);
        
        if(isset($dados_usuario['usuario'])){
            
            $_SESSION['usuario'] = $dados_usuario['usuario'];
            $_SESSION['email']   = $dados_usuario['email'];
            $_SESSION['id']      = $dados_usuario['id_usuario'];
            
            header('Location: ../home.php');
        }else{
            header('Location: ../index.php?login_error=1');
        }
         
    }else{
        echo "Erro na execução da consulta, favor contatar o administrador do Site";
    }

?>