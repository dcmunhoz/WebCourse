var round = 1;
var player = '';
var point = 0;
var hash = [];
var soma = null;

$(document).ready(function(){

  // Inicia o jogo
  $('#start-game').click(function(){
    // Desabilita start e habilita jogo
    $('#game-start').hide();

    // Exibe a tela do jogo
    $('#game-inner').show(function(){
      // Exibe os nicks
      $('#nick-player-one').html($('#player-one-nick').val());
      $('#nick-player-two').html($('#player-two-nick').val());

      // Tabela do jogo pronta
      $('#game-table').ready(function(){
        criarTabelaJogo();

        // Jogada click
        $('.jogada').click(function(){

          varificaRodada();

          // Separa o id do elemento clicado em um array para utilizar na isnerção do array
          var mxn     = this.id.split('-');
          var linha   = mxn[0];
          var coluna  = mxn[1];

          hash[linha][coluna] = point;

          this.innerHTML = player;

          // Incrementa a variavel de RODADA
          round += 1;

          // Apos um elemento ser clicado, remove seu evento de click
          $('#'+this.id).off();

          // Verifica jogo
          verificaJogo(mxn);

        }); // # Jogada click

      }); // # Tabela do jogo pronta


    }); // # Exibe a tela do jogo


  }); // # Inicia Jogo



  function criarTabelaJogo(){
    // Cria a tabela visual do jogo juntamente com a matriz que recebera os dados.

    // Pega a tabela do DOM
    var table_game = document.getElementById('game-table');

    // Necessário fazer um for reverso pois o insertRow(0) sempre ira inserir
    // uma row no inicio da tabela, com isso a posição 0 sempre sera a ultima,
    // para deixarmos a 0 na primeira temos que fazer a inversao do for.

    // Laço que insere as linhas
    for(var i = 3; i >= 1; i--){
      // Insere uma nova ROW a cada repetição
      var row = table_game.insertRow(0);

      // Insere um novo array dentro do array.
      hash[i] = [];

      // Laço que insere as colunas
      for(var j = 3; j >= 1; j--){
        // Insere uma nova CELL a cada repetição
        var cell = row.insertCell(0);

        // Insere o valor 0 em cada posição do array;
        hash[i][j] = 0;

        //Atribui os id's e classe's para cada elemento.
        cell.setAttribute('id', i+'-'+j);     // id = sua posição na matriz
        cell.setAttribute('class','jogada');  // classe para capiturar o click de cada elemento futuramente


        // Insere as bordas na tabela para ficar parecido com um ''#''
        if(i == 1 && j == 1){
          cell.style.borderBottom = '1px solid red';
          cell.style.borderRight = '1px solid red';
        }else if(i == 1 && j == 2){
          cell.style.borderBottom = '1px solid red';
        }else if(i == 1 && j == 3){
          cell.style.borderBottom = '1px solid red';
          cell.style.borderLeft = '1px solid red';
        }

        if(i == 2 && j == 1){
          cell.style.borderBottom = '1px solid red';
          cell.style.borderRight = '1px solid red';
        }else if(i == 2 && j == 2){
          cell.style.borderBottom = '1px solid red';
        }else if(i == 2 && j == 3){
          cell.style.borderBottom = '1px solid red';
          cell.style.borderLeft = '1px solid red';
        }

        if(i == 3 && j == 1){
          cell.style.borderRight = '1px solid red';
        }else if(i == 3 && j == 3){
          cell.style.borderLeft = '1px solid red';
        }
      }
    }
  }

  function varificaRodada(){
    // LOGICA DE RODADA: A variavel da rodada (round) irá iniciar com o valor 1, então
    // vamos dividir essa variavel por 2 e pegar o seu resto. Caso resto deja 1, significa
    // que a rodada é impar, portando o jogador 1 irá jogar sempre na rodada impar, se for
    // 0 então o jogador 2 irá jogar a rodada par.

    // O jogador 1 irá inserir na matriz o valor -1 e o jogador 2 irá inserir o valor 1

    if(round % 2 == 1){ // Rodada impar = Jogador 1
      point = -1;
      player = '<img src="assets/imgs/p1.png">';
    } else{ // Rodada par = Jogador 2
      point = 1;
      player = '<img src="assets/imgs/p2.png">';
    }

  }

  function verificaJogo(el){
    // A cada click verifica se existe um ganhador, se a soma dos valores for igual -3
    // então o jogador 1 ganha, se for 3 então o jogador 2 ganha.

    // Zerar a soma a cada laço
    soma = 0;
    // Verifica Horizontal do elemento
    for(var i = 1; i <=3; i++){
      soma += hash[el[0]][i];
    }

    // Verifica se a posição é vencedora
    alertaGanhador();

    // Zerar a soma a cada laço
    soma = 0;
    // Verifica Vertical do elemento
    for(var i = 1; i <=3; i++){
      soma += hash[i][el[1]];
    }

    // Verifica se a posição vencedora
    alertaGanhador();

    // Zerar a soma a cada laço
    soma = 0;
    // Verifica Diagonal para direita
    for(var i = 1; i <=3; i++){
      soma += hash[i][i];
    }

    // Verifica se a posição vencedora
    alertaGanhador();

    // Zerar a soma a cada laço
    soma = 0;
    // Verifica Diagonal para esquerda
    for(var i = 3; i >=1; i++){
      soma += hash[i][i];
    }

    // Verifica se a posição vencedora
    alertaGanhador();



  }

  function alertaGanhador(){
    if(soma == -3){
      alert($('#player-one-nick').val() + ' Ganhou');
      $('.jogada').off();
    }else if(soma == 3){
      alert($('#player-two-nick').val() + ' Ganhou');
      $('.jogada').off();
    }
  }
});
