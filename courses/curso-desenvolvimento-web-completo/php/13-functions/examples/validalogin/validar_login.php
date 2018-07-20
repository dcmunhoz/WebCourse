<?php
  require_once("lib/func_valida_login.php");

  $login_usuario = $_POST['user'];
  $senha_usuario = $_POST['pwd'];

  $validado = validaLogin($login_usuario, $senha_usuario);

  if ( $validado == true ){
    echo 'Acesso Liberado';
  }else{
    echo 'Acesso Negado';
  }

?>
