// Variaveis globais.
var num1;
var num2;
var opcao;
var error;

// Função para calcular os valores
function calcular(){
  verificaCampos();

  num1 = parseFloat(document.getElementById('primeiroValor').value);
  num2 = parseFloat(document.getElementById('segundoValor').value);
  opcao = document.getElementById('opcao').value;
  var resposta = document.getElementById('resposta');
  var res;




  switch (opcao){
    case '1': // Adição
      res = num1 + num2;
      break;
    case '2': // Subtração
      res = num1 - num2;
      break;
    case '3': // Multiplicação
      res = num1 * num2;
      break;
    case '4': // Divisão
      res = num1 / num2;
      break;
    case '5': // Modulo
      break;
    case '0':
      break;
  }

  resposta.value = res;

}

// Função para verificar os campos
function verificaCampos(){
  num1 = document.getElementById('primeiroValor');
  num2 = document.getElementById('segundoValor');
  error = document.getElementById('error');
  opcao = document.getElementById('opcao');

  if(num1.value == ''){
    num1.classList.add('alert');
  }

  if(num2.value == ''){
    num2.classList.add('alert');
  }

  if( opcao.value == 0){
    opcao.classList.add('alert');
  }

  if ( num1.value == '' || num2.value == '' || opcao.value == 0 ){
    error.style.display = 'block';
  }

}
