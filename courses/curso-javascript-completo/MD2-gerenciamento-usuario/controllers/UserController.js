class UserController{

    constructor(formIdCreate, formIdUpdate, tableId){
    
        this.formEl  = document.getElementById(formIdCreate);
        this.formUpdateEl  = document.getElementById(formIdUpdate);
        this.tableEl = document.getElementById(tableId); 
        this.onSubmit();
        this.onEditCancel();
    
    }

    onEditCancel(){
        document.querySelector("#box-user-update .btn-cancel").addEventListener("click", e=>{

            this.showPanelCreate();

        });

        this.formUpdateEl.addEventListener("submit", e=>{
            e.preventDefault();

            let btn = this.formUpdateEl.querySelector("[type=sumbit]");

            let user = this.getValues(this.formUpdateEl);

            let index = this.formUpdateEl.dataset.trIndex;

            let tr = this.tableEl.rows[index];

            tr.dataset.user = JSON.stringify(user);

            tr.innerHTML = `
                <td><img src="${user.photo}" alt="User Image" class="img-circle img-sm"></td>
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>${(user.admin) ? 'Sim' : 'Não'}</td>
                <td>${Utils.dateFormat(user.register)}</td>
                <td>
                <button type="button" class="btn btn-primary btn-edit btn-xs btn-flat">Editar</button>
                <button type="button" class="btn btn-danger btn-xs btn-flat">Excluir</button>
                </td>
            `;

            this.addEventsTr(tr);

            this.updateCount();

        });

    }

    onSubmit(){

        this.formEl.addEventListener("submit", event=>{
            event.preventDefault();
            
            let btn = this.formEl.querySelector("[type=submit]");

            btn.disabled = true;

            let user = this.getValues(this.formEl);

            if(!user) return false;

            this.getPhoto().then(
                (content)=>{

                    user.photo = content;

                    this.addline(user);
                    
                    this.formEl.reset();

                    btn.disabled = false;

                }, 
                (e)=>{

                    console.log(e);

                }
            );

        });

    }

    getPhoto(){

        return new Promise((resolve, reject)=>{

            let fileReader = new FileReader();

            let fields = this.formEl.elements;

            let elements = [...fields].filter(item=>{
                if(item.name === "photo"){
                    return item;
                }
            });

            let file = elements[0].files[0];

            fileReader.onload = ()=>{
                
                resolve(fileReader.result);
            };

            fileReader.onerror = (e)=>{
                reject(e);
            };

            if(file) {
                fileReader.readAsDataURL(file);
            }else{
                resolve('dist/img/boxed-bg.jpg');
            }
        })

        

    }

    getValues(formEl){

        let user = {}
        let isValid = true;

        let fields = formEl.elements;
        [...fields].forEach((field, index)=>{
   
            if(['name', 'email', 'password'].indexOf(field.name) > -1 && !field.value){
            
                field.parentElement.classList.add('has-error');
                isValid = false;
                
            }            

            if(field.name == 'gender'){
        
                if(field.checked){
        
                    user[field.name] = field.value;
        
                }
        
            }else if(field.name === 'admin'){
                user[field.name] = field.checked;
            }else{
        
                user[field.name] = field.value;
            
            }
        
        });
        

        if(!isValid){
            return false;
        }


        return new User(user.name, user.gender, user.birth, user.country, user.email, user.password, user.photo, user.admin);
    }

    addline(dataUser, tableId){

        let tr = document.createElement('tr');

        tr.dataset.user = JSON.stringify(dataUser);

        tr.innerHTML = `
            <td><img src="${dataUser.photo}" alt="User Image" class="img-circle img-sm"></td>
            <td>${dataUser.name}</td>
            <td>${dataUser.email}</td>
            <td>${(dataUser.admin) ? 'Sim' : 'Não'}</td>
            <td>${Utils.dateFormat(dataUser.register)}</td>
            <td>
            <button type="button" class="btn btn-primary btn-edit btn-xs btn-flat">Editar</button>
            <button type="button" class="btn btn-danger btn-xs btn-flat">Excluir</button>
            </td>
        `;

        this.addEventsTr(tr);

        this.tableEl.appendChild(tr);

        this.updateCount();
    }

    addEventsTr(tr){
        tr.querySelector(".btn-edit").addEventListener("click", e=>{
            
            let json = JSON.parse(tr.dataset.user);
            let form = document.querySelector("#form-user-update");
            form.dataset.trIndex = tr.sectionRowIndex;

            for (let name in json){

                let field = form.querySelector("[name="+ name.replace("_", "") +"]");

                if(field){

                    switch(field.type){
                        case 'file':
                            continue;
                        break;

                        case 'radio':
                            let rad = form.querySelector("[name="+ name.replace("_", "") +"][value="+ json[name] +"]");
                            rad.chacked = true;
                        break;

                        case 'checkbox':
                            field.checked = json[name];
                        break;

                        default:
                            field.value = json[name];
                        break;
                    }
                }

            }

            this.showPanelUpdate();

        });

    }

    showPanelCreate(){
        document.querySelector("#box-user-create").style.display = "block";
        document.querySelector("#box-user-update").style.display = "none";
    }

    showPanelUpdate(){
        document.querySelector("#box-user-create").style.display = "none";
        document.querySelector("#box-user-update").style.display = "block";
    }


    updateCount(){
        
        let numberUsers = 0;
        let numberAdmin = 0;


        [...this.tableEl.children].forEach(line=>{

            numberUsers++;

            let objUser = JSON.parse(line.dataset.user);

            if(objUser._admin) numberAdmin++;

        });

        document.querySelector("#number-users").innerHTML       = numberUsers;
        document.querySelector("#number-users-admin").innerHTML = numberAdmin;

    }

}