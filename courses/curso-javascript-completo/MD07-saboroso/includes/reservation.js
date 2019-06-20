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

            let query, params = [
                fields.name,
                fields.email,
                fields.people,
                date,
                fields.time
            ];

            if(parseInt(fields.id) > 0){

                query = `
                    UPDATE tb_reservations
                    SET name = ?,
                    email = ?,
                    people = ?,
                    date = ?,
                    time = ?
                    WHERE id = ?;
                `;

                params.push(fields.id);


            }else {

                query = ` INSERT INTO tb_reservations(name, email, people, date, time) VALUES 
                (?, ?, ?, ?, ?);`;

            }

            conn.query(query, params, (err, results)=>{

                if(err){
                    reject(err);
                }

                resolve(results);
                

            });


        });

    }

}