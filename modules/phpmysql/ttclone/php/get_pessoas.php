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
    $query = " SELECT u.id_usuario as id_usuario_p, u.usuario, u.email, us.id_usuario_seguidor, us.id_usuario as id_usuario_f FROM usuarios u";
    $query.= " LEFT JOIN usuario_seguidores us";
    $query.= " ON us.id_usuario = $id_pessoa AND u.id_usuario = us.seguindo_id_usuario";
    $query.= " WHERE u.usuario like '%$usuario%' and u.id_usuario <> $id_pessoa;";

    // Execução da query atribuida a uma variavel para verificação
    $resultado_query = mysqli_query($myCon, $query);
    if($resultado_query){ // Executou a query com sucesso
        
        while($dados_usuarios = mysqli_fetch_array($resultado_query)){
            

            $esta_seguindo_usuario_sn = isset($dados_usuarios['id_usuario_seguidor']) && !empty($dados_usuarios['id_usuario_seguidor']) ? 'S' : 'N';

            $btn_display_seguir         = 'block';
            $btn_display_deixar_seguir  = 'block';

            if($esta_seguindo_usuario_sn == 'N'){
                $btn_display_deixar_seguir = 'none';
                $btn_display_seguir         = 'block';
            }else{
                $btn_display_deixar_seguir  = 'block';
                $btn_display_seguir = 'none';
            }

            echo '<div class="user-search block" >'.
                     '<div class="user-header">'.
                         '<span class="user-name">@'.$dados_usuarios['usuario'].'</span>'.
                         '<span class="user-email">'.$dados_usuarios['email'].'</span>'.
                     '</div>'.
                     '<p class="follow">'.
                        '<button type="button" id="btn_seguir_'.$dados_usuarios['id_usuario_p'].'" style="display:'.$btn_display_seguir.';" class="follow-button btn  btnFollow btn-success" data-id_usuario="'.$dados_usuarios['id_usuario_p'].'">'.
                            '<i class="fas fa-plus"></i>'.
                        '</button>'.
                        '<button type="button" id="btn_deixar_seguir_'.$dados_usuarios['id_usuario_p'].'" style="display:'.$btn_display_deixar_seguir.';" class="follow-button btn  btnUnfollow btn-danger" data-id_usuario="'.$dados_usuarios['id_usuario_p'].'">'.
                            '<i class="fas fa-minus"></i>'.
                        '</button>'.
                    '</p>'.
                 '</div>';
        }

    }else{  // Houve algum erro ao tentar fazer a execução
        echo 'Erro ao tentar fazer a conexão com o banco de dados';
    }




?>