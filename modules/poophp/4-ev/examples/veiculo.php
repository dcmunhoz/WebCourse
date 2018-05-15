<?php

  class Veiculo{
    // Modificadores

    /*
      public    = Modificador padrão na criação.
      private   = Somente a classe pode ver
      protected =
    */

    private $placa;
    private $cor;
    protected $tipo;


    public function setPlaca($placa){
      $this->placa = $placa;
    }

    public function getPlaca(){
      return $this->placa;
    }

    public function setCor($cor){
      $this->cor = $cor;
    }

    public function getCor(){
      return $this->cor;
    }





  }




?>
