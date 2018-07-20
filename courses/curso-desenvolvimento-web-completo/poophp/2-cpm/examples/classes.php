<?php

  //Para criarmos uma classe, basta utilizarmos
  //a palavra reservada CLASS.

  class Pessoa{
    // Atributos
    var $nome;


    // Metodos
    function setNome( $nome_definido){
      $this->nome = $nome_definido;
    }

    function getNome(){
      return $this->nome;
    }


  }
?>
