class DropboxController {

    constructor(){

        this.btnSendFileEl  = document.querySelector("#btn-send-file");
        this.inputFilesEl   = document.querySelector("#files");
        this.snackModalEl   = document.querySelector("#react-snackbar-root");

        this.initEvents();

    }

    initEvents(){

        this.btnSendFileEl.addEventListener('click', event =>{

            this.inputFilesEl.click();

        });

        this.inputFilesEl.addEventListener('change', event=>{
            
            this.uploadTask(event.target.files);

            this.snackModalEl.style.display = 'block';

        });

    }

    uploadTask(files){

        let promises = [];

        [...files].forEach(file=>{

            promises.push(new Promise((resolve, reject)=>{

                var xhr = new XMLHttpRequest();

                xhr.open('POST', '/upload');

                xhr.onload = event =>{

                    try{

                        resolve(JSON.parse(xhr.responseText));

                    }catch(e){

                        reject(e);

                    }

                };

                xhr.onerror = event => {

                    reject(event);

                };  

                let formData = new FormData();

                formData.append('input-file', file);

                xhr.send(formData);

            }));

        });

        return Promise.all(promises);

    }
    

}