<?php 

use \Hcode\PageAdmin;
use \Hcode\Page;
use \Hcode\Model\Product;
use \Hcode\Model\Category;
use \Hcode\Model\Cart;
use \Hcode\Model\Address;
use \Hcode\Model\User;
use \Hcode\Model\Order;
use \Hcode\Model\OrderStatus;

$app->get('/', function() {

	$products = Product::listAll();
    
	$page = new Page();

	$page->setTpl("index", [
		"products"=>Product::checkList($products)
	]);

});

$app->get('/category/:idcategory', function($idcategory){

	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	$category = new Category();

	$category->get((int)$idcategory);

	$pagination = $category->getProductsPage($page);
	$pages = [];

	for ($i=1; $i <= $pagination['pages'] ; $i++) { 
		
		array_push($pages, [
			"link"=>'/WebCourse/courses/curso-php-completo/md23-project/index.php/category/'.$category->getidcategory(). '?page=' .$i,
			"page"=>$i
		]);

	}

	$page = new Page();

	$page->setTpl("category", [
		'category'=>$category->getValues(),
		'products'=>$pagination["data"],
		'pages'=>$pages
	]);

});

$app->get("/products/:desurl", function($desurl){

	$product = new Product();

	$product->getFromURL($desurl);

	$page = new Page();

	$page->setTpl('product-detail', [
		'product'=>$product->getValues(),
		'categories'=>$product->getCategories()
	]);

});

$app->get('/cart', function(){

	$cart = Cart::getFromSession();

	$page = new Page();

	$page->setTpl("cart",[
		'cart'=>$cart->getValues(),
		'products'=>$cart->getProducts(),
		'error'=>Cart::getMsgError()
	]);

});

$app->get("/cart/:idproduct/add", function($idproduct){

	$product = new Product();

	$product->get((int)$idproduct);

	$cart = Cart::getFromSession();
	
	$qtd = (isset($_GET['qtd'])) ? (int)$_GET['qtd'] : 1;

	for($i = 0; $i < $qtd; $i++){

		$cart->addProduct($product);

	}

	header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/cart");
	exit;

});

$app->get("/cart/:idproduct/minus", function($idproduct){

	$product = new Product();

	$product->get((int)$idproduct);

	$cart = Cart::getFromSession();
	
	$cart->removeProduct($product);

	header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/cart");
	exit;

});

$app->get("/cart/:idproduct/remove", function($idproduct){

	$product = new Product();

	$product->get((int)$idproduct);

	$cart = Cart::getFromSession();
	
	$cart->removeProduct($product, true);

	header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/cart");
	exit; 

});

$app->post("/cart/freight", function(){

	$cart = Cart::getFromSession();

	$cart->setFreight($_POST['zipcode']);

	header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/cart");
	exit;

});

$app->GET("/checkout", function(){

	User::verifyLogin(false);
	
	$address = new Address();

	$cart = Cart::getFromSession();

	if (isset($_GET['zipcode'])) {
		$_GET['zipcode'] = $cart->getdeszipcode();
	}

	if(isset($_GET['zipcode'])){

		$address->loadFromCEP($_GET['zipcode']);

		$cart->setdeszipcode($_GET['zipcode']);
		$cart->save();
		$cart->getCalculateTotal();

	}

	if (!$address->getdesaddress() ) $address->setdesaddress("");
	if (!$address->getdesnumber() ) $address->setdesnumber("");
	if (!$address->getdescomplement() ) $address->setdescomplement("");
	if (!$address->getdesdistrict() ) $address->setdesdistrict("");
	if (!$address->getdescity() ) $address->setdescity("");
	if (!$address->getdesstate() ) $address->setdesstate("");
	if (!$address->getdescountry() ) $address->setdescountry("");
	if (!$address->getdeszipcode() ) $address->setdeszipcode("");

	$page = new Page();

	$page->setTpl("checkout", [
		'cart'=>$cart->getValues(),
		'address'=>$address->getValues(),
		'products'=>$cart->getProducts(),
		'error'=>Address::getMsgError()

	]);


});

