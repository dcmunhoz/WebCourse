// Acionar div Login
var btnEntrar = document.getElementById('menuBtnEntrar');
var active = 0;

btnEntrar.onclick = function(){

  if( active == 0){
    document.getElementById('login-box').style.display = 'inline-block';
    active = 1;
  }else{
    document.getElementById('login-box').style.display = 'none';
    active = 0;
  }
}
