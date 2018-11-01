<?php

    $pasta = "Teste";
    $perm = 0775;

    if (!is_dir($pasta)) mkdir($pasta, $perm);

    echo "Pasta Criada";

?>