<?php  
    $qualSuaIdade   = 10;

    $idadeCrianca   = 12;
    $maiorIdade     = 18;
    $melhorIdade    = 65;

    if($qualSuaIdade < $idadeCrianca){

        print("Criança");
        
    }else if($qualSuaIdade < $maiorIdade){

        print("Adolecente");

    }else if($qualSuaIdade < $melhorIdade){
        print("Adulto");
    }else{
        print("Idoso");
    }

    echo "<br>";
    echo "<br>";

    // Ternario
    echo ($qualSuaIdade < $maiorIdade) ? "Menor de Idade" : "Maior de Idade";

?>