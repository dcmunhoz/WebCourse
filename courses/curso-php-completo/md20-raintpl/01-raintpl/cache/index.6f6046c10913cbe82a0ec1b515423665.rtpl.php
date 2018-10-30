<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>RainTPL</title>

    </head>

    <body>  

        <h1> Criando layout com RainTPL. </h1>
        
        <h3> Teste de template </h3>
        <p>Descrição: <?php echo htmlspecialchars( $name, ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
        <p>Versão PHP: <?php echo htmlspecialchars( $version, ENT_COMPAT, 'UTF-8', FALSE ); ?></p>

    </body>


</html>