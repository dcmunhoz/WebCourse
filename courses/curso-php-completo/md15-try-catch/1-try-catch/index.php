<?php

    // Exemplo 1
    // try{

    //     throw new Exception("Houve um erro.", 400);

    // }catch(Exception $e){

    //     echo json_encode(array(
    //         "messase"=>$e->getMessage(),
    //         "line"=>$e->getLine(),
    //         "file"=>$e->getFile(),
    //         "code"=>$e->getCode()

    //     ));

    // }


    //Exemplo 2
    function trataNome($nome){

        if(!$nome){

            throw new Exception("Nenhum nome foi informado");

        }

        echo ucfirst($nome) . "<br>";

    }

    try{

        trataNome("daniel");
        trataNome("");

    }catch(Exception $e){

        echo "Error: " . $e->getMessage() . "; Line: " . $e->getLine(); 
        echo "<br>";    
    }finally{
        Echo "Fim do bloco !";
    }

?>