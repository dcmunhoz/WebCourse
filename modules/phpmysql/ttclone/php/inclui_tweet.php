<?php 

    if(!isset($_SESSION['usuario'])){
        header('Location: ../index.php?error=1');
    }
    
    require_once("dao/db.php");
    session_start();
    
    
    $textoTweet     = $_POST['textoTweet'];
    $idUsuarioTweet = $_SESSION['id'];
    
    
    if($textoTweet == '' || $idUsuarioTweet == ''){
        die();
    }
    
    $myObj = new dataBase();
    $myCon = $myObj->conectaDB();
    $query = "INSERT INTO tweets(idusuario, tweet) VALUES($idUsuarioTweet,'$textoTweet')";

    mysqli_query($myCon, $query);
    
    
    
    
?>