var conn = require('./db');

module.exports = {

    getEmails(){

        return new Promise((resolve, reject)=>{

            conn.query(`
                select * from tb_emails order by email
            `, (err, result)=>{
                if(err){
                    reject(err);
                } 

                resolve(result);
            });

        });

    },
    delete(id){
        return new Promise((resolve, reject)=>{
  
          conn.query(`
            DELETE FROM tb_emails WHERE id = ?;
          `, [
            id
          ], (err, results)=>{
            if(err) reject(err);
  
            resolve(results);
  
          });
  
        });
  
        
    },
    save(req){
        return new Promise((resolve, reject)=>{

            conn.query(`
                insert into tb_emails(email) values(?)
            `, [
                req.field.email
            ], (err, scs)=>{
                if(err){
                    reject(err.message);
                }

                resolve(scs);
            
            });

        });
    }


}