// Variaveis Globais
var game_level = null;
var timer = null;

// Função para iniciar o jogo
function startGame(){
  // Captura o nivel do jogo
  game_level = document.getElementById('level-select').value;

  // Definir o tempo de acordo com o nivel.
  switch(game_level){
    case '1':
      timer = 120;
      break;
    case '2':
      timer = 60;
      break;
    case '3':
      timer = 30;
      break;
  }

  // Inserir o valor do timer
  document.getElementById('timer-tick').innerHTML = timer;
  timerTick(timer) // Função que faz o timer funcionar

  document.getElementById('header').innerHTML = game_level;
}

// Função para contar o tempo.
function timerTick(tim){
  var time = null;
  timer = setInterval(function(){
    if( tim == -1){
      alert('PERDEU PLAYBOY');
      clearInterval(timer);
    }else{
      document.getElementById('timer-tick').innerHTML = tim;
      tim = tim - 1;
    }
  },1000);

}
