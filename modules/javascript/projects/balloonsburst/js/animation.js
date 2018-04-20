// Variaveis Globais
var load = null;

// Ativa o level assim que a logo sumir
function loader(){
  load = setTimeout(function(){
    document.getElementById('game-level').style.visibility = 'visible';
  }, 0); // Mudar esse tempo para a duração da Animação do logo
}

// Abre o jogo
function gameContainer(){

  document.getElementById('game-level').style.animation = 'level-fadeout 700ms cubic-bezier(.45,-0.58,.67,.53) forwards';

  load = setTimeout(function(){
    getLevel();
    setBalloons(5);
    score();
    document.getElementById('game-level').style.visibility = 'hidden';
    document.getElementById('game-container').style.visibility = 'visible';
    document.getElementById('game-container').style.animation = 'game-load 1000ms ease-in-out forwards';
    var gameStart = setTimeout(function(){
      document.getElementById('game').style.visibility = 'visible';
      document.getElementById('game').style.animation = 'game-fadein 1000ms ease-in-out forwards';
      document.getElementsByClassName('pulse')[0].style.animation = 'pulse 1000ms ease-in-out 1000ms infinite';
      counter();
      clearTimeout(gameStart);
    },1200);
    clearTimeout(load);
  }, 700)
}

// Função do contador
function counter(){
  var counting = 3;

  var counter = setInterval(function(){

    var htmlCounter = document.getElementsByClassName('counter');

    if(counting == 0){
      htmlCounter[0].innerHTML = "GO";
      htmlCounter[1].innerHTML = "GO";
    }else{
      htmlCounter[0].innerHTML = counting;
      htmlCounter[1].innerHTML = counting;
    }

    if( counting == -1){
      startGame();
      clearInterval(counter);
      document.getElementById('count').style.visibility = 'hidden';
    }

    counting = counting - 1;
  },1000);

}
