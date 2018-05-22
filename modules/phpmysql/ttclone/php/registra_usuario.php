<?php

  require_once("dao/db.php");

  $usuario  = $_POST["user"];
  $email    = $_POST["email"];
  $senha    = $_POST["pwd"];

  $obj_db = new dataBase();
  $link = $obj_db->conectaDB();

  $sql_insert_usuario = "insert into usuarios(usuario, email, senha) values('$usuario', '$email', '$senha')";

  //Executar Query
  if(mysqli_query($link, $sql_insert_usuario)){
    echo 'Usuario Registrado com Sucesso';
  }else{
    echo 'Erro ao registrar o usuário';
  }
?>
