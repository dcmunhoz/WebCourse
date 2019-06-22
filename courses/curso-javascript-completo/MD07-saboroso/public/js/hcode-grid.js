class HcodeGrid {

    constructor(configs){

        configs.listeners = Object.assign({
            beforeUpdateClick(e){
                console.log("antes do click");
        
            },
            afterUpdateClick(e){
                $('#modal-update').modal('show');
        
            },
            afterDeleteClick(e) {
                
                window.location.reload(); 
                
            },
            afterFormCreate (e){
                window.location.reload(); 

            },
            afterFormCreate (e){
                window.location.reload(); 

            },
            afterFormCreateError(){

                alert("não foi possivel enviar o formulário");

            },
            afterFormUpdateError(){

                alert("não foi possivel atualizar o formulário.");

            }

        }, configs.listeners)

        this.options = Object.assign({}, {
            formCreate: '#modal-create form',
            formUpdate: '#modal-update form',
            btnUpdate: '.btn-update',
            btnDelete: '.btn-delete',
            listeners: {
                
            }
        }, configs);

        this.initForms();
        this.initButtons();


    }

    fireEvent(name, args){
        if(typeof this.options.listeners[name] === 'function') this.options.listeners[name].apply(this, args)
    
    
    }

    initForms(){

        let formCreate = document.querySelector(this.options.formCreate);

            formCreate.save().then(json=>{

                this.fireEvent('afterFormCreate');

        }).catch(err=>{

            this.fireEvent('afterFormCreateError');

        });

        let formUpdate = document.querySelector(this.options.formUpdate);

            formUpdate.save().then(json=>{

                this.fireEvent('afterFormUpdate');

        }).catch(err=>{
            this.fireEvent('afterFormUpdateError');
            
        });


    }

    getTrData(e){
        
        let tr = e.path.find(el=>{
            return (el.tagName.toUpperCase() === "TR")
        });

        return JSON.parse(tr.dataset.row)

    }

    initButtons(){

        [...document.querySelectorAll(this.options.btnUpdate)].forEach(btn=>{


            btn.addEventListener('click', e=>{
                    
        
                e.preventDefault();

                let data = this.getTrData(e);
        
                let formUpdate = document.querySelector(this.options.formUpdate);

                for (let name in data ){
        
                    let input = formUpdate.querySelector(`[name=${name}]`);
        
                    switch(name){
                    case 'date':
                        
                        if (input) input.value = moment(data[name]).format("YYYY-MM-DD")
                    break;        
                    case 'photo':
                        formUpdate.querySelector('img').src = '/'+data[name]
                    break;
        
                    default:
                        
                        if (input) input.value = data[name]
                    break;
        
                    } 
        
                }
                
                this.fireEvent('afterUpdateClick', []);
               
            });

    
            });
    
            [...document.querySelectorAll(this.options.btnDelete)].forEach(btn=>{
    
    
                btn.addEventListener('click', e=>{
        
                    this.fireEvent("beforeDeleteClick", []);

                    e.preventDefault();
            
                    if (confirm("Deseja realmente excluir?")){
            
            

                        let data = this.getTrData(e);
                        fetch(eval( '`' + this.options.deleteUrl + '`' ),
                        {
                            method: 'DELETE'
                        }).then(response => response.json())
                            .then(json=>{
                                
                                this.fireEvent("afterDeleteClick", []);
            
                        });
                    }
                });
    
            });


    }

    init(){




        


    }


}