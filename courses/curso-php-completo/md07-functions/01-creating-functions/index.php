<?php

    function ola(){

        return "Olá, Mundo! <br>";

    }


    $frase = ola();

    $tam = strlen($frase);

    for($i = 0; $i < $tam; $i++){
        echo substr($frase, $i, 1) . "<br/>";
    }

?>