<?php

require_once("config.php");

// $sql = new Sql();

// $res = $sql->select("SELECT * FROM tb_usuarios");

$user = new Usuario();
$user->loadById(4);

echo $user;

?>