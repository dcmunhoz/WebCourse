<?php

    $pessoa = array();

    array_push($pessoa, array(
        'nome'=>'Daniel',
        'idade'=>21
    ),array(
        'nome'=>'Teste',
        'idade'=>20
    ));

    echo json_encode($pessoa);
    echo "<br>";

    $json = '[{"nome":"Daniel","idade":21},{"nome":"Teste","idade":20}]';

    $data = json_decode($json, true);

    var_dump($data);

?>