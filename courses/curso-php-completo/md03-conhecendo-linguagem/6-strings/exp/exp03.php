<?php 

    $nome = "D@n13l";
    echo $nome;
    echo '<br>';

    $nome = str_replace("@", "a", $nome);
    $nome = str_replace("1", "i", $nome);
    $nome = str_replace("3", "e", $nome);

    echo $nome;
    echo '<br>';

?>