
// Verificar se um aluno passou ou não.

var media = prompt('Media do Aluno');
var faltas = prompt('Quantidade de faltas');

// Verifica se a condição de aprovação é verdadeira
if ( media >=7 && faltas < 5 ){
  console.log('Aluno Aprovado');
}else{
  console.log('Aluno Reprovado');
}
