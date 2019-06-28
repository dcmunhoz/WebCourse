module.exports = function(req, res, next){

    res.header('Access-Constrol-Allow-Origin', '*');
    res.header('Access-Constrol-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE');
    res.header('Access-Constrol-Allow-Headers', 'Origin, X-Request-With, Content-Type, Accept');
    next();
}