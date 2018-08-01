<?php

$nome = (int) $_GET["a"]; 

// var_dump($nome);

$ip = $_SERVER["REMOTE_ADDR"];

session_start();
$_SESSION['user']   = 'daniel';
$_SESSION['ip']     = $_SERVER['REMOTE_ADDR'];
var_dump($_SESSION);

?>