// Variaveis Globais
var load = null;

// Desativar logo load
function loader(){
  load = setTimeout(function(){
    document.getElementById('game-level').style.visibility = 'visible';
  }, 4000);
}

// Abre o jogo
function startGame(){
  document.getElementById('game-level').style.animation = 'teste 1000ms ease-in-out 4000ms forwards running';
}
