<?php

    // Verificar se a sessão foi iniciada
    session_start();
    if(!isset($_SESSION['usuario'])){
        header('Location: ../index.php?error=1');
    }

    // Relacionar arquivo do banco de dados
    require_once('dao/db.php');
    
    // Iniciar o objeto de conexão com o banco e recuperar o link da conexão
    $myObj = new dataBase();
    $myCon = $myObj->conectaDB();

    // Variaveis
    $id_pessoa = $_SESSION['id'];
    $usuario   = $_POST['nomePessoa'];


    // Query
    $query = "SELECT * FROM usuarios WHERE usuario like '%$usuario%' and id_usuario <> $id_pessoa;";

    // Execução da query atribuida a uma variavel para verificação
    $resultado_query = mysqli_query($myCon, $query);
    if($resultado_query){ // Executou a query com sucesso
        
        while($dados_usuarios = mysqli_fetch_array($resultado_query)){
            echo '<div class="user-search block" >'.
                     '<div class="user-header">'.
                         '<span class="user-name">@'.$dados_usuarios['usuario'].'</span>'.
                         '<span class="user-email">'.$dados_usuarios['email'].'</span>'.
                     '</div>'.
                     '<p class="follow">'.
                        '<div class="follow-button btn  btnFollow btn-success" data-id="'.$dados_usuarios['id_usuario'].'">'.
                            '<i class="fas fa-plus"></i>'.
                        '</div>'.
                    '</p>'.
                 '</div>';
        }

    }else{  // Houve algum erro ao tentar fazer a execução
        echo 'Erro ao tentar fazer a conexão com o banco de dados';
    }




?>