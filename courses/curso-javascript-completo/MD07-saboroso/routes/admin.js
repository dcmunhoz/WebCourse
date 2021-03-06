var express = require('express');
var router = express.Router();
var users = require('./../includes/users');
var admin = require('./../includes/admin');
var menus = require('./../includes/menus');
var reservations = require('./../includes/reservation');
var moment = require('moment');
var contacts = require('./../includes/contacts');
var email = require('./../includes/emails');


module.exports = function(io){

    router.use(function(req, res, next){

        if (["/login"].indexOf(req.url) == -1 && !req.session.user){
            res.redirect("/admin/login");
            console.log('perdeu');
        }else{
            next();
        }
    
    
    });
    
    router.use(function(req, res, next){
    
        req.menus = admin.getMenus(req);
    
        next();
    
    });
    
    router.get('/logout', function(req, res, next){
    
        delete req.session.user;
        res.redirect('/admin/login');
    
    });
    
    router.get('/', function(req, res, next){
    
        admin.dashboard().then(data=>{
    
            
            res.render("admin/index.ejs", admin.getParams(req, {
                data: data
            }));
    
        }).catch(err=>{
    
            console.error(err);
    
        });
    
    });
    
    router.get('/dashboard', function(req, res, next){
    
        reservations.dashboard().then(data=>{
    
            res.send(data);
    
        });
    
    });
    
    router.post('/login', function(req, res, next){
    
        if(!req.body.email){
            users.render(req, res, "Preencha o email.");
        }else if(!req.body.password){
            users.render(req, res, "Preencha a senha.");
        }else{
    
            users.login(req.body.email, req.body.password).then(user=>{
                
                req.session.user = user;
    
                res.redirect('/admin');
    
            }).catch(err=>{
    
                users.render(req, res, err.message || err);
    
            });
    
        }
    
    
    })
    
    router.get('/login', function(req, res, next){
    
        users.render(req, res, null);
    
    });
    
    router.get('/contacts', function(req, res, next){
    
        contacts.getContacts().then(data=>{
    
            res.render('admin/contacts', admin.getParams(req, {
                data
            }));
    
        });
    
    
    });
    
    router.delete('/contacts/:id', function(req, res, next){
    
        contacts.delete(req.params.id).then(results=>{
    
            res.send(results);
            io.emit("dashboard update");
        }).catch(err=>{
            res.send(err)
    
        });
    
    });
    
    router.get('/emails', function(req, res, next){
    
        email.getEmails().then(data=>{
            res.render('admin/emails', admin.getParams(req, {
                data
            }));
        });
    
    });
    
    router.delete('/emails/:id', function(req, res, next){
    
        email.delete(req.params.id).then(result=>{
    
            res.send(result);
            io.emit("dashboard update");
        }).catch(err=>{
            res.send(result);
        });
    
    });
    
    router.get('/menus', function(req, res, next){
    
        menus.getMenus().then(data=>{
    
            res.render('admin/menus', admin.getParams(req, {
                data
            }));
    
        });
    
    });
    
    router.post('/menus', function(req, res, next){
    
        menus.save(req.fields, req.files).then(results=>{
    
            window.location.reload();
            io.emit("dashboard update");
        }).catch(err=>{
    
            res.send(err);
    
        });
    
    });
    
    router.delete("/menus/:id", function(req, res, next){
    
        menus.del(req.params.id).then(results=>{
    
            res.send(results);
            io.emit("dashboard update");
    
        }).catch(err=>{res.send(err);});
    
    });
    
    router.get('/reservations', function(req, res, next){
    
        let start = (req.query.start) ? req.query.start : moment().subtract(1, 'year').format("YYYY-MM-DD");
        let end = (req.query.end) ? req.query.end : moment().format("YYYY-MM-DD");
    
        reservations.getReservation(req).then(pag=>{
            res.render('admin/reservations', admin.getParams(req, {
                date: {
                    start,
                    end
                },
                data: pag.data,
                moment,
                links: pag.links
            }));
        });
    
    
    
    });
    
    router.get('/reservations/chart', function(req, res, next){
    
        req.query.start = (req.query.start) ? req.query.start : moment().subtract(1, 'year').format("YYYY-MM-DD");
        req.query.end = (req.query.end) ? req.query.end : moment().format("YYYY-MM-DD");
    
        reservations.chart(req).then(chartData=>{
    
            res.send(chartData);
    
        });
    
    });
    
    router.post('/reservations', function(req, res, next){
    
        reservations.save(req.fields, req.files).then(results=>{
            io.emit("dashboard update");
            window.location.reload();
        }).catch(err=>{
    
            res.send(err);
    
        });
    
    });
    
    router.delete("/reservations/:id", function(req, res, next){
    
        reservations.delete(req.params.id).then(results=>{
    
            res.send(results);
            io.emit("dashboard update");
        }).catch(err=>{res.send(err);});
    
    });
    
    
    router.get('/users', function(req, res, next){
    
        users.getUsers().then(data=>{
    
            res.render('admin/users', admin.getParams(req,{
                data
            }));
    
    
        })
    
    
    });
    
    router.post('/users', function(req, res, next){
    
    
        users.save(req.fields).then(results=>{
    
            res.send(results)
            io.emit("dashboard update");
        }).catch(err=>{
    
            res.send(err)
    
        });
    
    });
    
    router.delete('/users/:id', function(req, res, next){
    
        users.del(req.params.id).then(results=>{
    
            res.send(results)
            io.emit("dashboard update");
        }).catch(err=>{
    
            res.send(err)
    
        });
    
    });
    
    router.post('/users/password-change', function(req, res, next){
    
        users.changePassword(req).then(results=>{
    
            res.send(results)
    
        }).catch(err=>{
            res.send({
                error: err
            })
        });
    
    });

    return router;
};