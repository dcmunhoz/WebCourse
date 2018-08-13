<?php

    $condicao = true;

    while($condicao){

        $num = rand(1, 10);

        if($num === 3){
            echo "TRES </br>";
            $condicao = false;
        }else{
            echo "$num <br>";
        }


    }


?>