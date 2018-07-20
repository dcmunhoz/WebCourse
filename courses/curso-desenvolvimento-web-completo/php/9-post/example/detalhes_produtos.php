<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Detalhes</title>
  </head>
  <body>

          <header>
            <h1>Detalhes produto</h1>
          </header>

          <section class="resposta">
            <?php

              $id_produto = $_POST['id_produto'];
              $nome = $_POST['id_nome'];

              $detalhes[1] = "Detalhe das cadeiras";
              $detalhes[2] = "Detalhes do fogão";
              $detalhes[3] = "Detalhes Roteador";
              $detalhes[4] = "Detalhes TV";

              echo '
                <span class="">Olá '.$nome.'</span>
                <br>
                <br>
                <span class="">'.$detalhes[$id_produto].'</span>
              ';


             ?>
          </section>
  </body>
</html>
