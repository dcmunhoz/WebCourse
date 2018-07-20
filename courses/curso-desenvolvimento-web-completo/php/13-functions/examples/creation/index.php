<?php
  // Função sem retorno
  function exibirBoasVindas(){
    echo 'Olá, Mundo !';
  }

  // Função com retorno
  function calcularSoma($a, $b){
    return $a + $b;
  }

  // chamando as funções
  exibirBoasVindas();
  echo '<br>';
  echo '<br>';
  echo calcularSoma(2, 3);

 ?>
