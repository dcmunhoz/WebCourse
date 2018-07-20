<?php 
    
    session_start();
    
    if(!isset($_SESSION['usuario'])){
        header('Location: index.php?error=1');
    }
    
    require_once('php/dao/db.php');

    $id_usuario = $_SESSION['id'];
    
    // Iniciar o objeto de conexão com o banco e recuperar o link da conexão
    $myObj = new dataBase();
    $myCon = $myObj->conectaDB();

    // === Quantidade de tweets ===
    $query = "SELECT count(*) as qtde_tweets FROM tweets WHERE idusuario = $id_usuario";
    $resultado_id = mysqli_query($myCon, $query);
    $qtde_tweets = 0;
    if($resultado_id){
        $dados_usuario = mysqli_fetch_array($resultado_id);
        $qtde_tweets = $dados_usuario['qtde_tweets'];
    }else{
        echo 'Erro na execução do script';
    }

    // Quantidade de Seguidores
       // === Quantidade de tweets ===
       $query = "select count(*) as qtde_seguidores from usuario_seguidores where seguindo_id_usuario = $id_usuario";
       $resultado_id = mysqli_query($myCon, $query);
       $qtde_seguidores = 0;
       if($resultado_id){
           $dados_usuario = mysqli_fetch_array($resultado_id);
           $qtde_seguidores = $dados_usuario['qtde_seguidores'];
       }else{
           echo 'Erro na execução do script';
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

                <script type="text/javascript">
                    
                    $(document).ready(function(){
                        
                        // Acossiar evento click do botão
                        $("#nomePessoa").keyup(function(){
                            
                            if($("#nomePessoa").val().length > 0){
                                
                                // Função Ajax
                                $.ajax({
                                    url: 'php/get_pessoas.php',
                                    method: 'post',
                                    data: $('#form-procurar-pessoa').serialize(),
                                    success: function(data){
                                        $('#pessoas').html(data);

                                        $('.btnFollow').click(function(){
                                           var id_usuario = $(this).data('id_usuario');

                                           $('#btn_seguir_'+id_usuario).hide();
                                           $('#btn_deixar_seguir_'+id_usuario).show();

                                           console.log(id_usuario);
                                           $.ajax({
                                               url: 'php/seguir.php',
                                               method: 'post',
                                               data: { seguir_id_usuario: id_usuario },
                                               success: function(data){
                                                  
                                               }
                                           });
                                        });

                                        $('.btnUnfollow').click(function(){
                                            var id_usuario = $(this).data('id_usuario');
                                            
                                            $('#btn_seguir_'+id_usuario).show();
                                            $('#btn_deixar_seguir_'+id_usuario).hide();
                                            
                                            $.ajax({
                                                url: 'php/deixar_seguir.php',
                                                method:'post',
                                                data: { seguir_id_usuario: id_usuario },
                                                success: function(data){
                                                    
                                                }
                                            });
                                        });
                                    }
                                });
                            }else{
                                $("#pessoas").html('');
                            }
                        });
                        
                        
                    });
                    
                   

                </script>

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
                        <li> <a href="home.php">Home</a> </li>
						<li> <a href="php/sair.php">Sair</a> </li>
					</ul>
				</div> <!-- / Menu -->

				<!-- Menu Reponsivo -->
			</div>

		</nav> <!-- / Nav Bar -->

		<!-- Corpo da pagina -->
		<div class="content-body container">
                    <!-- Painel Central -->
                    <div class="main-panel">
                        <!-- Coluna Perfil Logado -->
                        <div class="profile block">
                            <!-- Usuario Conectado -->
                            <div>
                                <span id="logged-user"> @<?php echo $_SESSION['usuario']; ?></span> 
                            </div>
                            
                            <!-- Informação Tweets e Seguidores -->
                            <div class="profile-infos">
                                <!-- Quantidade de Tweets -->
                                <div class="tweet-count">
                                    <header>Tweets</header>
                                    <span id="tweet-count-number"><?= $qtde_tweets; ?></span>
                                </div>
                                
                                <!-- Quantidade Seguidores -->
                                <div class="followers-count">
                                    <header>Seguidores</header>
                                    <span id="followers-count-number"><?= $qtde_seguidores; ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Coluna centrar : Time line e fazer Tweet -->
                        <div class="middle">
                            <!-- Coluna Fazer Tweet -->
                            <div class="tweetar block">
                                <div class="tweet-group">
                                    <form id="form-procurar-pessoa" class="tweet-form">
                                        <input  class="tweet-item tweet-field"  id="nomePessoa" name="nomePessoa" type="text" placeholder="Quem você esta procurando?">
                                        <button class="tweet-item tweet-button" id="btnProcurarPessoa"   name="btnProcurarPessoa"   type="button" ><i class="fas fa-search"></i></button>


                                    </form>
                                </div>
                            </div>
                            
                            <!-- Coluna Time Line -->
                            <div class="time-line" id="pessoas">
                                
                                <!-- <div class="user-search block" >
                                    <div class="user-header">
                                        <span class="user-name">@[NOME]</span>
                                        <span class="user-email">usuario@usuario.com</span>
                                    </div>
                                    <p class="follow">
                                        <div class="follow-button btn  btnFollow btn-success">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                    </p>
                                </div> -->
                                
                                
                            </div>
                            
                        </div>
                        <!-- Coluna pesquisar pessoas -->
                        <div class="search block">
                            <!-- <a href="#">Procurar por pessoas</a> -->
                        </div>
                    </div>
                    
                    <div class="clear:both;"></div>
                </div>

            <!-- Scripts -->
            <script type="text/javascript" src="js/script.js"></script>
            <script type="text/javascript" src="js/jquery.js"></script>
	</body>
</html>
