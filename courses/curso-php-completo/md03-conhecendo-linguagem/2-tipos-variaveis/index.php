<?php

// Recomendasse criar variaveis utilizando o padrão CamelCase onde o nome da variavel
// é escrita com o primeiro nome em minusculo, caso seja uma palavra composta, a primeira palavra
// fica minusculo e a primeira letra da segunda palavra fica maiuscula.
// Ex:
$anoNascimento   = 1997;
$nomeCompleto    = "Daniel Munhoz";

var_dump($anoNascimento);
echo("<br>");
var_dump($nomeCompleto);

// É possivel tambem excluir uma variável utilizando a função unset()
unset($anoNascimento);
var_dump($anoNascimento);

echo("<br>");

// Para verificar se uma variavel existe, podemos utilizar a função isset()
if(isset($anoNascimento)){
    echo "A variavel existe !";
}else{
    echo "A variavel não existe";
}

echo("<br>");
echo("<br>");

// =============== Tipos de dados ===============

// Existem 8 tipos de dados primitivos divididos em 3 grupos
// Tipos básicos:
// Strings  = tipo string, são os textos
// Int      = tipo inteiro, são numeros
// Float    = tipo decimas, são numeros que aceitam casas decimais
// Boolean  = tipo boleano, somente verdadeiro ou falso

// Tipos composts:
// Array    = conjunto de informações
// Objetos  = presente na programação orientada a objeto

// Tipos especiais:
// Resourse =
// Null     = não contem nenhum dado.

//string
$nome    = "Hcode";

//int
$ano     = 1990;

//float
$salario =  5000.40;

//double
$ativo   = false;

///////////////////////////////////

//Array
$frutas = array("Abacaxi", "Laranja", "Manga");
$carros = ["Mustang", "Fusca", "Porsche"];
var_dump($carros);

//Objeto
$dtNascimento = new DateTime;
echo("<br>");
var_dump($dtNascimento);

///////////////////////////////////

echo("<br>");
echo("<br>");

$arquivo = fopen("index.php", "r");
var_dump($arquivo);