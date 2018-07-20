<?php 
    
    session_start();
    
    if(!isset($_SESSION['usuario'])){
        header('Location: index.php?error=1');
    }
    
    require_once('dao/db.php');
    
    $id_usuario = $_SESSION['id'];
    
    $myObj = new dataBase();
    $myCon = $myObj->conectaDB();
    
    $query = "SELECT u.usuario, t.tweet, t.data_inclusao FROM tweets t JOIN usuarios u ON t.idusuario = u.id_usuario WHERE id_usuario = $id_usuario OR id_usuario IN (select seguindo_id_usuario from usuario_seguidores us where us.id_usuario = $id_usuario) ORDER BY data_inclusao DESC;";

    $resultado_id = mysqli_query($myCon, $query);

    if($resultado_id){
        
        $tweets = array();
        
        while($row = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
            $tweets[] = $row;
        }
        
        foreach($tweets as $twts){
        echo '<a class="tweet block" href="#">'.
                '<div class="tweet-header">'.
                   '<span class="tweet-title">@'.$twts['usuario'].' - <small>'.$twts['data_inclusao'].' </small></span>'.
               '</div>'.
               '<div class="tweet-body">'.
                   '<span class="tweet-content">'.$twts['tweet'].'</span>'.
               '</div>'.
             '</a>';
        }
        
    }else{
        echo 'Erro na consulta de tweets no banco de dados !';
    }
?>