<?php

    abstract class Animal{

        public function falar(){

            return "Som";

        }

        public function mover(){
            return "Anda";
        }


    }

    class Cachorro extends Animal{

        public function falar(){

            return "Late";

        }

    }

    class Gato extends Animal{

        public function falar(){
           return "Miar";
        }

    }

    class Passaro extends Animal{
        public function falar(){
            return "Canta";
        }

        public function mover(){
            return "Voa e ". parent::mover();
        }
    }

    $pluto    = new Cachorro();
    $garfield = new Gato();
    $picaPau  = new Passaro();

    echo $pluto->falar() . "<br/>";
    echo $pluto->mover() . "<br/>";

    echo "<br/>";
    echo "<br/>";

    echo $garfield->falar() . "<br/>";
    echo $garfield->mover() . "<br/>";

    echo "<br/>";
    echo "<br/>";

    echo $picaPau->falar() . "<br/>";
    echo $picaPau->mover() . "<br/>";

?>