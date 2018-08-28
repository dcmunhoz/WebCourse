class UserController{

    constructor(formIdCreate, formIdUpdate, tableId){
    
        this.formEl  = document.getElementById(formIdCreate);
        this.formUpdateEl  = document.getElementById(formIdUpdate);
        this.tableEl = document.getElementById(tableId); 
        this.onSubmit();
        this.onEditCancel();
        this.selectAll();
    
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

            let userOld = JSON.parse(tr.dataset.user);

            let result = Object.assign({}, userOld, user);

            this.showPanelCreate();

            this.getPhoto(this.formUpdateEl).then(
                (content)=>{

                    if (!user.photo) {
                        result._photo = userOld._photo;
                    } else {
                        result._photo = content;
                    }

                    let userEdit = new User();

                    userEdit.loadFromJSON(result);

                    userEdit.save();

                    this.getTr(userEdit, tr);
        
                    this.updateCount();
                    
                    this.formUpdateEl.reset();

                    btn.disabled = false;

                    this.showPanelCreate();

                }, 
                (e)=>{

                    console.log(e);

                }
            );


        });

    }

    onSubmit(){

        this.formEl.addEventListener("submit", event=>{
            event.preventDefault();
            
            let btn = this.formEl.querySelector("[type=submit]");

            btn.disabled = true;

            let user = this.getValues(this.formEl);

            if(!user) return false;

            this.getPhoto(this.formEl).then(
                (content)=>{

                    user.photo = content;

                    user.save();
    
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

    getPhoto(formEl){

        return new Promise((resolve, reject)=>{

            let fileReader = new FileReader();

            let fields = formEl.elements;

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

    getUsersStorage(){

        let users = [];
        
        if(localStorage.getItem("users")){

            users = JSON.parse(localStorage.getItem("users"));

        }

        return users;

    }

    selectAll(){

        let users = this.getUsersStorage();

        users.forEach(dataUser=>{

            let user = new User();

            user.loadFromJSON(dataUser);

            this.addline(user)
        });
    }

    addline(dataUser, tableId){

        let tr = this.getTr(dataUser);

        this.tableEl.appendChild(tr);

        this.updateCount();
    }

    getTr(dataUser, tr = null){

        if (tr === null) tr = document.createElement('tr');

        tr.dataset.user = JSON.stringify(dataUser);

        tr.innerHTML = `
            <td><img src="${dataUser.photo}" alt="User Image" class="img-circle img-sm"></td>
            <td>${dataUser.name}</td>
            <td>${dataUser.email}</td>
            <td>${(dataUser.admin) ? 'Sim' : 'Não'}</td>
            <td>${Utils.dateFormat(dataUser.register)}</td>
            <td>
            <button type="button" class="btn btn-primary btn-edit btn-xs btn-flat">Editar</button>
            <button type="button" class="btn btn-danger btn-delete btn-xs btn-flat">Excluir</button>
            </td>
        `;
        
        this.addEventsTr(tr);

        return tr;
    }


    addEventsTr(tr){

        tr.querySelector(".btn-delete").addEventListener("click", e=>{

            if(confirm("Deseja realmente excluir?")){

                tr.remove();

                this.updateCount();

            }

        });

        tr.querySelector(".btn-edit").addEventListener("click", e=>{
            
            let json = JSON.parse(tr.dataset.user);
            this.formUpdateEl.dataset.trIndex = tr.sectionRowIndex;

            for (let name in json){

                let field = this.formUpdateEl.querySelector("[name="+ name.replace("_", "") +"]");

                if(field){

                    switch(field.type){
                        case 'file':
                            continue;
                        break;

                        case 'radio':
                            let rad = this.formUpdateEl.querySelector("[name="+ name.replace("_", "") +"][value="+ json[name] +"]");
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

            this.formUpdateEl.querySelector(".photo").src = json._photo;

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