var conn = require('./db');
var utils = require('./utils');

module.exports = {

    render(req, res, error, success){

        res.render('reservations', {
            title: "Fazer uma reserva",
            background: "images/img_bg_2.jpg",
            h1: 'Reserve uma mesa!',
            body: req.body,
            error,
            success
          });
        

    },

    save(fields){

        return new Promise((resolve, reject)=>{

            let date = utils.convertDate(fields.date);

            conn.query(`
                INSERT INTO tb_reservations(name, email, people, date, time) VALUES 
                (?, ?, ?, ?, ?);
            `, [
                fields.name,
                fields.email,
                fields.people,
                date,
                fields.time
            ], (err, results)=>{

                if(err){
                    reject(err);
                }

                resolve(results);
                

            });


        });

    }

}