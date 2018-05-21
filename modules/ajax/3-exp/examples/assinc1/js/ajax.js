// Variavel que irá guardar nosso objeto.
var xhttp;

function reqAssinc(url, divDestino){
  document.getElementById('content-loader').innerHTML = '<img class="panel-loader" src="../assets/loader.gif"></img>'
  divDestino = 'content-loader';
  startXHTTP();

  setTimeout(function(){
    xhttp.onreadystatechange = statusRequisicao;
    xhttp.open('GET', url);
    xhttp.send();
    clearTimeout();
  }, 2000)

}

function startXHTTP(){

  // Instancia o objeto de acordo com o navegador

  if(window.XMLHttpRequest){ // Navegadores atuais
    xhttp = new XMLHttpRequest();
  }else if(window.ActiveXObject){ // Versões mais antigas do IE
    try {
      xhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      try {
        xhttp = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (e) {
        alert("Imposivel fazer a isntancia do XMLHTTP, Verifique se a versão do seu navegador suporta esta função.");
      }
    }

  }

  if(!xhttp){
    alert('Erro ao tentar criar uma instancia do XMLHTTPREQUEST');
    return false;
  }

}

function statusRequisicao(){
  if(xhttp.readyState == 4){
    if(xhttp.status == 200){
      document.getElementById("content-loader").innerHTML = xhttp.responseText;
    }
  }
}
