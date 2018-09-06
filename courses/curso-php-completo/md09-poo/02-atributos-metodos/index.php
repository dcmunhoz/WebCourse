<?php

class Carro{

    // Atributos
    private $modelo;
    private $motor;
    private $ano;

    // Métodos
    public function getModelo():string {
        return $this->modelo;
    }

    public function setModelo(string $value){
        $this->modelo = $value;
    }

    public function getMotor():float {
        return $this->motor;
    }

    public function setMotor(string $value){
        $this->motor = $value;
    }

    public function getAno():int {
        return $this->ano;
    }

    public function setAno(string $value){
        $this->ano = $value;
    }

    public function exibir():array{
        return array(
            "modelo"=>$this->getModelo(),
            "motor"=>$this->getMotor(),
            "ano"=>$this->getAno()
        );
    }

}

# ---------------------------------------------------

$gol = new Carro();

$gol->setModelo("Gol GT");
$gol->setMotor("1.6");
$gol->setAno("2017");

print_r($gol->exibir());

?>