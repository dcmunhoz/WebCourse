<?php

    // $file = fopen('teste.txt', 'w+');
    // echo "Arquivo Criado <br>";
    // fclose($file);

    // unlink("teste.txt");
    // echo "Arquivo removido <br>";

    $dir = "images";

    if(!is_dir($dir)){
        mkdir($dir);
        echo "Diretorio criado <br>";
    }else{
        echo "Diretorio já existe <br>";
    }

    $filePath = $dir . DIRECTORY_SEPARATOR . "log.txt";

    if(!file_exists($filePath)){
        $file = fopen($filePath, "a+");
        fwrite($file, date('d-m-Y H:i:s') . "\r\n");
        echo "Arquivo de log criado.";
    }else{
        $file = fopen($filePath, "a");
        fwrite($file, date('d-m-Y H:i:s') . "\r\n");
        echo "Log alterado.";
    }    

    echo "<br>";



?>