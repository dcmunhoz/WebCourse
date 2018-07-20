<?php

  require_once("classes.php");

  $pessoa = new Pessoa();

  $pessoa->setNome("Daniel");

  echo $pessoa->getNome();

?>
