class CalcController{
    
    // Class constructor
    constructor(){

        this._operation       = [];
        this._locale          = 'pt-BR';
        this._displayCalcEl   = document.querySelector("#display");
        this._dateEl          = document.querySelector("#data");
        this._timeEl          = document.querySelector("#hora");
        this._currentDate;
        this.initialize();
        this.initButtonsEvents();
        
    }

    // ===== Functions =====    
    initialize(){
        
        // Updates date and time each second
        this.setDisplayDateTime();
        setInterval(()=>{
            this.setDisplayDateTime();
        }, 1000);

        this.setLastNumberToDisplay();
    }

    // create multiple event on element
    addEventListenerAll(element, events, fn){
        
        events.split(' ').forEach(event => {

            element.addEventListener(event, fn, false);

        });

    }

    clearAll(){

        this._operation = [];
        
        this.setLastNumberToDisplay();
    }

    clearEntry(){

        this._operation.pop();

        this.setLastNumberToDisplay();
    }

    getLastOperation(){

        return this._operation[this._operation.length - 1];

    }

    setLastOperation(value){

        // My code, challange
        // if(this._operation.length == 0){

        //     this._operation.push(value);

        // }else{

        //     this._operation[this._operation.length - 1] = value;

        // }

        this._operation[this._operation.length-1] = value;

    }

    isOperator(value){

        return (['+', '-', '*', '%', '/'].indexOf(value) > -1);

    }

    pushOperation(value){

        this._operation.push(value);

        if(this._operation.length > 3){

            this.calc();

        }
    }

    calc(){

        let last = '';

        if(this._operation.length > 3){

            last = this._operation.pop();

        }
        
        let result  = eval(this._operation.join(""));
        
        if(last == '%'){

            result /= 100;
            this._operation = [result];

        }else{
            this._operation = [result];
            
            if(last) this._operation.push(last);
        }
        
        
        this.setLastNumberToDisplay();
    }

    setLastNumberToDisplay(){
        
        let lastNumber;

        for(let i = this._operation.length-1; i >= 0; i--){
            if(!this.isOperator(this._operation[i])){
                lastNumber = this._operation[i];
                break;
            }
        }

        if(!lastNumber) lastNumber = 0;

        this.displayCalc = lastNumber;

    }

    addOperation(value){

        if(isNaN(this.getLastOperation())){

            if(this.isOperator(value)){

                this.setLastOperation(value);

            }else if(isNaN(value)){

                console.log('outra coisa', value);

            }else{    

                this._operation.push(value);
                this.setLastNumberToDisplay();
            }

        }else{

            if(this.isOperator(value)){

                this.pushOperation(value);

            }else{

                let newValue = this.getLastOperation().toString() + value.toString();
                this.setLastOperation(parseInt(newValue));
                
                this.setLastNumberToDisplay();
            }
            

        }
        //console.log(this._operation);
    }

    setError(){

        this.displayCalc = "Error";

    }

    execBtn(value){

        switch(value){
            case 'ac':
                this.clearAll();
                break;
            case 'ce':
                this.clearEntry();
                break;
            case 'soma':
                this.addOperation('+');
                break;
            case 'subtracao':
                this.addOperation('-');
                break;
            case 'multiplicacao':
                this.addOperation('*');
                break;
            case 'divisao':
                this.addOperation('/');
                break;
            case 'porcento':
                this.addOperation('%');
                break;
            case 'igual':
                this.calc();
                break;
            case 'ponto':
                this.addOperation('.');
                break;
            case '0':
            case '1':
            case '2':
            case '3':
            case '4':
            case '5':
            case '6':
            case '7':
            case '8':
            case '9':
                this.addOperation(parseInt(value));
                break;
            default:
                this.setError();
                break;
        }

    }

    // Initialize buttons
    initButtonsEvents(){
        
        let buttons = document.querySelectorAll("#buttons > g, #parts > g");
        
        // for each button add an event
        buttons.forEach((btn, index)=>{

            this.addEventListenerAll(btn, 'click drag drop', e=>{

                let textBtn = btn.className.baseVal.replace("btn-", "");

                this.execBtn(textBtn);

            });

            this.addEventListenerAll(btn, 'mouseover mouseup mousedown', e=>{
                btn.style.cursor = 'pointer';
            });

        });
    }

    setDisplayDateTime(){
        this.displayTime = this.currentDate.toLocaleTimeString(this._locale);
        this.displayDate = this.currentDate.toLocaleDateString(this._locale,{day: '2-digit', month: 'long', year: 'numeric'});
    }

    // ===== Getters & Setters =====
    // Display calculator
    get displayCalc(){
        return this._displayCalcEl.innerHTML;
    }

    set displayCalc(value){
        this._displayCalcEl.innerHTML = value;
    }

    // Time calculator
    get displayTime(){
        return this._timeEl.innerHTML;
    }

    set displayTime(value){
        this._timeEl.innerHTML = value;
    }

    // Date calculator
    get displayDate(){
        return this._dateEl.innerHTML;
    }

    set displayDate(value){
        this._dateEl.innerHTML = value;
    }

    // Return date instance
    get currentDate(){
        return new Date();
    }

    set currentDate(value){
        this._currentDate = value;
    }

}