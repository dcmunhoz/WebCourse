var conn   = require('./../includes/db');
var express = require('express');
var router = express.Router();
var menus = require('./../includes/menus');


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

  res.render('contacts', {
    title: "Contatos",
    background: "images/img_bg_3.jpg",
    h1: 'Diga um Oi!'
  });

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
  
  res.render('reservations', {
    title: "Fazer uma reserva",
    background: "images/img_bg_2.jpg",
    h1: 'Reserve uma mesa!'
  });

});

router.get('/services', function(req, res, next){

  res.render("services", {
    title: "Serviços disponiveis",
    background: "images/img_bg_1.jpg",
    h1: 'É um prazer poder servir!'
  });

});

module.exports = router;
