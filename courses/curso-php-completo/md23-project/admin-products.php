<?php

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Product;

$app->get("/admin/procucts", function(){
    User::verifyLogin();

    $page = new PageAdmin();

    $products = Product::listall();


    $page->setTpl("products", [
        "products"=>$products
    ]);

});

?>