$app->post('/checkout', function(){

	User::verifyLogin(false);
	if (!isset($_POST['zipcode']) || $_POST['zipcode'] === '') {
		Address::setMsgError("Informe o CEP.");
		header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/checkout");
		exit;
	}

	if (!isset($_POST['desaddress']) || $_POST['desaddress'] === '') {
		Address::setMsgError("Informe o Endereço.");
		header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/checkout");
		exit;
	}

	if (!isset($_POST['desdistrict']) || $_POST['desdistrict'] === '') {
		Address::setMsgError("Informe o Bairro.");
		header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/checkout");
		exit;
	}

	if (!isset($_POST['descity']) || $_POST['descity'] === '') {
		Address::setMsgError("Informe a Cidade.");
		header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/checkout");
		exit;
	}

	if (!isset($_POST['desstate']) || $_POST['desstate'] === '') {
		Address::setMsgError("Informe o Estado.");
		header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/checkout");
		exit;
	}

	if (!isset($_POST['descountry']) || $_POST['descountry'] === '') {
		Address::setMsgError("Informe o Pais.");
		header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/checkout");
		exit;
	}

	$address = new Address();
	$user = User::getFromSession();


	$_POST['deszipcode'] = $_POST['zipcode'];
	$_POST['idperson'] = $user->getidperson();

	$address->setData($_POST);
	$address->save();

	$cart = Cart::getFromSession();

	$totals = $cart->getCalculateTotal();

	$order = new Order();

	$order->setData([
		'idcart'=>$cart->getidcart(),
		'idaddress'=>$address->getidaddress(),
		'iduser'=>$user->getiduser(),
		'idstatus'=>OrderStatus::EM_ABERTO,
		'vltotal'=>$cart->getvltotal()
	]);

	$order->save();

	

	switch ((int)$_POST['payment-method']) {
		case 1:
			header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/order/".$order->getidorder()."/paypal");
			exit;
		break;
	}	

	header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/order/".$order->getidorder());
	exit;

});

$app->get("/order/:idorder/paypal", function($idorder){

	User::verifyLogin();

	$order = new Order();

	$order->get((int)$idorder);

	$cart = $order->getCart();

	$page = new Page(['header'=>false,'footer'=>false]);

	$page->setTpl("payment-paypal",[
		'order'=>$order->getValues(),
		'cart'=>$cart->getValues(),
		'products'=>$cart->getProducts()
	]);

});

$app->GET("/login", function(){


	$page = new Page();

	$page->setTpl("login", [
		'error'=>User::getError(),
		'errorRegister'=>User::getErrorRegister(),
		'registerValues'=>(isset($_SESSION['registerValues'])) ? $_SESSION['registerValues'] : ['name'=>'', 'email'=>'', 'phone'=>'']
	]);


});


$app->POST("/login", function(){


	try{	

		User::Login($_POST['login'], $_POST['password']);
		

	}catch(Exception $e){

		User::setError($e->getMessage());

	}

	header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/checkout");
	exit;

	

});

$app->GET("/logout", function(){


	User::logout();

	header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/login");
	exit;
	

});

$app->POST("/register", function(){

	$_SESSION['registerValues'] = $_POST;

	if(!isset($_POST['name']) || $_POST['name'] == ""){

		User::setErrorRegister("Preencha o seu nome.");
		header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/login");
		exit;
	}

	if(!isset($_POST['email']) || $_POST['email'] == ""){

		User::setErrorRegister("Preencha o seu e-mail.");
		header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/login");
		exit;
	}

	if(!isset($_POST['password']) || $_POST['password'] == ""){

		User::setErrorRegister("Preencha a sua senha.");
		header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/login");
		exit;
	}

	if (User::checkLoginExist($_POST['email']) === true){

		User::setErrorRegister("Este endereço de e-mail já esta sendo utilizado.");
		header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/login");
		exit;

	}

	$user = new User();

	$user->setData([
		'inadmin'=>0,
		'deslogin'=>$_POST['email'],
		'desperson'=>$_POST['name'],
		'desemail'=>$_POST['email'],
		'despassword'=>$_POST['password'],
		'nrphone'=>$_POST['phone']
	]);

	$user->save();

	User::login($_POST['email'], $_POST['password']);

	header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/checkout");
	exit;

});


$app->get('/forgot', function(){

	$page = new Page();

	$page->setTpl("forgot");

});

