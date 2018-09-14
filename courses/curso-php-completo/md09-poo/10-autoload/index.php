<?php 

    // function __autoload($nomeClasse){

    //     var_dump($nomeClasse);
    //     require_once("$nomeClasse.php");

    // }    

    function incluirClasses($nomeClasse){
        if(file_exists("$nomeClasse.php") === true){
            require_once("$nomeClasse.php");   
        }
    }

    spl_autoload_register("incluirClasses");
    spl_autoload_register(function($nomeClasse){
        if(file_exists("Abstracts" . DIRECTORY_SEPARATOR . $nomeClasse . ".php")){
            require_once("Abstracts" . DIRECTORY_SEPARATOR . $nomeClasse . ".php");
        }
    });

    $carro = new DelRey();

    $carro->acelerar(30);

?>