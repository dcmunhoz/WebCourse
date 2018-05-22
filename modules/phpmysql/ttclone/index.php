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

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/media.css">

    <!-- Scripts -->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>


    <!-- Titulo -->
    <title>Twitter Clone</title>

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

						<li> <a href="inscrevase.php">Inscreva-se</a> </li>

						<li>
							 <a href="#" id="menuBtnEntrar">Entrar</a>

							 <!-- Formulário Login -->
							 <div class="login" id="login-box">
                                                                 <span class="login-title">Já possui uma conta?</span>
								 <form class="form-login" action="php/validar_acesso.php" method="post">
									 <div class="form-group">
										 <input type="text" name="user-login" id="user-login" placeholder="Usuário">
									 </div>
									 <div class="form-group">
										 <input type="password" name="pwd-login" id="pwd-login" placeholder="Senha">
									 </div>
                                                                     
									 <div class="form-button">
										 <button type="submit" class="btn btn-primary btn-full" name="btnLogin" id="btnLogin">Login</button>
									 </div>
								 </form>
                                                                 <div>
                                                                         <span id="login-error">Usuário e ou Senha invalido(s)</span>
                                                                 </div>
							 </div> <!-- / Formulario Login -->
						</li>
					</ul>
				</div> <!-- / Menu -->

				<!-- Menu Reponsivo -->
			</div>

		</nav> <!-- / Nav Bar -->

		<!-- Corpo da pagina -->
		<div class="content-body container">

			<!-- Painel Boas Vindas -->
			<div class="welcome">

				<div class="title">
					<h1>Bem vindo ao Twitter Clone</h1>
				</div>

				<div class="desc">
					<p>Veja o que está acontecendo agora...</p>
				</div>

			</div> <!-- / Painel -->
		</div>

		<!-- Scripts -->
		<script type="text/javascript" src="js/script.js"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
	</body>
</html>
