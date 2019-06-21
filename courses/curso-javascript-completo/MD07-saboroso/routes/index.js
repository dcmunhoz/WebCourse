var conn   = require('./../includes/db');
var express = require('express');
var router = express.Router();
var menus = require('./../includes/menus');
var reservations = require('./../includes/reservation');
var contacts = require('./../includes/contacts');

/* GET home page. */
router.get('/', function(req, res, next) {

  menus.getMenus().then(results=>{

    res.render('index', { 
      title: 'Restaurante Saboroso',
      menus: results,
      isHome: true 
    });


  });

});

router.get('/contacts', function(req, res, next){

  contacts.render(req, res);

});

router.post('/contacts', function(req, res){

  if(!req.body.name){
    contacts.render(req, res, "Insira um nome.");
  }else if(!req.body.email){
    contacts.render(req, res, "Insira um email.");
  }else if(!req.body.message){
    contacts.render(req, res, "Informe a mensagem.");
  }else{

    contacts.save(req.body).then(results=>{

      contacts.render(req, res, null, "Sua mensagem foi enviada com sucesso !");

    }).catch(err=>{
      contacts.render(req, res, err.message);
    });

  }

});

router.get('/menus', function(req, res, next){

  menus.getMenus().then(results=>{

    res.render('menus', {
      title: "Menus",
      background: "images/img_bg_1.jpg",
      h1: 'Saboreie nosso menu!',
      menus: results
    });

  });



});

router.get('/reservations', function(req, res, next){

  reservations.render(req, res);

});

router.post('/reservations', function(req, res, next){
  
  if(!req.body.name){
    reservations.render(req, res, "Digite o nome.");
  }else if(!req.body.email){
    reservations.render(req, res, "Digite um email.");
  }else if(!req.body.people){
    reservations.render(req, res, "Selecione o numero de pessoas.");
  }else if(!req.body.date){
    reservations.render(req, res, "Escolha uma data.");
  }else if(!req.body.email){
    reservations.render(req, res, "Escolha um horario.");
  }else{

    reservations.save(req.body).then(results=>{

     reservations.render(req, res, null, "Reserva realizada com sucesso.");

    }).catch(err=>{

      reservations.render(req, res, err.message);

    });

  }


});

router.get('/services', function(req, res, next){

  res.render("services", {
    title: "Serviços disponiveis",
    background: "images/img_bg_1.jpg",
    h1: 'É um prazer poder servir!'
  });

});

module.exports = router;