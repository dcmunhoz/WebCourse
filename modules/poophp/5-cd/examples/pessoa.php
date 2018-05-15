<?php

Class Pessoa{

  private $nome;

  function __construct($nome){
    $this->nome = $nome;
    echo "Olá " . $this->nome . "<br>";

  }

  function __destruct(){
    echo 'Objeto Destruido';
  }

  function Correr(){
    echo "CORRENDOOOOOOOO.....";
  }


}


?>
