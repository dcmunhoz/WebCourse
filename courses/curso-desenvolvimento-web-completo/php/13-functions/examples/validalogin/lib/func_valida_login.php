<?php

  function validaLogin($login, $senha){

    // Validar direto em um DB.
    $login_db = 'daniel';
    $senha_db = '1234';

    if($login == $login_db && $senha == $senha_db){
      return true;
    }

    return false;
  }

?>
