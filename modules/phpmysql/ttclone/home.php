<?php 
    
    session_start();
    
    if(!isset($_SESSION['usuario'])){
        header('Location: index.html?error=1');
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
                <title>Twitter Clone - Home</title>

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

						<li> <a href="php/sair.php">Sair</a> </li>
					</ul>
				</div> <!-- / Menu -->

				<!-- Menu Reponsivo -->
			</div>

		</nav> <!-- / Nav Bar -->

		<!-- Corpo da pagina -->
		<div class="content-body container">
                    Bem Vindo a Home
                    <br>
                    <?php echo $_SESSION['usuario']; ?>
                    <br>
                    <?php echo $_SESSION['email']; ?>
                </div>

            <!-- Scripts -->
            <script type="text/javascript" src="js/script.js"></script>
            <script type="text/javascript" src="js/jquery.js"></script>
	</body>
</html>
