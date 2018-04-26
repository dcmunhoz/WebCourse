var round = 1;
var hash = [];

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
          alert(this.id);

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

        console.log(hash);

      }
    }

  }



});
