<?php 

    $frase = "A repetição é mãe da retenção.";

    $q = strpos($frase, "mãe");

    $texto = substr($frase, 0, $q);
    var_dump($texto);

    $text2 = substr($frase, $q);
    echo '<br>';

    var_dump($text2);

?>