<?php

    $data = array(
        "empresa"=>"Treinamentos"
    );
    setcookie("NOME_DO_COOKIE", json_encode($data), time() + 3600);

    echo "Cookie Criado";

?>