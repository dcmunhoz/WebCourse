// Utilização de if com operadores


if(1 == 1){
  console.log('Verdadeiro');
}

if(1 == 2){
  console.log('Verdadeiro');
}else{
  console.log('Falso');
}
if(1 > 1){
  console.log('Verdadeiro');
}else{
  console.log('Falso');
}

if('Daniel' == 'Godofredo'){
  console.log('Verdadeiro');
}else{
  console.log('Falso');
}

if('Daniel' === 'Daniel'){
  console.log('Verdadeiro');
}else{
  console.log('Falso');
}

// Teste para aprovação de aluno.
var nota = prompt('Digite a nota final:');
var media = 7;

if( nota >= media){
  console.log('Aluno Aprovado');
}else{
  console.log('Aluno Reprovado');
}