$app->post('/forgot', function(){

	$user = User::getForgot($_POST['email'], false);

	header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/forgot/sent");

	exit;
});

$app->get('/forgot/sent', function(){

	$page = new Page();

	$page->setTpl("forgot-sent");

});

$app->get('/forgot/reset', function(){

	$user = User::validForgotDecrypt($_GET['code']);

	// var_dump($user);

	$page = new Page(); 


	$page->setTpl("forgot-reset", array(
		"name"=>$user['desperson'],
		"code"=>$_GET['code']
	));


});

$app->post('/forgot/reset', function(){

	$forgot = User::validForgotDecrypt($_POST['code']);

	User::setForgotUser($forgot['idrecovery']);
	
	$user = new User();

	$user->get((int)$forgot['iduser']);

	$password = password_hash($_POST['password'], PASSWORD_DEFAULT, [
		"cost"=>12
	]);

	$user->setPassword($password);

	$page = new Page();

	$page->setTpl("forgot-reset-success");

});

$app->get('/profile', function(){

	User::verifyLogin(false);

	$user = User::getFromSession();

	$page = new Page();
	$page->setTpl("profile",[
		'user'=>$user->getValues(),
		'profileMsg'=>User::getSuccess(),
		'profileError'=>User::getError()
	]);



});

$app->post("/profile", function(){

	User::verifyLogin(false);

	if( !isset($_POST['desperson']) || $_POST['desperson'] === '' ){
		User::setError("Preencha o seu nome");
		header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/profile");
		exit;
	}

	if( !isset($_POST['desemail']) || $_POST['desemail'] === '' ){
		User::setError("Preencha o seu e-mail");
		header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/profile");
		exit;
	}

	
	$user = User::getFromSession();


	if($_POST['desemail'] !== $user->getdesemail()){

		if(User::checkLoginExist($_POST['desemail']) === true){

			User::setError("este endereço de e-mail já está cadastrado.");
			header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/profile");
			exit;
		}

	}


	$_POST['inadmin'] = $user->getinadmin();
	$_POST['despassword'] = $user->getdespassword();
	$_POST['deslogin'] = $_POST['desemail'];

	$user->setData($_POST);

	$user->update();

	User::setSuccess("Dados alterados com sucesso!");

	header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/profile");
	exit;

});

$app->get("/order/:idorder", function($idorder){

	User::verifyLogin(false);

	$order = new Order();

	$order->get((int) $idorder);

	$page = new Page();
	$page->setTpl("payment",[
		'order'=>$order->getValues()

	]);


});

