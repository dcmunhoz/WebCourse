class CalcController{
    
    // Class constructor
    constructor(){
        
        this._displayCalc = "0";
        this._currentDate;
        this.initialize();
        
    }
    
    initialize(){

        let displayCalcEl   = document.querySelector("#display");
        let dateEl          = document.querySelector("#data");
        let timeEl          = document.querySelector("#hora");

        displayCalcEl.innerHTML = "4567";
        dateEl.innerHTML  = "01/01/2019";   
        timeEl.innerHTML  = "00:00";

    }

    // Getters & Setters
    get displayCalc(){
        return this._displayCalc;
    }

    set displayCalc(valor){
        this._displayCalc = valor;
    }

    get dataAtual(){
        return this._currentDate;
    }

    set dataAtual(valor){
        this._currentDate = valor;
    }

}