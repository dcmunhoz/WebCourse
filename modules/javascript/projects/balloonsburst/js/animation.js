// Variaveis Globais
var load = null;

// Desativar logo load
function loader(){
  load = setTimeout(function(){
    document.getElementById('game-level').style.visibility = 'visible';
  }, 4000);
}

// Abre o jogo
function gameContainer(){
  document.getElementById('game-level').style.animation = 'level-fadeout 700ms cubic-bezier(.45,-0.58,.67,.53) forwards';

  load = setTimeout(function(){
    document.getElementById('game-level').style.visibility = 'hidden';
    document.getElementById('game-container').style.visibility = 'visible';
    document.getElementById('game-container').style.animation = 'game-load 1000ms ease-in-out forwards';
    clearTimeout(load);
    var gameStart = setTimeout(function(){
      startGame();
      clearTimeout(gameStart);
    },1200);
  }, 700)
}
