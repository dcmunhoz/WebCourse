<?php

  if ( isset($_POST['nome']) && empty($_POST['nome']) ){
    echo 'Preencha o nome <br>';
  }

  if ( isset($_POST['cpf']) && empty($_POST['cpf']) ){
    echo 'Preencha o cpf <br>';
  }

  if ( isset($_POST['cpf']) && !is_numeric($_POST['cpf']) ){
    echo 'CPF deve conter somente numeros <br>';
  }

?>

<form action="" method="post">
  <label for="nome">Nome completo*:</label>
  <br>
  <input type="text" name="nome" id="nome">
  <br>
  <label for="cpf">CPF*:</label>
  <br>
  <input type="text" name="cpf" id="cpf">
  <br>
  <br>
  <button type="submit" name="button">Enviar</button>
</form>
