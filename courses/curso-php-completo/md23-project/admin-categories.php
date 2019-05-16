<?php

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Category;
use \Hcode\Model\Product;

$app->get('/admin/categories', function(){

	User::verifyLogin();

	$categories = Category::listAll();

	$page = new PageAdmin();

	$page->setTpl("categories", [
		'categories'=>$categories

	]);


});

$app->get('/admin/categories/create', function(){

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("categories-create");


});


$app->post('/admin/categories/create', function(){

	User::verifyLogin();

	$category = new Category;

	$category->setData($_POST);

	$category->save();

	header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/admin/categories ");

	exit;
});

$app->get('/admin/categories/:idcategory/delete', function($idcategory){

	User::verifyLogin();

	$category = new Category;

	$category->get((int)$idcategory);

	$category->delete();

	header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/admin/categories ");

	exit;
});

$app->get('/admin/categories/:idcategory', function($idcategory){

	User::verifyLogin();

	$category = new Category();

	$category->get((int)$idcategory);

	$page = new PageAdmin();

	$page->setTpl("categories-update", [
		'category'=>$category->getValues()
	]);

});

$app->post('/admin/categories/:idcategory', function($idcategory){

	User::verifyLogin();

	$category = new Category();

	$category->get((int)$idcategory);
	
	$category->setData($_POST);

	$category->save();

	header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/admin/categories ");

	exit;

});



$app->get('/admin/categories/:idcategoy/products',function($idcategory){

	User::verifyLogin();

	$category = new Category();

	$category->get((int)$idcategory);

	$page = new PageAdmin();

	$page->setTpl("categories-products", [
		'category'=>$category->getValues(),
		'productsRelated'=>$category->getProducts(),
		'productsNotRelated'=>$category->getProducts(false)
	]);

});

$app->get('/admin/categories/:idcategoy/products/:idproduct/add',function($idcategory, $idproduct){

	User::verifyLogin();

	$category = new Category();
	$category->get((int)$idcategory);

	$product = new Product();
	$product->get((int)$idproduct);

	$category->addProduct($product);

	Header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/admin/categories/$idcategory/products");
	exit;
});

$app->get('/admin/categories/:idcategoy/products/:idproduct/remove',function($idcategory, $idproduct){

	User::verifyLogin();

	$category = new Category();
	$category->get((int)$idcategory);

	$product = new Product();
	$product->get((int)$idproduct);

	$category->removeProduct($product);

	Header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/admin/categories/$idcategory/products");
	exit;
});


?>