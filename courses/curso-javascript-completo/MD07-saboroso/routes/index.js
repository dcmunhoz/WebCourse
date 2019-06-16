var conn   = require('./../includes/db');
var express = require('express');
var router = express.Router();


/* GET home page. */
router.get('/', function(req, res, next) {

  conn.query("SELECT * FROM tb_menus ORDER BY title", (err, results)=>{

    if (err){
      console.error(err);
    } 

    res.render('index', { 
      title: 'Restaurante Saboroso',
      menus: results 
    });

  });

});

router.get('/contacts', function(req, res, next){

  res.render('contacts', {
    title: "Contatos"
  });

});

router.get('/menus', function(req, res, next){
  res.render('menus', {
    title: "Menus"
  });

});

router.get('/reservations', function(req, res, next){
  
  res.render('reservations', {
    title: "Fazer uma reserva"
  });

});

router.get('/services', function(req, res, next){

  res.render("services", {
    title: "Serviços disponiveis"
  });

});

module.exports = router;
