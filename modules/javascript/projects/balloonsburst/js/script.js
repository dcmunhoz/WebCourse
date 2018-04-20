// Variaveis Globais
var game_level = null;
var timer = null;

// Função para iniciar o jogo
function startGame(){


  // Inserir o valor do timer
  timerTick(5) // Função que faz o timer funcionar
}

// Função para verificar o nivel
function getLevel(){
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

  document.getElementById('timer-tick').innerHTML = timer;

}

// Função para contar o tempo.
function timerTick(tim){
  var time = null;
  tim -= 1;
  timer = setInterval(function(){
    if( tim == -1){
      clearInterval(timer);
      alert('PERDEU PLAYBOY');
    }else{
      document.getElementById('timer-tick').innerHTML = tim;
      tim = tim - 1;
    }
  },1000);

}

// Função para gerar os balõe
function setBalloons(val){
  for(var i = 1; i <= val; i++){
    var baloes = document.createElement('img');
    baloes.src = 'imgs/balao_azul_grande.png';
    baloes.setAttribute('id', 'b'+i);
    baloes.classList.add('balloons-inner');
    baloes.setAttribute('onclick', 'balloonShot('+ baloes.getAttribute('id')+ ')');
    document.getElementById('game-inner').appendChild(baloes);
  }
}
function balloonShot(el){
  var elemento = el.id;
  var balloon = document.getElementById(elemento);

  balloon.src = 'imgs/balao_azul_grande_estourado.png';

}
