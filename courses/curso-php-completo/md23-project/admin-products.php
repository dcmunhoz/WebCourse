<?php

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Product;

$app->get("/admin/products", function(){
    User::verifyLogin();

    $page = new PageAdmin();

    $products = Product::listall();


    $page->setTpl("products", [
        "products"=>$products
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

/**
 *  PAUSA AQUI - Criar a rota de edição do produto
 * 
 *  TEMPO: 23:00
 * 
 */

?>