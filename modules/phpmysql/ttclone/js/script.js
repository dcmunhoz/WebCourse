// Acionar div Login
var btnEntrar = document.getElementById('menuBtnEntrar');
var active = 0;

btnEntrar.onclick = function(){

  if( active === 0){
    document.getElementById('login-box').style.display = 'inline-block';
    active = 1;
  }else{
    document.getElementById('login-box').style.display = 'none';
    active = 0;
  }
};


// Verifica se o usuário e senha esta correto.
var error = 0;
window.onload = function(){
    verificaParametros();
    if(error == 1){
        document.getElementById('login-box').style.display = 'inline-block';
        document.getElementById('login-error').style.display = 'inline-block';
        active = 1;
    }else{
        document.getElementById('login-box').style.display = 'none';
        document.getElementById('login-error').style.display = 'none';
        active = 0;
    }
};

function verificaParametros(){
    try{
        var url = window.location;
        var params = url.toString().split("?")[1];
        error = params.split("=")[1];
        
    }catch (e){
    }
}

// Verifica se os campos de usuário e senha estão preenchidos
document.getElementById("btnLogin").onclick = function(){
    var usuarioLoginCampo = document.getElementById("user-login");
    var senhaLoginCampo   = document.getElementById("pwd-login");
    var usuarioLogin      = usuarioLoginCampo.value;
    var senhaLogin        = senhaLoginCampo.value;
    var campoVazio        = false;
    
    if(usuarioLogin == ''){
        usuarioLoginCampo.classList.add('input-error');
        campoVazio = true;
    }else{
        usuarioLoginCampo.classList.remove('input-error');
    }
    
    if(senhaLogin == ''){
        senhaLoginCampo.classList.add('input-error');
        campoVazio = true;
    }else{
        senhaLoginCampo.classList.remove('input-error');
        
    }
    
    if (campoVazio) return false;
    
}
