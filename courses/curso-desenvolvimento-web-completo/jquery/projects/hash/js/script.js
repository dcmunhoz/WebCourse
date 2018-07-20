var rodada = 1;
var matriz_jogo = Array(3);

matriz_jogo['a'] = Array(3);
matriz_jogo['b'] = Array(3);
matriz_jogo['c'] = Array(3);

matriz_jogo['a'][1] = 0;
matriz_jogo['a'][2] = 0;
matriz_jogo['a'][3] = 0;

matriz_jogo['b'][1] = 0;
matriz_jogo['b'][2] = 0;
matriz_jogo['b'][3] = 0;

matriz_jogo['c'][1] = 0;
matriz_jogo['c'][2] = 0;
matriz_jogo['c'][3] = 0;

$(document).ready( function(){

  $('#btn-iniciar').click(function(){
    var p1 = $('#apelido-p1').val();
    var p2 = $('#apelido-p2').val();

    // Valida a digitação dos apelidos dos jogadores
    if( p1 == ""){
      alert('Primeiro jogador deve ser inserido');
      return false;
    }

    if( p2 == ""){
      alert('Segundo jogador deve ser inserido');
      return false;
    }

    // Exibir Apelidos
    $('#jogador-1').html(p1);
    $('#jogador-2').html(p2);


    // Exibir palco do jogo e esconder pagina inicial
    $('#pagina_inicial').hide();
    $('#palco_jogo').show();

  });

  $('.jogada').click(function(){
    var id_campo_clicado = this.id;
    $('#'+id_campo_clicado).off();
    jogada(id_campo_clicado);
  });

  function jogada(id){
    var icone = '';
    var ponto = 0;

    if((rodada % 2) == 1){
      icone = 'url("imgs/marcacao_1.png")';
      ponto = -1;
    }else{
      icone = 'url("imgs/marcacao_2.png")';
      ponto = 1;
    }
    rodada++;

    $('#'+id).css('background-image', icone);

    var linha_coluna = id.split('-');
    var linha = linha_coluna[0];
    var coluna = linha_coluna[1];

    matriz_jogo[linha][coluna] = ponto;

    verificaJogada();


  }

  function verificaJogada(){

    // Verifica na Horizontal
    var pontos = 0;
    for(var i = 1;i <= 3; i++){
      pontos = pontos + matriz_jogo['a'][i];
    }
    ganhador(pontos);

    pontos = 0;
    for(var i = 1;i <= 3; i++){
      pontos = pontos + matriz_jogo['b'][i];
    }
    ganhador(pontos);

    pontos = 0;
    for(var i = 1;i <= 3; i++){
      pontos = pontos + matriz_jogo['c'][i];
    }
    ganhador(pontos);

    // Verifica na vertical
    for(var l = 1; l <= 3; l++){
      pontos = 0;

      pontos += matriz_jogo['a'][l];
      ganhador(pontos);
      pontos += matriz_jogo['b'][l];
      ganhador(pontos);
      pontos += matriz_jogo['c'][l];
      ganhador(pontos);
    }

    // Verificar Diagonais
    pontos = 0;
    pontos = matriz_jogo['a'][1] + matriz_jogo['b'][2] + matriz_jogo['c'][3];
    ganhador(pontos);

    pontos = 0;
    pontos = matriz_jogo['a'][3] + matriz_jogo['b'][2] + matriz_jogo['c'][1];
    ganhador(pontos);
  }

  function ganhador(pontos){
    if(pontos == -3){
      alert($('#apelido-p1').val() + ' é o vencedor');
      $('.jogada').off();
    }else if(pontos == 3){
      alert($('#apelido-p2').val() + ' é o vencedor');
      $('.jogada').off();
    }
  }

});
