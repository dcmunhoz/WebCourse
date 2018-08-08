<?php

// Diferença aspas duplas ou simples.

/**
 * 
 * A utilização de aspas duplas é viavel sempre que desejamos ter uma
 * interpolação de variaveis. Ou seja, quando não queremos concatenar uma variavel a uma frase
 * podemos simplesmente utilizar aspas duplas e deixar a variavel dentro das aspas junto com o texto
 * que o mesmo será interpretado pelo PHP.
 * 
 */

$nome1 = "Teste";

$nome2 = "Treinamento";

//var_dump($nome1, $nome2);

echo "ABC $nome1, $nome2";

?>