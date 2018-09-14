<?php
    require_once("config.php");

    use Cliente\Cadastro;

    $cad = new Cadastro();

    $cad->setNome("Daniel Munhoz");
    $cad->setEmail("daniel@daniel.com");
    $cad->setSenha("123456");

    $cad->registrarVenda();

?>