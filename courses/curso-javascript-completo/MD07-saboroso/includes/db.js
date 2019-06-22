let mysql = require('mysql2');

const connection = mysql.createConnection({
    host: 'localhost',
    user: 'saboroso',
    database: 'saboroso',
    password: 'saboroso',
    multipleStatements: true
});

module.exports = connection;
