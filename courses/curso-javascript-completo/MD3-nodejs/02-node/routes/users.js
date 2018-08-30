let express = require('express');
let routes  = express.Router();


routes.get('/', (req, res)=>{
    res.statusCode = 200;
    res.setHeader('Content-Type', 'application/json');
    res.json({
        users:[{
            name:'hcode',
            email:'hcode@teste.com'
        }]
    });
});

routes.get('/admin', (req, res)=>{
    res.statusCode = 200;
    res.setHeader('Content-Type', 'application/json');
    res.json({
        admin:[{
            nome:'Daniel Munhoz',
            email:'dc.munhoz@hotmail.com'
        }]
    });
});

module.exports = routes;