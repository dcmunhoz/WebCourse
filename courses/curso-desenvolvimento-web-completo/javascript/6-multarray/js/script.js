
// Criação do array pai
var lista_coisas = Array();

// Criação dos array filhos dentro do array pai
// Definimos o indice frutas e os valores contidos
lista_coisas['frutas'] = Array('Banana', 'Maçã', 'Abacaxi');

// Definimos o indice nomes e os valores contidos
lista_coisas['nomes'] = Array('Daniel', 'Clemencio', 'Godofredo');

// Acessando o array multidimensional
alert(lista_coisas['nomes'][0] + ' ' + lista_coisas['frutas'][1]);
