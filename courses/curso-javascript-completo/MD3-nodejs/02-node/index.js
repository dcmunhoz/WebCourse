const express   = require('express');
let routeIndex  = require('./routes/index');
let routeUser   = require('./routes/users');


let app = express();

app.use(routeIndex);
app.use('/users',routeUser);

app.listen(3000, '127.0.0.1', ()=>{
    console.log("Server OK!");
});