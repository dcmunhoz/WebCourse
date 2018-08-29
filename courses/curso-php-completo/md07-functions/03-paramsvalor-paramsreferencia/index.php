<?php

    $a = 10;

    function trocaValor(&$a){

        $a += 50;

        return $a;

    }

    echo trocaValor($a);
    echo "<br>";
    echo $a;
    echo "<br>";
    echo "<br>";
    echo "<br>";

    $pessoa = array(
        'nome'=>'joão',
        'idade'=>20
    );

    foreach($pessoa as &$val){

        if(gettype($val) == 'integer') $val += 10;

        echo $val."<br/>";

    }

    var_dump($pessoa);

?>