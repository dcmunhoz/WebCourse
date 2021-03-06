<?php

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Product;

$app->get("/admin/products", function(){
    User::verifyLogin();

    $search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if($search !== ""){

		$pagination = Product::getPageSearch($search, $page);

	}else{

		$pagination = Product::getPage($page);

	}


	$pages = [];

	for($x = 0; $x < $pagination['pages']; $x++){
		array_push($pages, [
			'href'=>'/WebCourse/courses/curso-php-completo/md23-project/index.php/admin/products?'.http_build_query([
				'page'=>$x+1,
				'search'=>$search
			]),
			'text'=>$x+1
		]);
	}

    $page = new PageAdmin();

    $products = Product::listall();


    $page->setTpl("products", [
        "products"=>$pagination['data'],
		"search"=>$search,
		"pages"=>$pages
    ]);

});


$app->get("/admin/products/create", function(){

    User::verifyLogin();

    $page = new PageAdmin();

    $page->setTpl("products-create");

});

$app->post("/admin/products/create", function(){

    User::verifyLogin();

    $product = new Product;

    $product->setData($_POST);

    $product->save();

    Header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/admin/products");

    exit;
});

$app->get('/admin/products/:idproduct', function($idProduct){

    User::verifyLogin();

    $product = new Product();

    $product->get((int)$idProduct);

    $page = new PageAdmin();

    $page->setTpl("products-update", [
        'product'=>$product->getValues()
    ]);

});

$app->post('/admin/products/:idproduct', function($idProduct){

    User::verifyLogin();

    $product = new Product();

    $product->get((int)$idProduct);

    $product->setData($_POST);

    $product->save();

    $product->setPhoto($_FILES["file"]);

    header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/admin/products");
    exit;

});

$app->get('/admin/products/:idproduct/delete', function($idProduct){

    User::verifyLogin();

    $product = new Product();

    $product->get((int)$idProduct);

    $product->delete();

    header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/admin/products");
    exit;

});


?>