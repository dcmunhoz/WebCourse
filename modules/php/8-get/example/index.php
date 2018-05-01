<!DOCTYPE html>
<html lang="pt" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>GET</title>
  </head>
  <body>
    <main class="container">
      <header>
        <h1>Exemplo Formulário</h1>
      </header>

      <section class="selecao">
        <form class="form" action="index.php" method="get">
          <label for="id_nome">Nome:</label>
          <input class="form-control" type="text" name="id_nome" id="id_nome" placeholder="Digite Seu nome">
          <select class="form-control" name="id_produto" id="id_produto">
            <option value="1">Cadeiras</option>
            <option value="2">Fogão</option>
            <option value="3">Roteador Wi-Fi</option>
            <option value="4">TV 29"</option>
          </select>
          <button type="submit" name="button">Enviar</button>
        </form>
      </section>

      <header>
        <h1>Detalhes produto</h1>
      </header>

      <section class="resposta">
        <?php

          $id_produto = $_GET['id_produto'];
          $nome = $_GET['id_nome'];

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
    </main>
  </body>
</html>
