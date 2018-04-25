var rodada = 1;
var matriz_jogo = Array(3);

$(document).ready(function(){

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

    alert(rodada);
    rodada++;

    $('#'+id).css('background-image',icone);
  }

});