$app->get('/boleto/:idorder', function($idorder){

	User::verifyLogin(false);
	$order = new Order();
	$order->get((int)$idorder);

	// DADOS DO BOLETO PARA O SEU CLIENTE
	$dias_de_prazo_para_pagamento = 10;
	$taxa_boleto = 5.00;
	$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
	$valor_cobrado = $order->getvltotal(); // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
	$valor_cobrado = str_replace(",", ".",$valor_cobrado);
	$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

	$dadosboleto["nosso_numero"] = $order->getidorder();  // Nosso numero - REGRA: Máximo de 8 caracteres!
	$dadosboleto["numero_documento"] = $order->getidorder();	// Num do pedido ou nosso numero
	$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
	$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emissão do Boleto
	$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
	$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula

	// DADOS DO SEU CLIENTE
	$dadosboleto["sacado"] = $order->getdesperson();
	$dadosboleto["endereco1"] = $order->getdesaddress() . " " . $order->getdesdristrict();
	$dadosboleto["endereco2"] = $order->getdescity() . " - " . $order->getdesdristrict() . " - " . $order->getdescity() . "CEP: " . $order->deszipcode();

	// INFORMACOES PARA O CLIENTE
	$dadosboleto["demonstrativo1"] = "Pagamento de Compra na Loja Hcode E-commerce";
	$dadosboleto["demonstrativo2"] = "Taxa bancária - R$ 0,00";
	$dadosboleto["demonstrativo3"] = "";
	$dadosboleto["instrucoes1"] = "- Sr. Caixa, cobrar multa de 2% após o vencimento";
	$dadosboleto["instrucoes2"] = "- Receber até 10 dias após o vencimento";
	$dadosboleto["instrucoes3"] = "- Em caso de dúvidas entre em contato conosco: suporte@hcode.com.br";
	$dadosboleto["instrucoes4"] = "&nbsp; Emitido pelo sistema Projeto Loja Hcode E-commerce - www.hcode.com.br";

	// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
	$dadosboleto["quantidade"] = "";
	$dadosboleto["valor_unitario"] = "";
	$dadosboleto["aceite"] = "";		
	$dadosboleto["especie"] = "R$";
	$dadosboleto["especie_doc"] = "";


	// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //


	// DADOS DA SUA CONTA - ITAÚ
	$dadosboleto["agencia"] = "1690"; // Num da agencia, sem digito
	$dadosboleto["conta"] = "48781";	// Num da conta, sem digito
	$dadosboleto["conta_dv"] = "2"; 	// Digito do Num da conta

	// DADOS PERSONALIZADOS - ITAÚ
	$dadosboleto["carteira"] = "175";  // Código da Carteira: pode ser 175, 174, 104, 109, 178, ou 157

	// SEUS DADOS
	$dadosboleto["identificacao"] = "Hcode Treinamentos";
	$dadosboleto["cpf_cnpj"] = "24.700.731/0001-08";
	$dadosboleto["endereco"] = "Rua Ademar Saraiva Leão, 234 - Alvarenga, 09853-120";
	$dadosboleto["cidade_uf"] = "São Bernardo do Campo - SP";
	$dadosboleto["cedente"] = "HCODE TREINAMENTOS LTDA - ME";

	$path = $_SERVER['DOCUMENT_ROOT'] . "WebCourse/courses/curso-php-completo/md23-project/" . DIRECTORY_SEPARATOR . "res" . DIRECTORY_SEPARATOR . "boletophp" . DIRECTORY_SEPARATOR . "include" . DIRECTORY_SEPARATOR;
	

	require_once($path . "funcoes_itau.php");
	require_once($path . "layout_itau.php");

});

$app->get("/profile/orders", function(){

	User::verifyLogin(false);

	$user = User::getFromSession();

	$page = new Page();
	$page->setTpl("profile-orders", [
		'orders'=>$user->getOrders()
	]);

});

$app->get("/profile/orders/:idorder", function($idorder){

	User::verifyLogin(false);

	$order = new Order();
	$cart = new Cart();

	
	$order->get((int)$idorder);

	$cart->get((int)$order->getidcart());
	$cart->getCalculateTotal();


	$page = new Page();
	$page->setTpl("profile-orders-detail", [
		'order'=>$order->getValues(),
		'cart'=>$cart->getValues(),
		'products'=>$cart->getProducts()
	]);

});

$app->get("/profile/change-password", function(){

	User::verifyLogin(false);

	$page = new Page();

	$page->setTpl("profile-change-password",[
		'changePassError'=>User::getError(),
		'changePassSuccess'=>User::getSuccess()
	]);


});

$app->post("/profile/change-password", function(){

	User::verifyLogin(false);

	if (!isset($_POST['current_pass']) || $_POST['current_pass'] === "") {

		User::setError("Digite a senha atual. ");
		header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/profile/change-password");
		exit;
	}

	if (!isset($_POST['new_pass']) || $_POST['new_pass'] === "") {

		User::setError("Digite a nova senha. ");
		header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/profile/change-password");
		exit;
	}

	if (!isset($_POST['new_pass_confirm']) || $_POST['new_pass_confirm'] === "") {

		User::setError("Confirme a nova senha ");
		header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/profile/change-password");
		exit;
	}

	if ($_POST['current_pass'] === $_POST['new_pass'] ) {
		User::setError("Sua nova senha deve ser diferente da atual. ");
		header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/profile/change-password");
		exit;
	}

	$user = User::getFromSession();

	if (!password_verify($_POST['current_pass'], $user->getdespassword())) {

		User::setError("A senha esta invalida. ");
		header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/profile/change-password");
		exit;

	}

	$user->setdespassword($_POST['new_pass']);

	$user->update();

	User::setSuccess("Senha alterada com sucesso.");
	header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/profile/change-password");
	exit;

});


?>