var conn = require('./db');
var utils = require('./utils');
var Pagination = require("./pagination");
var moment = require("moment");

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

    },

    getReservation(req){

        return new Promise((resolve, reject)=>{

            let page = req.query.page;
            let dtstart = req.query.start;
            let dtend = req.query.end;

            if(!page) page = 1;

            let params = [];
            
            if(dtstart && dtend){
                params.push(dtstart, dtend)
            }
    
            let pag = new Pagination(`
                SELECT SQL_CALC_FOUND_ROWS * FROM tb_reservations ORDER BY date DESC ${(dtstart && dtend) ? "WHERE date BETWEEN ? AND ?" : "" }  LIMIT ?, ?
            `, params);
    
            pag.getPage(page).then(data=>{

                resolve({
                    data,
                    links: pag.getNavigation(req.query)
                })

            })



        });

        

    },

    delete(id){

        return new Promise((resolve, reject)=>{

            conn.query(`
              DELETE FROM tb_reservations WHERE id = ?;
            `, [
              id
            ], (err, results)=>{
              if(err) reject(err);
    
              resolve(results);
    
            });
    
          });

    },
    chart(req){
        return new Promise((resolve, reject)=>{

            conn.query(`
            SELECT
                CONCAT(YEAR(date), '-', MONTH(date)) AS date,
                COUNT(*) AS total,
                SUM(people) / COUNT(*) AS avg_people
            FROM tb_reservations
            WHERE date BETWEEN ? AND ?
            GROUP BY YEAR(date) DESC, MONTH(date) DESC
            ORDER BY YEAR(date) DESC, MONTH(date) DESC;
            `, [
                req.query.start,
                req.query.end
            ], (err, result)=>{

                if(err){
                    reject(err);
                }else{

                    let months = [];
                    let values = [];

                    result.forEach(row=>{

                        months.push(moment(row.date).format('MMM YYYY'));
                        values.push(row.total);

                    });

                    resolve({
                        months,
                        values
                    });
                }

            });

        });
    }

}