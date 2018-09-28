<?php

require_once("config.php");

// $sql = new Sql();

// $res = $sql->select("SELECT * FROM tb_usuarios");

// Carrega um usuário
//$user = new Usuario();
//$user->loadById(4);
//echo $user;

// Carrega uma lista de usuários
// $list = Usuario::getList();
// echo json_encode($list);

// Carrega uma lista de usuários buscando pelo login
// $busca = Usuario::search("jo");
// echo json_encode($busca);

// Autentica usuários
$usuario = new Usuario();
$usuario->login("root", ")(*&");

echo $usuario;
?>