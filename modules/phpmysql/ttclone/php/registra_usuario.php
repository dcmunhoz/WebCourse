<?php


  require_once("dao/db.php");

  $usuario  = $_POST["user"];
  $email    = $_POST["email"];
  $senha    = md5($_POST["pwd"]);

  $obj_db = new dataBase();
  $link = $obj_db->conectaDB();
  
  $usuario_existe = false;
  $email_existe   = false;
  
  
  // Verificar se o usuario já existe
  $query = " select * from usuarios where usuario = '$usuario';";
  if ($resultado_id = mysqli_query($link, $query)){
      
     $dados_usuario = mysqli_fetch_array($resultado_id);
     
     if(isset($dados_usuario['usuario'])){
        $usuario_existe = true;
     }
  }else{
     echo 'Erro ao tentar localizar o registro de usuario';
  }
  
  // Verifica se o email já existe.
  $query = "select * from usuarios where email = '$email'; ";
  $resultado = mysqli_query($link, $query);
  if($resultado){
      $dados_usuario = mysqli_fetch_array($resultado);
      
      if(isset($dados_usuario['email'])){
        $email_existe = true;
      }
  }else{
      echo 'Erro ao tentar localizar registro.';
  }

  if($usuario_existe || $email_existe){
      $retorno_get = '';
      
      if($usuario_existe){
          $retorno_get .= "erro_usuario=1&";
      }
      
      if($email_existe){
          $retorno_get .= "erro_email=1&";
      }
      
      header("Location: ../inscrevase.php?".$retorno_get);
      die();
  }
  
  
  $sql_insert_usuario = "insert into usuarios(usuario, email, senha) values('$usuario', '$email', '$senha')";

  //Executar Query
  if(mysqli_query($link, $sql_insert_usuario)){
    echo 'Usuario Registrado com Sucesso';
  }else{
    echo 'Erro ao registrar o usuário';
  }
 
?>
