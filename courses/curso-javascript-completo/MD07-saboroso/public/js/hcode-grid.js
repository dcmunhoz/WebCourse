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
            btnUpdate: 'btn-update',
            btnDelete: 'btn-delete',
            listeners: {
                
            }
        }, configs);

        this.rows = [...document.querySelectorAll('table tbody tr')];

        this.initForms();
        this.initButtons();


    }

    fireEvent(name, args){
        if(typeof this.options.listeners[name] === 'function') this.options.listeners[name].apply(this, args)
    
    
    }

    initForms(){

        let formCreate = document.querySelector(this.options.formCreate);

        if(formCreate){
            formCreate.save({
                success: ()=>{
                    this.fireEvent("afterFormCreate");
                },
                failure: ()=>{
                    this.fireEvent("afterFormCreateError");
                }
            });
        }


        let formUpdate = document.querySelector(this.options.formUpdate);

        if(formUpdate){
            formUpdate.save({
                success: ()=>{
                    this.fireEvent("afterFormUpdate");
                },
                failure: ()=>{
                    this.fireEvent("afterFormUpdateError");
                }
            });
        }
    }

    getTrData(e){
        
        let tr = e.path.find(el=>{
            return (el.tagName.toUpperCase() === "TR")
        });

        return JSON.parse(tr.dataset.row)

    }

    btnUpdateClick(e){

        this.fireEvent("beforeUpdateClick", [e]);

        let data = this.getTrData(e);

        for (let name in data) {

            this.options.onUpdateLoad(this.formUpdate, name, data);

        }

        this.fireEvent('afterUpdateClick', [e]);

    }

    btnDeleteClick(e){

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


    }

    initButtons(){

        this.rows.forEach(row=>{

            [...row.querySelectorAll(`.btn`)].forEach(btn=>{

                btn.addEventListener('click', e=>{

                    if (e.target.classList.contains(this.options.btnUpdate)) {

                        this.btnUpdateClick(e);

                    }else if (e.target.classList.contains(this.options.btnDelete)) {
                        this.btnDeleteClick(e);
                    }else{

                        this.fireEvent('buttonClick', [e.target, this.getTrData(e), e]);

                    }


                })

            });

        });

    }

}