module.exports = app=>{

    app.get('/users', (req, res)=>{
        res.statusCode = 200;
        res.setHeader('Content-Type', 'application/json');
        res.json({
            users:[{
                name:'hcode',
                email:'hcode@teste.com',
                id:1
            }]
        });
    });
    
    app.get('/users/admin', (req, res)=>{
        res.statusCode = 200;
        res.setHeader('Content-Type', 'application/json');
        res.json({
            admin:[{
                nome:'Daniel Munhoz',
                email:'dc.munhoz@hotmail.com'
            }]
        });
    });

};