class HcodeGrid {

    constructor(configs){

        this.options = Object.assign({}, {
            formCreate: '#modal-create form',
            formUpdate: '#modal-update form',
            btnUpdate: '.btn-update',
            btnDelete: '.btn-delete',
        }, configs);

        this.initForms();
        this.initButtons();


    }

    initForms(){

        let formCreate = document.querySelector(this.options.formCreate);

            formCreate.save().then(json=>{

            window.location.reload();

        }).catch(err=>{

            console.log(err);

        });

        let formUpdate = document.querySelector(this.options.formUpdate);

            formUpdate.save().then(json=>{

            window.location.reload();

        }).catch(err=>{

            console.log(err);
            
        });


    }

    initButtons(){

        [...document.querySelectorAll(this.options.btnUpdate)].forEach(btn=>{

            btn.addEventListener('click', e=>{
    
            e.preventDefault();
    
            let tr = e.path.find(el=>{
                return (el.tagName.toUpperCase() === "TR")
            });
    
            let data = JSON.parse(tr.dataset.row)
    
            let formUpdate = document.querySelector(this.options.formUpdate);
            
            for (let name in data ){
    
                let input = formUpdate.querySelector(`[name=${name}]`);
    
                switch(name){
                case 'date':
                    
                    if (input) input.value = moment(data[name]).format("YYYY-MM-DD")
                break;
    
                default:
                    
                    if (input) input.value = data[name]
                break;
    
                }
    
            }
    
            $('#modal-update').modal('show');
    
            });
    
            });
    
            [...document.querySelectorAll(this.options.btnDelete)].forEach(btn=>{
    
    
            btn.addEventListener('click', e=>{
    
            e.preventDefault();
    
            if (confirm("Deseja realmente excluir?")){
    
    
                let tr = e.path.find(el=>{
                return (el.tagName.toUpperCase() === "TR")
                });
    
                let data = JSON.parse(tr.dataset.row)
    
                fetch(eval( '`' + this.options.deleteUrl + '`' ),
                {
                    method: 'DELETE'
                }).then(response => response.json())
                    .then(json=>{
    
                    window.location.reload(); 
    
                });
            }
            });
    
            });


    }

    init(){




        


    }


}