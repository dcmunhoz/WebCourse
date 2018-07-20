<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <title>Inserindo bloco PHP</title>
  </head>
  <body>
    <!-- Bloco padrão -->
    <?php
      echo 'Teste tag padrão';
    ?>

    <!-- Bloco impressão -->
    <?=
      'Teste impressão'
    ?>

    <!-- Bloco curto -->
    <?
      echo 'Teste tag Curta';
    ?>

    <!-- Bloco ASP *** Deixou de funcionar apos a versão do PHP5 -->
    <%
      echo 'Teste bloco ASP';
    %>

  </body>
</html>
