<?php

    class Endereco{

        // Atributos
        private $logradouro;
        private $numero;
        private $cidade;

        // Construtor
        public function __construct($a, $b, $c){

            $this->logradouro = $a;
            $this->numero     = $b;
            $this->cidade     = $c;  

        }

        // Destrutor
        public function __destruct(){

            var_dump("DESTRUIR");

        }

        public function __toString(){
            return $this->logradouro. ', ' . $this->numero . ' - ' . $this->cidade;
        }



        // Metodos
    }

    # -------------------------------------------------

    $endereco = new Endereco('Avenida 10', '682', 'Orlândia');
    var_dump($endereco);
    echo "<br>";
    echo "<br>";
    echo $endereco;
    echo "<br>";
    echo "<br>";
    unset($endereco);
?>