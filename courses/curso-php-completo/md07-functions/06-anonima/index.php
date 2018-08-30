<?php

    function teste($callback){
        // Processo Lento

        $callback();

    }

    teste(function(){
        echo "Erro";
    });

    echo "<br>";
    echo "<br>";
    echo "<br>";

    $fn = function($a){

        var_dump($a);

    };


    $fn("Olá, Mundo!");

?>