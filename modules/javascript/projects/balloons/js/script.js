var timerID = null; // Variavel que armazena a chamada da função timeout

// Função para selecionar nivel
function select_level(){
  var lvl = document.getElementById('game-level').value;
  window.location.href = '/modules/javascript/projects/balloons/game/index.html?'+lvl;

}

// Função para iniciar jogo
function startGame(){
  var url = window.location.search;
  var nivelJogo = url.replace("?", "");
  var tempoJogo

  // Niveis
  switch(nivelJogo){
    case '1': // 1 - 120 seg
      tempoJogo = 120;
      break;
    case '2': // 2 - 60 seg
      tempoJogo = 60;
      break;
    case '3': // 3 - 30 seg
      tempoJogo = 30;
      break;
  }

  document.getElementById('cronometro').innerHTML = tempoJogo;

  // Criar Balões
  var qtdeBaloes = 80;
  cria_baloes(qtdeBaloes)

  // Imprimir qtde balões inteiros
  document.getElementById('qtdeBaloesJogo').innerHTML = qtdeBaloes;

  // Imprimir qtder balões estourados
  document.getElementById('qtdeBaloesEstourados').innerHTML = 0;

  contegem_tempo(tempoJogo + 1);
}

//Função para criar balões
function cria_baloes(qtdeBaloes){
  for(var i = 1; i <= qtdeBaloes; i++){

    var balao = document.createElement("img");
    balao.src = '../imgs/balao_azul_pequeno.png';
    balao.style.margin = '12px';
    balao.id = 'b'+i;
    balao.onclick = function(){ estourar(this) }

    // Inserir baloes
    document.getElementById('game').appendChild(balao);

  }
}

// Função estourar balão
function estourar(e){
  var id_balao = e.id;

  document.getElementById(id_balao).onclick = '';
  document.getElementById(id_balao).src = '../imgs/balao_azul_pequeno_estourado.png';

  pontuacao(-1)
}

function pontuacao(acao){
  var baloes_inteiros   = document.getElementById('qtdeBaloesJogo').innerHTML;
  var baloes_estourados = document.getElementById('qtdeBaloesEstourados').innerHTML;

  baloes_inteiros = parseInt(baloes_inteiros);
  baloes_estourados = parseInt(baloes_estourados);

  baloes_inteiros += acao;
  baloes_estourados -= acao;

  document.getElementById('qtdeBaloesJogo').innerHTML = baloes_inteiros;
  document.getElementById('qtdeBaloesEstourados').innerHTML = baloes_estourados ;

  situacao_jogo(baloes_inteiros);


}

function situacao_jogo(baloes_inteiros){
  if (baloes_inteiros == 0){
    alert('Parabens, você conseguiu estourar todos os balões a tempo');
    pararJogo();
  }
}

function pararJogo(){
  clearTimeout(timerID);
}

// Função game over
function game_over(){
  alert('Fim de jogo, você não consegiu estourar todos os balões');
    remover_evento_baloes();
}

// Função cronometro
function contegem_tempo(segundos){

  segundos -= 1;

  if(segundos == -1){
    clearTimeout(timerID); // Para a execução do timer
    game_over();
    return false

  }

  document.getElementById('cronometro').innerHTML = segundos;

  timerID = setTimeout("contegem_tempo("+segundos+")", 1000);
}
function remover_evento_baloes(){
  var i = 1;

  while(document.getElementById('b'+i)){
    document.getElementById('b'+i).onclick = '';
  }
}
