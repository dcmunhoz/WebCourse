// Variaveis globais.
var num1;
var num2;
var opcao;
var error;
var contadorErros = 0;
var countUm    = 0;
var countDois  = 0;
var countTres  = 0;

// Função para calcular os valores
function calcular(){
  verificaCampos();

  if (contadorErros > 0){
    document.getElementById('error').style.display = 'block';
    return false;
  }

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

  verificaPrimeiro();
  verificaSegundo();
  verificaOpcao();

}

// Verificar campos separadamente
function verificaPrimeiro(){
  num1 = document.getElementById('primeiroValor');
  if (isNaN(parseFloat(num1.value))){
    num1.classList.add('alert');
    adicionaErro('primeiro');
  }else{
    num1.classList.remove('alert');
    removeErro('primeiro');
  }
}

function verificaSegundo(){
  num2 = document.getElementById('segundoValor');
  if (isNaN(parseFloat(num2.value))){
    num2.classList.add('alert');
    adicionaErro('segundo');
  }else{
    num2.classList.remove('alert');
    removeErro('segundo');
  }
}

function verificaOpcao(){
  opcao = document.getElementById('opcao');
  if(opcao.value == '0'){
    opcao.classList.add('alert');
    adicionaErro('opcao');
  }else{
    opcao.classList.remove('alert');
    removeErro('opcao');
  }
}

// Adicionar contador de Erros
function adicionaErro(opcao){
  if (opcao == 'primeiro' && countUm < 1){
    contadorErros += 1;
    countUm++;
  }

  if (opcao == 'segundo' && countDois < 1){
    contadorErros += 1;
    countDois++;
  }

  if (opcao == 'opcao' && countTres < 1){
    contadorErros += 1;
    countTres++;
  }

}

// Adicionar contador de Erros
function removeErro(opcao){
  if (opcao == 'primeiro' && countUm > 0){
    contadorErros -= 1;
    countUm--;
  }

  if (opcao == 'segundo' && countDois > 0){
    contadorErros -= 1;
    countDois--;
  }

  if (opcao == 'opcao' && countTres > 0){
    contadorErros -= 1;
    countTres--;
  }

}
