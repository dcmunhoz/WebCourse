<?php 
    session_start();
    
    if(isset($_SESSION['usuario'])){
        header('Location: home.php');
    }

?>


<!doctype html>
<html>
	<head>
		<!--  Meta Tags Importantes -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/media.css">

    <!-- Scripts -->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>


    <!-- Titulo -->
    <title>Twitter Clone - Inscreva-se</title>

		<!-- Fav Icon -->
		<link rel="icon" href="imgs/icone_twitter.png">

	</head>

	<body>

    <!-- Nav Bar -->
		<nav>
			<div class="container">
				<!-- Icone TT -->
				<a href="index.php" id="icon"></a>

				<!-- Menu -->
				<!-- Menu normal -->
				<div class="menu">
					<ul>

						<li> <a href="index.php">Voltar para Home</a> </li>
					</ul>
				</div> <!-- / Menu -->

				<!-- Menu Reponsivo -->
			</div>

		</nav> <!-- / Nav Bar -->

		<!-- Corpo da pagina -->
		<div class="content-body container">

			<!-- Painel Inscreva-se -->
			<div class="inscrevase">
        <div class="singup-header">
          <h3>Inscreva-se já.</h3>
        </div>
        <!-- Formulário inscrição -->
        <form class="form-singup" action="php/registra_usuario.php" method="post">

          <div class="form-group">
            <input type="text" name="user" id="user" placeholder="Usuário">
          </div>

          <div class="form-group">
            <input type="email" name="email" id="email" placeholder="E-mail">
          </div>

          <div class="form-group">
            <input type="password" name="pwd" id="pwd" placeholder="Senha">
          </div>

          <div class="form-button">
            <button type="submit" class="btn btn-full btn-primary" name="btn-Inscreverse" id="btn-Inscreverse">Inscrever-se</button>
          </div>

        </form>
			</div> <!-- / Painel -->

		</div>

    <!-- Scripts -->
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
	</body>
</html>
