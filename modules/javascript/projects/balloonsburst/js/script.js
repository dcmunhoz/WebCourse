// Variaveis Globais
var game_level = null;
var timer = null;
var time = null;
var base_time = null;
var balloons_alive = null;
var balloons_death = 0;
var win = null;

// Função para iniciar o jogo
function startGame(){
  // Inserir o valor do timer
  timerTick(base_time) // Função que faz o timer funcionar
}

// Função para verificar o nivel
function getLevel(){
  // Captura o nivel do jogo
  game_level = document.getElementById('level-select').value;

  // Definir o tempo de acordo com o nivel.
  switch(game_level){
    case '1':
      base_time = 120;
      break;
    case '2':
      base_time = 60;
      break;
    case '3':
      base_time = 30;
      break;
  }

  document.getElementById('timer-tick').innerHTML = base_time;

}

// Função para contar o tempo.
function timerTick(tim){
  time = tim;
  time -= 1;
  timer = setInterval(function(){

    if(balloons_alive > 0 && time == -1){ // Derrota
      win = 0;
      isWinner();
      removeBalloonsClick();
      clearInterval(timer);


    }else if(balloons_alive == 0 && time >= 0){ // Vitoria
      win = 1;
      isWinner();
      removeBalloonsClick();
      clearInterval(timer);

    }else{
      document.getElementById('timer-tick').innerHTML = time;
      time = time - 1;
    }

  },1000);

}

// Função para gerar os balõe
function setBalloons(val){

  balloons_alive = val;
  for(var i = 1; i <= val; i++){
    var baloes = document.createElement('img');
    baloes.src = 'imgs/balao_azul_grande.png';
    baloes.setAttribute('id', 'b'+i);
    baloes.classList.add('balloons-inner');
    baloes.setAttribute('onclick', 'balloonShot('+ baloes.getAttribute('id')+ ')');
    document.getElementById('game-inner').appendChild(baloes);
  }
}

// Função para estourar os balões ao clicar
function balloonShot(el){
  var elemento = el.id;
  var balloon = document.getElementById(elemento);
  balloon.src = 'imgs/balao_azul_grande_estourado.png';
  scoreRefresh();
  balloon.onclick = '';

}


// Função para inserir o placar
function score(){
  document.getElementById('value-alive').innerHTML = balloons_alive;
  document.getElementById('value-death').innerHTML = balloons_death;
}

// Função para atualizar o placar
function scoreRefresh(){
  balloons_alive -= 1;
  balloons_death += 1;
  score();
}


// Função para remover evento de clique em caso de derrota
function removeBalloonsClick(){
  var i = 1;
  while (document.getElementById('b'+i)) {
      document.getElementById('b'+i).onclick = '';
      i++;
  }
}

// Animação vitoria
function isWinner(){
  if ( win == 1){
    var message = 'Winner =]';
    showMessage(message);

  }else{
    var message = 'Loser =[';
    showMessage(message);
  }
}

// Animação derrota
